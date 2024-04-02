<?php
declare(strict_types=1);

require_once(dirname(__DIR__) . "/library/common.php");

Auth::logout();

redirect("login.php");


