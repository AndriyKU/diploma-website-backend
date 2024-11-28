<?php

class Link extends Controller
{
    public function resolve($alias)
    {
        $user = $this->model('UserModel');
        if ($user->isAuthenticated()) {
            $user = $user->getUser('auth_token', $_COOKIE['login']);

            $link = $this->model('LinkModel');
            $url = $link->getLink($alias, $user['id']);

            if ($url)
                $this->redirect($url['link']);
            else {
                http_response_code(404);
                $this->view('errors/404');
            }
        } else {
            http_response_code(404);
            $this->view('errors/404');
        }
    }
}
