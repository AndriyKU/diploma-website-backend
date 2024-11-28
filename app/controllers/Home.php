<?php
class Home extends Controller
{
    public function index($shorten = '', $alias = '')
    {
        $data = [];
        $user = $this->model('UserModel');

        if (isset($_POST['email'])) {
            $data['message'] = $user->validateUser($_POST['email'], $_POST['login'], $_POST['password']);

            if ($data['message'] === 'Correct') {
                $user->signUp();
                $this->redirect('/user');
            }
        }

        if ($user->isAuthenticated()) {
            $data['user'] = $user->getUser('auth_token', $_COOKIE['login']);

            $link = $this->model('LinkModel');

            if (isset($_POST['link'])) {
                $data['message'] = $link->validateLink($_POST['link'], $_POST['alias'], $data['user']['id']);

                if ($data['message'] === 'Correct') {
                    $link->addLink($data['user']['id']);
                    unset($data['message']);
                    // $this->redirect('/');
                }
            }

            if (isset($_POST['delete_link'])) {
                $link->deleteLink($_POST['delete_link']);
                $this->redirect('/');
            }

            $data['links'] = $link->getAllUserLinks($data['user']['id']);
            $this->view('home/index', $data);
        } else {
            $this->view('user/reg', $data);
        }
    }
    public function contact()
    {
        $data = [];

        if (isset($_POST['name'])) {
            $contact = $this->model('ContactModel');

            $data['message'] = $contact->validateContact($_POST['name'], $_POST['email'], $_POST['age'], $_POST['message']);

            if ($data['message'] === 'Correct') {
                $data['message'] = $contact->sendMail();
            }
        }

        $this->view('home/contact', $data);
    }
    public function about()
    {
        $this->view('home/about');
    }
}
