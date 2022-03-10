<?php

namespace App\Controllers;

use \App\Models\AccountModel;
use \Config\Services;

class Account extends BaseController
{
    protected $helpers = ['text'];

    public function login()
    {
        if ($this->request->getMethod() === 'get') {
            if ($this->session->get('logged_in')) {
                return redirect()->to('/');
            }
            $this->session->set('login_code', random_string());
            return view('login', [
                'action' => 'login',
                'code' => $this->session->get('login_code'),
            ]);
        }
        if ($this->validate([
            'code' => [
                'rules' => "required|in_list[{$this->session->get('login_code')}]",
                'errors' => [
                    'required' => '请求非法',
                    'in_list' => '请求非法',
                ],
            ],
            'account' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '用户名或邮箱不能为空',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '密码不能为空',
                ],
            ],
        ])) {
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
                    $this->session->set('login_code', random_string());
                    return view('login', [
                        'action' => 'login',
                        'code' => $this->session->get('login_code'),
                        'errors' => [
                            'password' => "密码错误",
                        ],
                    ]);
                }
            } else {
                $this->session->set('login_code', random_string());
                return view('login', [
                    'action' => 'login',
                    'code' => $this->session->get('login_code'),
                    'errors' => [
                        'account' => "账号不存在",
                    ],
                ]);
            }
        } else {
            $this->session->set('login_code', random_string());
            return view('login', [
                'action' => 'login',
                'code' => $this->session->get('login_code'),
                'errors' => $this->validator->getErrors(),
            ]);
        }
    }

    public function register()
    {
        if ($this->request->getMethod() === 'get') {
            if ($this->session->get('logged_in')) {
                return redirect()->to('/');
            }
            $this->session->set('register_code', random_string());
            return view('login', [
                'action' => 'register',
                'code' => $this->session->get('register_code'),
            ]);
        }
        if ($this->validate([
            'code' => [
                'rules' => "required|in_list[{$this->session->get('register_code')}]",
                'errors' => [
                    'required' => '请求非法',
                    'in_list' => '请求非法',
                ],
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '用户名不能为空',
                    'is_unique' => '用户名已存在',
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '邮箱不能为空',
                    'valid_email' => '邮箱格式不正确',
                    'is_unique' => '邮箱已存在',
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
            $accountModel = new AccountModel();
            $accountModel->postUser(
                $this->request->getPost('username'),
                $this->request->getPost('email'),
                $this->request->getPost('password')
            );
            return redirect()->to('/login');
        } else {
            $this->session->set('register_code', random_string());
            return view('login', [
                'action' => 'register',
                'code' => $this->session->get('register_code'),
                'errors' => $this->validator->getErrors(),
            ]);
        }
    }

    public function resetPassword()
    {
        $accountModel = new AccountModel();
        if ($this->request->getMethod() === 'get') {
            if ($this->session->get('logged_in')) {
                return redirect()->to('/');
            }
            // 发送邮件表单
            if (empty($this->request->getGet())) {
                $this->session->set('reset_password_code', random_string());
                return view('login', [
                    'action' => 'resetPasswordSendEmail',
                    'code' => $this->session->get('reset_password_code'),
                ]);
            } else {
                // 修改密码表单
                $code = $this->request->getGet('code');
                $uid = $this->request->getGet('uid');
                if ($code && $uid) {
                    $data = $accountModel->getUserByUid($uid);
                    if (!empty($data)) {
                        $user = $data[0];
                        if ($code === md5($user['password'])) {
                            return view('login', [
                                'action' => 'resetPasswordSuccess',
                                'uid' => $user['uid'],
                                'code' => $code,
                            ]);
                        } else {
                            return redirect()->to('/reset-password');
                        }
                    } else {
                        return redirect()->to('/reset-password');
                    }
                } else {
                    return redirect()->to('/reset-password');
                }
            }
        } else {
            if ($this->request->getPost('action') === 'resetPasswordSendEmail') {
                // 发送邮箱提交
                if ($this->validate([
                    'code' => [
                        'rules' => "required|in_list[{$this->session->get('reset_password_code')}]",
                        'errors' => [
                            'required' => '请求非法',
                            'in_list' => '请求非法',
                        ],
                    ],
                    'account' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '用户名或邮箱不能为空',
                        ],
                    ],
                ])) {
                    $data = $accountModel->getUserByAccount($this->request->getPost('account'));
                    if (!empty($data)) {
                        $user = $data[0];
                        $email = Services::email();
                        $email->setFrom('noahspaceadmin@163.com', '管理员');
                        $email->setTo($user['email']);
                        $email->setSubject('诺亚空间');
                        $email->setMessage('点击此链接重置密码：' . site_url('reset-password?uid=' . $user['uid'] . '&code=' . md5($user['password'])));
                        $email->send();
                        return view('info', [
                            'action' => 'resetPassword',
                        ]);
                    } else {
                        $this->session->set('reset_password_code', random_string());
                        return view('login', [
                            'action' => 'resetPasswordSendEmail',
                            'code' => $this->session->get('reset_password_code'),
                            'errors' => [
                                'account' => "用户名或邮箱不存在",
                            ],
                        ]);
                    }
                } else {
                    $this->session->set('reset_password_code', random_string());
                    return view('login', [
                        'action' => 'resetPasswordSendEmail',
                        'code' => $this->session->get('reset_password_code'),
                        'errors' => $this->validator->getErrors(),
                    ]);
                }
            } else if ($this->request->getPost('action') === 'resetPasswordSuccess') {
                if ($this->validate([
                    'code' => [
                        'rules' => "required",
                        'errors' => [
                            'required' => '请求非法',
                        ],
                    ],
                    'uid' => [
                        'rules' => 'required|is_not_unique[users.uid]',
                        'errors' => [
                            'required' => '请求非法',
                            'is_not_unique' => '请求非法'
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
                    $user = $accountModel->getUserByUid($this->request->getPost('uid'))[0];
                    if ($this->request->getPost('code') === md5($user['password'])) {
                        $accountModel->updateUserByUid($this->request->getPost('uid'), $this->request->getPost('password'));
                        return view('info', [
                            'action' => 'resetPasswordSuccess',
                        ]);
                    } else {
                        return redirect()->to('/reset-password');
                    }
                } else {
                    return view('login', [
                        'action' => 'resetPasswordSuccess',
                        'code' => $this->request->getPost('code'),
                        'uid' => $this->request->getPost('uid'),
                        'errors' => $this->validator->getErrors(),
                    ]);
                }
            }
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
