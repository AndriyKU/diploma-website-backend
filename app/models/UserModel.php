<?php
require_once 'DB.php';

class UserModel
{
    private $email = '';
    private $login = '';
    private $password = '';
    private $auth_token = '';

    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function validateUser($email, $login, $password)
    {
        $this->email = trim(filter_var($email, FILTER_SANITIZE_EMAIL));
        $this->login = trim(filter_var($login, FILTER_SANITIZE_STRING));
        $this->password = trim($password);

        if (strlen($this->email) < 3)
            return 'L\'email è troppo corto';
        else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            return 'Un\'email cosi non esiste';
        else if (strlen($this->login) < 3)
            return 'Il login inserito è troppo corto';
        else if ($this->getUser('login', $this->login))
            return 'Un utente con questo login esiste già';
        else if (strlen($this->password) < 3)
            return 'La password deve contenere almeno 3 caratteri';
        else
            return 'Correct';
    }

    public function getUser($column, $value)
    {
        $sql = "SELECT * FROM `users` WHERE $column = ?;";
        $query = $this->_db->prepare($sql);
        $query->execute([$value]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : [];
    }

    public function signUp()
    {
        $sql = "INSERT INTO `users` (`login`, `email`, `password`) VALUES (:login, :email, :password);";
        $query = $this->_db->prepare($sql);

        $password = password_hash($this->password, PASSWORD_DEFAULT);

        $query->execute(["login" => $this->login, "email" => $this->email, "password" => $password]);

        $this->setAuthToken($this->login);
    }

    public function login($login, $password)
    {
        $login = trim(filter_var($login, FILTER_SANITIZE_STRING));
        $password = trim($password);

        $user = $this->getUser('login', $login);

        if (!isset($user['login']))
            return 'L\'utente con questo login non è registrato sul sito';
        else if (password_verify($password, $user['password'])) {
            $this->setAuthToken($login);

            return 'Correct';
        } else
            return 'Le password non combaciano';
    }

    public function logout($user_id)
    {
        $sql = "UPDATE `users` SET `auth_token` = NULL WHERE `id` = :id";
        $query = $this->_db->prepare($sql);
        $query->execute(['id' => $user_id]);

        setcookie('login', '', time() - 3600, '/');
        unset($_COOKIE['login']);
    }

    public function setAuthToken($login)
    {
        $this->auth_token = bin2hex(random_bytes(16));

        setcookie('login', $this->auth_token, time() + 3600, '/');

        $sql = "UPDATE `users` SET `auth_token` = :token WHERE login = :login";
        $query = $this->_db->prepare($sql);
        $query->execute([':token' => $this->auth_token, ':login' => $login]);
    }

    public function isAuthenticated()
    {
        if (isset($_COOKIE['login'])) {
            $user = $this->getUser('auth_token', $_COOKIE['login']);
            return $user ? true : false;
        }

        return false;
    }
}
