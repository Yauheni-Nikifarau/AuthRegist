<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once ROOT . '/app/classes/UsersJsonDataBase.php';
require_once ROOT . '/app/classes/Authorization.php';
require_once ROOT . '/app/php/functions.php';
require_once ROOT . '/app/classes/Users.php';


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'logout':
            Authorization::logout();
            break;
        case 'login':
            if (isset($_POST['login']) && isset($_POST['password']) && Authorization::login($_POST['login'], $_POST['password'])) {
                header('location: /');
                die();
            } else {
                renderPage('logerror');
                die();
            }
            break;
        case 'register':
            if (isset($_POST['login']) && isset($_POST['password'])) {
                Authorization::registration($_POST['login'], $_POST['password']);
                header('location: /');
                die();
            } else {
                renderPage('register');
                die();
            }
            break;   
    }
}




if (checkAuth()) {
    $name = $_COOKIE['login'];
    $group = $_COOKIE['group'];
    renderPage('logsuccess' , $name, $group);
    die();
} else {
    renderPage('login');
}
























/*$data = [
    'user_0' => [
        "login" => 'alex',
        'group' => 'admin',
        'password' => password_hash('12345', PASSWORD_DEFAULT)
    ],

    'user_1' => [
        "login" => 'bob',
        'group' => 'moderator',
        'password' => password_hash('12345', PASSWORD_DEFAULT)
    ],

    'user_2' => [
        "login" => 'serg',
        'group' => 'user',
        'password' => password_hash('12345', PASSWORD_DEFAULT)
    ],

    'user_3' => [
        "login" => 'robert',
        'group' => 'user',
        'password' => password_hash('12345', PASSWORD_DEFAULT)
    ]
    ];

$data = json_encode($data);
file_put_contents(ROOT . '/app/data/users.json', $data);*/