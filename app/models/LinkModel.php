<?php

require_once 'DB.php';

class LinkModel
{
    private $link = '';
    private $alias = '';

    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function validateLink($link, $alias, $user_id)
    {
        $this->link = trim(filter_var($link, FILTER_SANITIZE_URL));
        $this->alias = trim(filter_var($alias, FILTER_SANITIZE_STRING));

        if (!filter_var($this->link, FILTER_VALIDATE_URL))
            return 'L\'URL che hai fornito non è nel formato corretto';
        else if (strlen($this->alias) < 1)
            return 'Un alias per un URL deve contenere almeno un carattere';
        else if ($this->getLink($this->alias, $user_id))
            return 'Questa abbreviazione è già utilizzata nel database';
        else
            return 'Correct';
    }

    public function addLink($user_id)
    {
        $sql = "INSERT INTO `links`(`link`, `alias`, `user_id`) VALUES (:link, :alias, :user_id);";
        $query = $this->_db->prepare($sql);
        $query->execute(["link" => $this->link, "alias" => $this->alias, "user_id" => $user_id]);
    }

    public function getAllUserLinks($user_id)
    {
        $sql = "SELECT * FROM `links` WHERE `user_id` = :user_id ORDER BY `id` ASC;";
        $query = $this->_db->prepare($sql);
        $query->execute(["user_id" => $user_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLink($alias, $user_id)
    {
        $sql = "SELECT * FROM `links` WHERE `alias` = :alias AND `user_id` = :user_id;";
        $query = $this->_db->prepare($sql);
        $query->execute(['alias' => $alias, 'user_id' => $user_id]);

        $link = $query->fetch(PDO::FETCH_ASSOC);

        return $link ? $link : [];
    }

    public function deleteLink($link_id)
    {
        $sql = "DELETE FROM `links` WHERE `id` = :id;";
        $query = $this->_db->prepare($sql);
        $query->execute(['id' => $link_id]);
    }
}
