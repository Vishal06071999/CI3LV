<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function index()
    {
        $response = [];
        $response['header'] = "Register";
        $this->view->user('register', $response, false);
    }

    public function registerPost()
    {
        $allowPost = ['sponsor','email','name','terms'];
        if(register ==1){
            array_push($allowPost,'position');
        }

        post_permission($allowPost);
        
        $data = $this->input->post();
        $this->form_validation->set_rules(
            'sponsor',
            'Sponsor',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email'
        );
        if (register == 1) {
            $this->form_validation->set_rules(
                'position',
                'Position',
                'required|trim|in_list[L,R]'
            );
        }
        if ($this->form_validation->run() === TRUE) {

            $sponsor = $data['sponsor'];
            $name    = $data['name'];
            $email   = $data['email'];

            $checksponsor = get_single_record(
                'users',
                [
                    'user_id' => $sponsor
                ],
                'user_id,last_left,last_right'
            );

            if (!empty($checksponsor)) {

                $userdata = [
                    'user_id'    => $this->getUserIdForRegister(),
                    'sponsor_id' => $sponsor,
                    'name'       => $name,
                    'email'      => $email,
                    'password'   => rand(100000, 999999)
                ];

                if (register == 0) {

                    $this->simpleRegister($userdata);
                } else {

                    $userdata['position'] = $data['position'];

                    $this->binaryRegister(
                        $userdata,
                        $checksponsor['last_left'],
                        $checksponsor['last_right']
                    );
                }

                $data_success = [
                    'user_id' => $userdata['user_id'],
                    'name' => $userdata['name'],
                    'password' => $userdata['password']
                ];
                $this->session->set_flashdata('data_success', $data_success);
                json_response(true, "Register Successfully", base_url('success'));
            } else {
                json_response(false, "Invalid Sponsor");
            }
        } else {
            json_response(false, (strip_tags(validation_errors())));
        }
    }
    private function getUserIdForRegister()
    {
        $user_id = perfix . rand(10000, 99999);
        $sponser = get_single_record('users', array('user_id' => $user_id), 'user_id,name');
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }

    protected function simpleRegister(array $data)
    {
        add('users', $data);
        $this->add_sponser_counts($data['user_id'], $data['user_id'], 1);
    }


    protected function binaryRegister(array $data, $sponser_last_left, $sponser_last_right)
    {
        $data['last_left'] = $data['user_id'];
        $data['last_right'] = $data['user_id'];
        if ($data['position'] == 'L') {
            $data['upline_id'] = $sponser_last_left;
        } else {
            $data['upline_id'] = $sponser_last_right;
        }
        add('users', $data);
        if ($data['position'] == 'R') {
            update('users', array('last_right' => $data['upline_id']), array('last_right' => $data['user_id']));
            update('users', array('user_id' => $data['upline_id']), array('right_node' => $data['user_id']));
        } elseif ($data['position'] == 'L') {
            update('users', array('last_left' => $data['upline_id']), array('last_left' => $data['user_id']));
            update('users', array('user_id' => $data['upline_id']), array('left_node' => $data['user_id']));
        }
        $this->add_sponser_counts($data['user_id'], $data['user_id'], 1);
        $this->add_counts($data['user_id'], $data['user_id'], 1);
    }

    private function add_sponser_counts($user_id, $downline_id, $level = 1)
    {
        $rows = [];
        while ($user_id != '' && $user_id != 'none') {
            $user = get_single_record(
                'users',
                ['user_id' => $user_id],
                'sponsor_id,user_id,position'
            );

            if (empty($user) || empty($user['sponsor_id']) || $user['sponsor_id'] == 'none') {
                break;
            }

            $rows[] = [
                'user_id'     => $user['sponsor_id'],
                'downline_id' => $downline_id,
                'level'       => $level,
            ];

            $user_id = $user['sponsor_id'];
            $level++;
        }

        // Single bulk insert
        if (!empty($rows)) {
            $this->db->insert_batch('sponsor_count', $rows);
        }
    }


    private function add_counts($user_id, $downline_id, $level = 1)
    {
        if (empty($user_id) || empty($downline_id)) {
            return false;
        }
        $db = db_add();
        $user = get_single_record('users', ['user_id' => $user_id], 'upline_path');
        if (empty($user['upline_path'])) {
            return false;
        }
        $uplineIds = array_filter(
            array_map('trim', explode(',', $user['upline_path']))
        );

        if (empty($uplineIds)) {
            return false;
        }
        $uplineIds = array_reverse($uplineIds);
        $users = get_records('users', ['user_id' => $user_id], 'user_id, position');
        if (empty($users)) {
            return false;
        }
        $positionMap = [];

        foreach ($users as $user) {
            $positionMap[$user['user_id']] = strtoupper($user['position']);
        }

        $insertData = [];
        $leftIds  = [];
        $rightIds = [];
        foreach ($uplineIds as $uplineId) {
            if (!isset($positionMap[$uplineId])) {
                continue;
            }
            $position = $positionMap[$uplineId];

            if ($position !== 'L' && $position !== 'R') {
                continue;
            }
            $insertData[] = [
                'user_id'     => $uplineId,
                'downline_id' => $downline_id,
                'position'    => $position,
                'created_at'  => date('Y-m-d H:i:s'),
                'level'       => $level,
            ];

            if ($position === 'L') {
                $leftIds[] = $uplineId;
            } else {
                $rightIds[] = $uplineId;
            }

            $level++;
        }

        if (!empty($insertData)) {
            $db->insert_batch('downline_count', $insertData);
        }

        $leftIds  = array_unique($leftIds);
        $rightIds = array_unique($rightIds);
        if (!empty($leftIds)) {
            user_count('left_count', ['user_id' => $leftIds], 'users');
        }

        if (!empty($rightIds)) {
            user_count('right_count', ['user_id' => $leftIds], 'users');
        }

        return true;
    }

    public function success()
    {
        $response['data'] = $this->session->flashdata('data_success');
        if (!empty($response['data'])) {
            $this->view->user('success', $response, false);
        } else {
            redirect('register');
        }
    }


    public function get_user()
    {
        $user_id = $this->input->post('user_id', true);

        $user = get_single_record('users', ['user_id' => $user_id], '*');

        if (!empty($user)) {
            $res = [
                'status'  => true,
                'message' => $user['name']
            ];
        } else {
            $res = [
                'status'  => false,
                'message' => 'Invalid User'
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($res));
    }
}
