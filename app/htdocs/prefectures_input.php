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

//POST通信
if (isPost()) {
    $prefecture = $_POST['prefecture'] ?? '';
    $region = $_POST['region'] ?? '';
    $stay_level = $_POST['stay_level'] ?? '';
    $visit_date = $_POST['visit_date'] ?? '';
    $purpose = $_POST['purpose'] ?? '';

    //trueならば登録ボタンが押されたということ
    $isSave = (isset($_POST['save']) && $_POST['save'] === '1') ? true : false;

    //trueならば既存データの更新ということ
    $isEdit = (isset($_POST['edit']) && $_POST['edit'] === '1') ? true : false;

    //記録検索画面の編集ボタン押下
    if ($isEdit === true && $isSave === false) {
        //POSTされた都道府県の入力チェック
        if (!validateRequired($prefecture)) { //空白でないか
            $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
        } else if (!validatePrefecture($prefecture)) { //正しい都道府県か
            $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
        } else if (!exceptionWords($prefecture)) { //全体検索のワードが含まれていないか
            $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
        } else {
            //存在する社員番号か 
            if (!Prefectures::isExists($prefecture)) {
                $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
            }
        }

        //入力チェックOKの場合
        if ($errorMessage === '') {
            //記録情報取得SQLの実行
            $prefectures= Prefectures::getByPrefectures($prefecture);

            $prefecture = $prefectures['prefecture'];
            $region = $prefectures['region'];
            $stay_level = $prefectures['stay_level'];
            $visit_date = $prefectures['visit_date'];
            $purpose = $prefectures['purpose'];
        } else {
            //エラー画面表示
            //headerphpのtitleで受け取り
            $title = "エラー";
            require_once(dirname(__DIR__) . "/template/error.php");
            exit; //処理強制終了
        }
    }


    // 登録ボタン押下
    if ($isSave === true) {
        //POSTされた都道府県名の入力チェック
        if (!validateRequired($prefectures)) { //空白でないか
            $errorMessage .= '都道府県名を選択してください。<br>';
        } else if (!validatePrefecture($prefecture)) { //正しい都道府県か
            $errorMessage .= '都道府県名が不正です。<br>';
        } else if (!exceptionWords($prefecture)) { //除外ワードが含まれていないか
            $errorMessage .= '都道府県名が不正です。<br>';
        } else {
            //(新規登録時)存在しない都道府県か
            //(更新時)存在する都道府県か
            $exists = Prefectures::isExists($prefecture);
        if ($isEdit === false && $exists) {
            //新規登録時に同一都道府県が存在したらエラー
            $errorMessage .= '記録済みの都道府県です。<br>';
        } else if ($isEdit === true && !$exists) {
            //更新時に同一都道府県が存在しなかったらエラー
            $errorMessage .= '記録がない都道府県です。<br>';
        }
        }

        
        // POSTされた都道府県をもとに対応する地方を登録
        if (!regionJudgment($prefecture) === '') {
            $region = regionJudgment($prefecture);
        } else {
            $errorMessage .= '地方が不正です。<br>';
        }
        
        // POSTされた滞在レベルの入力チェック
        if (!validateRequired($stay_level)) { //空白でないか
            $errorMessage .= '滞在レベルを選択してください。<br>';
        } else if (!validateStayLevel($stay_level)) { //正しい滞在レベルか
            $errorMessage .= '滞在レベルが不正です。<br>';
        } else if (!exceptionWords($stay_level)) { //除外ワードが含まれていないか
            $errorMessage .= '滞在レベルが不正です。<br>';
        }

        // POSTされた訪問日の入力チェック
        if (!validateRequired($visit_date)) { //空白でないか
            $errorMessage .= '訪問日を入力してください。<br>';
        } else if (!validateDate($visit_date)) { //正しい都道府県か
            $errorMessage .= '訪問日が不正です。<br>';
        }
        
        // POSTされた訪問理由の入力チェック
        if (!validateRequired($purpose)) { //空白でないか
            $errorMessage .= '訪問理由を入力してください。<br>';
        } else if (!validateMaxLength($purpose, 255)) { //文字数が255文字以内であるか
            $errorMessage .= '訪問理由は255文字以内で入力してください。<br>';
        }

        //入力チェックOK?
        if ($errorMessage === '') {
            // echo "エラーなし";
            //トランザクション開始
            Database::beginTransaction();
            //新規登録判定
            if ($isEdit === false) {
              //新規登録
              //社員情報登録SQLの実行
                Prefectures::insert(
                $prefecture,
                $region,
                $stay_level,
                $visit_date,
                $purpose,
            );
        } else {
              //更新
              //社員情報更新SQLの実行
            Prefectures::update(
                $prefecture,
                $region,
                $stay_level,
                $visit_date,
                $purpose,
            );
            }
            
        //コミット
        Database::commit();

        $successMessage = "登録完了しました。";
        $isEdit = true;
        }
    }
}

//headerphpのtitleで受け取り
$title = "社員登録";
//Templateの読み込み
require_once(TEMPLATE_DIR. "prefectures_input.php");



?>
