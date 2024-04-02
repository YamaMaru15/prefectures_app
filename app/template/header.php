<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title><?= $title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<link rel="stylesheet" type="text/css" href="/prefectures_app/app/htdocs/css/style.css" />
</head>
<body>

<div id="header">
    <h1>
        <div class="clearfix">
            <div class="f1">
                都道府県記録アプリ
            </div>
            <?php if (isset($_SESSION["name"])) { ?>
                <div class="fr">
                    <span class="font14">
                        <?= "ようこそ " . Utils::h($_SESSION["name"]) . " さん"; ?>
                        <a class="text_red" href="logout.php">ログアウト</a>
                    </span>
                </div>
            <?php } ?> 
        </div>
    </h1>
</div>