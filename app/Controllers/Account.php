<?php

namespace App\Controllers;

use \App\Models\AccountModel;

class Account extends BaseController
{
    public function login()
    {
        if (!$this->validate([
            'account' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '账户不能为空',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '密码不能为空',
                ],
            ],
        ])) {
            return view('login', [
                'action' => 'login',
                'action_url' => site_url('account/login'),
                'errors' => $this->validator->getErrors(),
            ]);
        } else {
            $accountModel = new AccountModel();
            $data = $accountModel->getUserByAccount($this->request->getPost('account'));
            if (!empty($data)) {
                $user = $data[0];
                if (password_verify($this->request->getPost('password'), $user['password'])) {
                    $this->session->set([
                        'user'  => $user,
                        'logged_in' => true,
                    ]);
                    return redirect()->to('/');
                } else {
                    return view('login', [
                        'action' => 'login',
                        'action_url' => site_url('account/login'),
                        'errors' => [
                            'password' => "密码错误",
                        ],
                    ]);
                }
            } else {
                return view('login', [
                    'action' => 'login',
                    'action_url' => site_url('account/login'),
                    'errors' => [
                        'account' => "账号不存在",
                    ],
                ]);
            }
        }
    }

    public function register()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '用户名不能为空',
                ],
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '邮箱不能为空',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '密码不能为空',
                ],
            ],
            'confirmPassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '确认密码不能为空',
                    'matches' => '两次输入密码不正确',
                ],
            ],
        ])) {
            return view('login', [
                'action' => 'register',
                'action_url' => site_url('account/register'),
                'errors' => $this->validator->getErrors(),
            ]);
        } else {
            $accountModel = new AccountModel();
            // 确保用户名唯一性
            $data = $accountModel->getUserByUsername(
                $this->request->getPost('username')
            );
            if (!empty($data)) {
                return view('login', [
                    'action' => 'register',
                    'action_url' => site_url('account/register'),
                    'errors' => [
                        'username' => '用户名已存在',
                    ],
                ]);
            }
            // 确保邮箱唯一性
            $data = $accountModel->getUserByEmail(
                $this->request->getPost('email')
            );
            if (!empty($data)) {
                return view('login', [
                    'action' => 'register',
                    'action_url' => site_url('account/register'),
                    'errors' => [
                        'username' => '邮箱已存在',
                    ],
                ]);
            }
            $accountModel->postUser(
                $this->request->getPost('username'),
                $this->request->getPost('email'),
                $this->request->getPost('password')
            );
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
