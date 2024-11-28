<?php

class User extends Controller
{
    public function index()
    {
        $data = [];
        $user = $this->model('UserModel');

        if (isset($_POST['logout'])) {
            $user->logout($_POST['logout']);
            $this->redirect('/user/auth');
        }

        if ($user->isAuthenticated()) {
            $data['user'] = $user->getUser('auth_token', $_COOKIE['login']);
            $this->view('user/dashboard', $data);
        } else
            $this->redirect('/user/auth');
    }

    /* public function reg()
    {
        $this->view('user/reg');
    } */

    public function auth()
    {
        $data = [];
        $user = $this->model('UserModel');

        if (isset($_POST['login'])) {
            $data['message'] = $user->login($_POST['login'], $_POST['password']);

            if ($data['message'] === 'Correct')
                $this->redirect('/user');
        }

        if ($user->isAuthenticated())
            $this->redirect('/user');
        else
            $this->view('user/auth', $data);
    }
}
