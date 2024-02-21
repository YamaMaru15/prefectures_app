<?php

/**
 * POST通信かを判定する
 *
 * @param なし
 * @return bool true:POST通信／false:POST通信以外
 */
function isPost(): bool
{
    return mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post';
}

/**
 * 強制リダイレクト
 *
 * @param srting $url リダイレクト先URL
 * @return なし
 */
function redirect(string $url): void
{
    header("Location: {$url}");
    exit();
}


/**
 * 都道府県に合った地方を判定して返す
 *
 * @param srting $str 都道府県名
 * @return string 都道府県に対応した地方
 */
function regionJudgment(string $str): string
{
    if ($str === '北海道') {
        return "北海道地方";
    }
    if (in_array($str, REGION_NORTH_EAST)) {
        return "東北地方";
    }
    if (in_array($str, REGION_EAST)) {
        return "関東地方";
    }
    if (in_array($str, REGION_CENTRAL)) {
        return "中部地方";
    }
    if (in_array($str, REGION_PROXIMAL)) {
        return "近畿地方";
    }
    if (in_array($str, REGION_CHINA)) {
        return "中国地方";
    }
    if (in_array($str, REGION_FOUR)) {
        return "四国地方";
    }
    if (in_array($str, REGION_NINE)) {
        return "九州地方";
    }
    return '';

}


?>