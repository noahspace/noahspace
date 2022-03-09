<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
    // 通过账户获取用户
    function getUserByAccount($account)
    {
        $db = db_connect();
        $builder = $db->table('users')->where('username', $account)->orWhere('email', $account);
        return $builder->get()->getResultArray();
    }

    // 通过 uid 获取用户
    function getUserByUid($uid)
    {
        $db = db_connect();
        $builder = $db->table('users')->where('uid', $uid);
        return $builder->get()->getResultArray();
    }

    // 通过用户名获取用户
    function getUserByUsername($username)
    {
        $db = db_connect();
        $builder = $db->table('users')->where('username', $username);
        return $builder->get()->getResultArray();
    }

    // 通过邮箱获取用户
    function getUserByEmail($email)
    {
        $db = db_connect();
        $builder = $db->table('users')->where('email', $email);
        return $builder->get()->getResultArray();
    }

    // 添加用户
    function postUser($username, $email, $password)
    {
        $db = db_connect();
        $db->table('users')->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    // 通过 uid 更新用户密码
    function updateUserByUid($uid, $password)
    {
        $db = db_connect();
        $db->table('users')->update([
            'password' =>  password_hash($password, PASSWORD_DEFAULT),
        ], ['uid' => $uid]);
    }
}
