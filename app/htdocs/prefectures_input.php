<?php
declare(strict_types=1);

require_once(dirname(__DIR__) . "/library/common.php");

$prefecture = '';
$region = '';
$stay_level = '';
$visit_date = '';
$purpose = '';
$errorMessage = '';
$successMessage = '';
$isEdit = false;
$isSave = false;

if (isPost()) {
    $prefecture = $_POST['prefecture'] ?? '';
    $region = $_POST['region'] ?? '';
    $stay_level = $_POST['stay_level'] ?? '';
    $visit_date = $_POST['visit_date'] ?? '';
    $purpose = $_POST['purpose'] ?? '';
    $isSave = (isset($_POST['save']) && $_POST['save'] === '1') ? true : false;
    $isEdit = (isset($_POST['edit']) && $_POST['edit'] === '1') ? true : false;

    if ($isEdit === true && $isSave === false) {
        if (!validateRequired($prefecture)) { 
            $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
        } else if (!validatePrefecture($prefecture)) { 
            $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
        } else {
            if (!Prefectures::isExists($prefecture)) {
                $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
            }
        }

        if ($errorMessage === '') {
            $prefectures= Prefectures::getByPrefectures($prefecture);
            $prefecture = $prefectures['prefecture'];
            $region = $prefectures['region'];
            $stay_level = $prefectures['stay_level'];
            $visit_date = $prefectures['visit_date'];
            $purpose = $prefectures['purpose'];
        } else {
            $title = "エラー";
            require_once(dirname(__DIR__) . "/template/error.php");
            exit;
        }
    }

    if ($isSave === true) {
        if (!validateRequired($prefecture)) { 
            $errorMessage .= '都道府県名を選択してください。<br>';
        } else if (!validatePrefecture($prefecture)) { 
            $errorMessage .= '都道府県名が不正です。<br>';
        } else {
            $exists = Prefectures::isExists($prefecture);
        if ($isEdit === false && $exists) {
            $errorMessage .= '記録済みの都道府県です。<br>';
        } else if ($isEdit === true && !$exists) {
            $errorMessage .= '記録がない都道府県です。<br>';
        }
        }
        
        if (!regionJudgment($prefecture) === '') {
            $errorMessage .= '地方が不正です。<br>';
        } else {
            $region = regionJudgment($prefecture);
        }
        
        if (!validateRequired($stay_level)) {
            $errorMessage .= '滞在レベルを選択してください。<br>';
        } else if (!validateStayLevel($stay_level)) {
            $errorMessage .= '滞在レベルが不正です。<br>';
        }

        if (!validateRequired($visit_date)) {
            $errorMessage .= '訪問日を入力してください。<br>';
        } else if (!validateDate($visit_date)) {
            $errorMessage .= '訪問日が不正です。<br>';
        }
        
        if (!validateRequired($purpose)) {
            $errorMessage .= '訪問理由を入力してください。<br>';
        } else if (!validateMaxLength($purpose, 255)) {
            $errorMessage .= '訪問理由は255文字以内で入力してください。<br>';
        }

        if ($errorMessage === '') {
            Database::beginTransaction();
            if ($isEdit === false) {
                Prefectures::insert(
                $prefecture,
                $region,
                $stay_level,
                $visit_date,
                $purpose,
            );
        } else {
            Prefectures::update(
                $prefecture,
                $region,
                $stay_level,
                $visit_date,
                $purpose,
            );
        }    
        Database::commit();
        $successMessage = "登録完了しました。";
        $isEdit = true;
        }
    }
}

$title = "社員登録";
require_once(TEMPLATE_DIR. "prefectures_input.php");

?>
