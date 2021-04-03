<?php 
function renderPage($content, $name = '', $group = '') {
    $content = ROOT . '/app/view/' . $content . '.php';
    require_once ROOT . '/app/view/templateCommon.php';
}

function checkAuth () {
    if (isset($_COOKIE['auth']) &&
    isset($_COOKIE['login']) &&
    isset($_COOKIE['group']) &&
    $_COOKIE['auth'] == 'true') {
        return true;
    } else {
        return false;
    }
}