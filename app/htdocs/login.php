<?php

declare(strict_types=1);


require_once(dirname(__DIR__) . "/library/common.php");

if (Auth::isLoggedIn()) {
    redirect("prefectures_search.php");
}

$loginId = "";
$password = "";
$errorMessage = "";

if (isPost()) {
    $loginId = $_POST['login_id'] ?? '';
    $password = $_POST['password'] ?? '';

    if (Auth::login($loginId, $password)) {
        redirect("prefectures_search.php");
    } else {
        $errorMessage .= "ログインID、またはパスワードに誤りがあります。";
    }
}

$title = "ログイン";
require_once(TEMPLATE_DIR . "login.php");