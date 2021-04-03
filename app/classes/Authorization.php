<?php
final class Authorization 
{
    static public function registration ($login, $password)
    {
        $dataBase = new UsersJsonDataBase(ROOT . '/app/data/users.json');
        $dataBase->add($login, $password);
    }

    static public function login ($login, $password)
    {
        $dataBase = new UsersJsonDataBase(ROOT . '/app/data/users.json');
        $user = $dataBase->search($login);
        if ($user !== false) {
            if (password_verify($password, $user['password'])) {
                setcookie('auth', 'true', time() + 3600, '/');
                setcookie('login', $user['login'], time() + 3600, '/');
                setcookie('group', $user['group'], time() + 3600, '/');
                return true;
            } else {
                return false;
            }
            
        } else {
            return false;
        }
    }

    static public function logout ()
    {
        setcookie('auth', 0, time() - 3600, '/');
        setcookie('login', 0, time() - 3600, '/');
        setcookie('group', 0, time() - 3600, '/');
        header('location: /');
        die();
    }

    static public function get ()
    {
        //code
    }
}