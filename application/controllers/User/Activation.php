<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth');

        require_login();
    }

    public function index()
    {
        $res['header'] = "Activation";
        $res['user'] = loginuser();
        $res['package'] = get_records('packages', [], '*');
        $res['balance'] = sum_record('e_wallet', ['user_id' => user_id()]);
        $this->view->user('activation', $res);
    }

    public function activationPost()
    {
        $allowPost = ['user_id','amount'];
        post_permission($allowPost);
        $data = $this->input->post();
        $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim');
        if ($this->form_validation->run() === TRUE) {

            $user_id = $data['user_id'];
            $activation_amount    = $data['amount'];
            $checkuser = get_single_record('users', ['user_id' => $user_id], '*');
            if (!empty($checkuser)) {
                $this->checkBalance($activation_amount);
                if (activation == 0) {
                    $checkuser['package_rec'] = [
                        'direct_income' => 0.1,
                        'id' => ($checkuser['package_id'] + 1),
                        'level_income' => "0.1,0.2",
                        'roi_income' => 0.1,
                        'days' => 1000,
                        'package' => $activation_amount
                    ];
                    $this->anountActivation($checkuser, $activation_amount);
                } else {
                    $checkpakage = get_single_record('packages', ['package' => $activation_amount], '*');
                    if (!empty($checkpakage)) {
                        $checkuser['package_rec'] = $checkpakage;
                        $this->packageActivation($checkuser, $activation_amount);
                    } else {
                        json_response(false, 'Invalid Package');
                    }
                }
            } else {
                json_response(false, 'Invalid User');
            }
        } else {
            json_response(false, strip_tags(validation_errors()));
        }
    }

    protected function checkBalance($amount)
    {
        $checkbalance = sum_record('e_wallet', ['user_id' => user_id()]);
        if ($amount < 0) {
            json_response(false, 'Invalid Package');
        }

        if ($checkbalance <= $amount) {
            json_response(false, 'Insufficent Balance');
        }
    }


    protected function anountActivation(array $user, $activation_amount)
    {
        $minAmount = 50;
        $multipleAmount = 50;
        if ($activation_amount < $minAmount) {
            json_response(false, 'Minimun Activation Amount' . currency . $minAmount);
        }
        if ($activation_amount % $multipleAmount != 0) {
            json_response(false, 'Multiple of  Amount' . currency . $multipleAmount);
        }
        if ($activation_amount < $user['package']) {
            json_response(false, 'You Can Activate Account With Same Amount  Or Above Amount');
        }
        if ($user['paid_status'] >= 0) {
            $this->addwallet($user['user_id'], $activation_amount);
            $this->update_user_package($user, $activation_amount);
            $this->addactivationdetails($user, $activation_amount);
            $this->adddirect_income($user, $activation_amount);
            if (register == 0) {
                $this->addroi_income($user, $activation_amount);
            }
             json_response(true, 'Activation Successfully!',base_url('activation'));
        } else {
            json_response(false, 'something went worng ...!');
        }
    }


    protected function packageActivation(array $user, $activation_amount)
    {

        if ($activation_amount < $user['package']) {
            json_response(false, 'You Can Activate Account With Same Amount  Or Above Amount');
        }
        if ($user['paid_status'] >= 0) {
            $this->addwallet($user['user_id'], $activation_amount);
            $this->update_user_package($user, $activation_amount);
            $this->addactivationdetails($user, $activation_amount);
            $this->adddirect_income($user, $activation_amount);
            if (register == 0) {
                $this->addroi_income($user, $activation_amount);
            }
            json_response(true, 'Activation Successfully!', base_url('activation'));
        } else {
            json_response(false, 'something went worng ...!');
        }
    }


    private function addwallet($user_id, $package)
    {
        $e_wallet_deduct = array(
            'user_id' => $this->session->userdata['user_id'],
            'amount' => -$package,
            'type' => 'account_activation',
            'description' => 'Account Activation Deduction for ' . $user_id,
        );
        add('e_wallet', $e_wallet_deduct);
    }

    private function update_user_package(array $user, $package)
    {
        $topupData = array(
            'paid_status' => 1,
            'package_id' => ($user['package_rec']['id']),
            'package' => $package,
            'total_package' => $user['total_package'] + $package,
        );
        if ($user['paid_status'] == 0) {
            $topupData['activation_date'] = date('Y-m-d H:i:s');
        }
        if (income_limit == 0) {
            $topupData['total_limit'] =  $user['total_limit'] + ($package * 4);
        }
        update('users', ['user_id' => $user['user_id']], $topupData);
        if ($user['paid_status'] == 0) {
            update_direct($user['sponsor_id']);
            $this->update_team($user['sponsor_id']);
        }
    }


    private function addactivationdetails(array $user, $package)
    {
        $activation_details = array(
            'user_id' => $user['user_id'],
            'activater' => $this->session->userdata['user_id'],
            'package' => $package,
            'type' => ($user['paid_status'] == 0 ? "activate" : "upgrade"),
            'topup_date' => date('Y-m-d H:i:s'),
        );
        add('activation_details', $activation_details);
        $this->team_business($user['sponsor_id'], $package);
        if (register == 1) {
            $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package);
        }
    }


    private function adddirect_income(array $user, $package)
    {
        $sponsor = get_single_record('users', ['user_id' => $user['sponsor_id']], '*');
        if (!empty($sponsor)) {
            if (direct_income == 0) {
                $direct_income = $package * $user['package_rec']['direct_income'];
                if ($sponsor['paid_status'] == 1) {
                    if (income_limit == 0) {
                        $direct_income = incomeProccess($sponsor['user_id'], $direct_income);
                    }
                    if ($direct_income > 0) {
                        $DirectIncome = array(
                            'user_id' => $sponsor['user_id'],
                            'amount' => $direct_income,
                            'type' => 'direct_income',
                            'level' => 1,
                            'package' => $package,
                            'active_id' => $user['user_id'],
                            'description' => 'Direct Income from Activation of Member ' . $user['user_id'] . ' with package ' . currency . $package,
                        );
                        add('income_wallet', $DirectIncome);
                    }
                }
            }
            if (level_income == 0) {
                /* **********-LEVEL INCOME -************ */
                $level_income = $user['package_rec']['level_income'];
                $this->levelIncome($sponsor['sponsor_id'], $user['user_id'], $level_income, $package);
            }
        }
    }



    private function levelIncome($sponsor_id, $activated_id, $package_income, $package)
    {
        $incomeArr = explode(',', $package_income);

        foreach ($incomeArr as $key => $income) {

            // Stop if sponsor ID is empty
            if (empty($sponsor_id)) {
                break;
            }

            // Get sponsor details
            $sponsor = get_single_record('users', ['user_id' => $sponsor_id], 'id,user_id,sponsor_id,paid_status,package,directs');

            // Stop if sponsor does not exist
            if (empty($sponsor)) {
                break;
            }

            $level = $key + 1;
            $level_income = (float) trim($income);

            if ($sponsor['paid_status'] == 1 && $level_income > 0) {
                if (income_limit == 0) {
                    $level_income = incomeProccess($sponsor['user_id'], $level_income);
                }

                if ($level_income > 0) {
                    $LevelIncome = [
                        'user_id'     => $sponsor['user_id'],
                        'amount'      => $level_income,
                        'type'        => 'level_income',
                        'level'        => $level,
                        'package' => $package,
                        'active_id' => $activated_id,
                        'description' => ' Level Income from Activation of Member (' . currency . $package . ') ' . $activated_id . ' At level ' . $level,
                    ];
                    add('income_wallet', $LevelIncome);
                }
            }

            // Move to the next upline sponsor
            $sponsor_id = $sponsor['sponsor_id'];
        }
    }


    private function addroi_income(array $user, $package)
    {
        if (roi_income == 0) {
            $roiamount = $user['package'] * $user['package_rec']['roi_income'];
            $days = $user['package_rec']['days'];
            $roiArr = array(
                'user_id' => $user['user_id'],
                'amount' => $roiamount * $days,
                'roi_amount' => $roiamount,
                'days' => $days,
                'total_days' => $days,
                'package' => $package,
                'type' => 'roi_income',
                'creditDate' => date('Y-m-d'),
            );
            add('roi', $roiArr);
        }
    }



    /**
     * Update total team count for all uplines.
     */
    private function update_team($user_name)
    {

        $visited = [];
        $currentUser = $user_name;

        while (!empty($currentUser) && strtolower($currentUser) !== 'none') {

            // Prevent infinite loop if sponsor data contains a cycle
            if (isset($visited[$currentUser])) {
                break;
            }

            $visited[$currentUser] = true;

            $user = get_single_record(
                'users',
                ['user_id' => $currentUser],
                'user_id, sponsor_id'
            );

            if (empty($user)) {
                break;
            }

            // Atomic increment: safer than reading and adding in PHP
            db_add()
                ->set('team', 'team + 1', false)
                ->where('user_id', $user['user_id'])
                ->update('users');

            $currentUser = $user['sponsor_id'];
        }
    }


    /**
     * Update team business for all paid uplines.
     */
    private function team_business($user_name, $business)
    {
        $visited = [];
        $currentUser = $user_name;
        $business = (float) $business;
        $level = 0;

        if ($business <= 0) {
            return;
        }

        while (!empty($currentUser) && strtolower($currentUser) !== 'none') {

            if (isset($visited[$currentUser])) {
                break;
            }

            $visited[$currentUser] = true;

            $user = get_single_record(
                'users',
                ['user_id' => $currentUser],
                'user_id, sponsor_id, paid_status'
            );

            if (empty($user)) {
                break;
            }

            // Update only paid users
            if ((int) $user['paid_status'] === 1) {

                if ($level === 0) {
                    // Direct sponsor business
                    db_add()
                        ->set('direct_business', 'direct_business + ' . $business, false)
                        ->where('user_id', $user['user_id'])
                        ->update('users');
                }
                // All higher upline team business
                db_add()
                    ->set('team_business', 'team_business + ' . $business, false)
                    ->where('user_id', $user['user_id'])
                    ->update('users');
            }

            $currentUser = $user['sponsor_id'];
            $level++;
        }
    }


    private function update_business($user_name, $downline_id, $level, $business)
    {
        $visited = [];
        $currentUser = $user_name;
        $createdAt = date('Y-m-d H:i:s');

        while (!empty($currentUser)) {

            // Prevent infinite loops
            if (isset($visited[$currentUser])) {
                break;
            }

            $visited[$currentUser] = true;

            $user = get_single_record(
                'users',
                ['user_id' => $currentUser],
                'upline_id, position, user_id'
            );

            if (empty($user) || empty($user['upline_id'])) {
                break;
            }

            $uplineId = $user['upline_id'];
            $position = $user['position'];

            // Determine business columns
            if ($position === 'L') {
                // $powerColumn = 'leftPower';
                $businessColumn = 'leftBusiness';
            } elseif ($position === 'R') {
                // $powerColumn = 'rightPower';
                $businessColumn = 'rightBusiness';
            } else {
                break;
            }

            db_add()
                // ->set($powerColumn, "$powerColumn + " . (float) $power, false)
                ->set($businessColumn, "$businessColumn + " . (float) $business, false)
                ->where('user_id', $uplineId)
                ->update('users');

            // Insert downline business record
            $downlineArray = [
                'user_id'     => $uplineId,
                'downline_id' => $downline_id,
                'position'    => $position,
                'business'    => $business,
                'created_at'  => $createdAt,
                'level'       => $level,
            ];

            add('downline_business', $downlineArray);

            // Move to next upline
            $currentUser = $uplineId;
            $level++;
        }
    }
}
