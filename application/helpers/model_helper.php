<?php
defined('BASEPATH') or exit('No direct script access allowed');






if (!function_exists('get_sigle_record')) {
    function get_single_record($table, $where = [], $select = '*')
    {
        return db_add()->select($select)->where($where)->get($table)->row_array();
    }
}





if (!function_exists('get_records')) {
    function get_records($table, $where = [], $select = '*')
    {
        return db_add()->select($select)->where($where)->get($table)->result_array();
    }
}

if (!function_exists('add')) {
    function add($table, $data = [])
    {
        return db_add()->insert($table, $data);
    }
}


if (!function_exists('update')) {
    function update($table, $where, $set)
    {
        return db_add()
            ->set($set)
            ->where($where)
            ->update($table);
    }
}


if (!function_exists('user_count')) {
    function user_count($field, $userIds, $table)
    {
        return db_add()
            ->set($field, "$field + 1", false)
            ->where_in('user_id', $userIds)
            ->update($table);
    }
}


if (!function_exists('count_record')) {

    function count_record($table, $where = [])
    {
        return db_add()
            ->where($where)
            ->count_all_results($table);
    }

}


if (!function_exists('sum_record')) {

    function sum_record($table,$where = [], $column='amount')
    {
        $result = db_add()
            ->select_sum($column, 'total')
            ->where($where)
            ->get($table)
            ->row_array();

        return $result['total'] ?? 0;
    }
}


if (!function_exists('update_direct')) {
    function update_direct($user_id)
    {
        return db_add()
            ->set('directs',  'directs + 1', FALSE)
            ->where('user_id', $user_id)
            ->update('users');
    }

}





