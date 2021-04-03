<?php
require_once ROOT . '/app/classes/JsonDataBase.php';
class UsersJsonDataBase extends JsonDataBase
{
    public function search ($login) {
        $users = $this->takeData();
        foreach ($users as $user) {
            if ($user['login'] == $login) {
                return $user;
            }
        }
        return false;
    }

    public function add ($login, $password) {
        $users = $this->takeData();
        $id = $this->getMaxId() + 1;
        $id = 'user_' . $id;
        $users[$id] = [
            "login" => $login,
            'group' => 'user',
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $this->putData($users);
    }

    private function getMaxId () {
        $users = $this->takeData();
        $index = -1;
        foreach ($users as $id => $user) {
            $indexOfseparator = strripos($id, '_');
            $id = substr($id, $indexOfseparator+1);
            if ($id > $index) $index = $id;
        }
        return $index;
    }
}