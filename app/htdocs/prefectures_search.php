<?php
declare(strict_types=1);

require_once(dirname(__DIR__) . "/library/common.php");

if (!Auth::isLoggedIn()) {
    redirect("login.php");
}

$errorMessage = '';
$successMessage = "";
$count = "";
$data = "";

if (isPost()) {
    $isDelete = (isset($_POST['delete']) && $_POST['delete'] === '1') ? true : false;
    if ($isDelete === true) {
        $deletePrefecture = isset($_POST['prefecture']) ? $_POST['prefecture'] : '';
        if (!validateRequired($deletePrefecture)) {
            $errorMessage .= '都道府県記録が不正です。<br>';
        } else if (!validatePrefecture($deletePrefecture)) {
            $errorMessage .= '都道府県記録が不正です。<br>';
        } else {
            if (!Prefectures::isExists($deletePrefecture)) {
                $errorMessage .= '都道府県記録が不正です。<br>';
            }
        }

        if ($errorMessage === '') {
            DataBase::beginTransaction();
            Prefectures::deleteByPrefectures($deletePrefecture);
            DataBase::commit();

            $successMessage = "削除完了しました。";
        } else {
            echo $errorMessage;
        }
    }
}

$prefecture = $_GET['prefecture'] ?? '全ての記録を見る';
$region = $_GET['region'] ?? '全ての記録を見る';
$stay_level = $_GET['stay_level'] ?? '全ての記録を見る';
$visit_date = $_GET['visit_date'] ?? '';

if (!allSearchCheck($prefecture)) {
    if (!validatePrefecture($prefecture)) {
        $errorMessage .= '都道府県が不正です。<br>';
    }
}

if (!allSearchCheck($region)) {
    if (!validateRegion($region)) {
        $errorMessage .= '地方が不正です。<br>';
    }
}

if (!allSearchCheck($stay_level)) {
    if (!validateStayLevel($stay_level)) {
        $errorMessage .= '滞在レベルが不正です。<br>';
    }
}

if ($visit_date != "") {
    if (!validateDate($visit_date)) {
        $errorMessage .= '訪問日が不正です。<br>';
    }
}

if ($errorMessage === '') {
    $count = Prefectures::searchCount($prefecture, $region, $stay_level, $visit_date);
    $data = Prefectures::searchData($prefecture, $region, $stay_level, $visit_date);
}

$title = "記録検索";
require_once(TEMPLATE_DIR . "prefectures_search.php");

?>

