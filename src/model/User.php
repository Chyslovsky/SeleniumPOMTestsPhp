<?php
namespace model;

class User
{
    private $login='';
    private $password='';

    /**
     * User constructor.
     * @param $login
     * @param $password
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getLogin()
    {
        return $this->login;
    }



    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }


}