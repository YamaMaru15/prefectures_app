<?php
declare(strict_types=1);

/**
 * 必須チェック
 *
 * @param string $str
 * @return bool true:入力値アリ／false:未入力
 */
function validateRequired(string $str): bool
{
    if ($str === '') {
        return false;
    }
    return true;
}

/**
 * 最大文字数チェック
 *
 * @param string $str
 * @param int $length 指定文字数
 * @return bool true:指定文字数以内／false:指定文字数を超える
 */
function validateMaxLength(string $str, int $length): bool
{
    return mb_strlen($str, 'UTF-8') <= $length;
}

/**
 * 日付(yyyy-mm-dd)チェック
 *
 * @param string $str
 * @return bool true:日付として正しい／false:日付として正しくない
 */
function validateDate(string $str): bool
{
    if (!preg_match('/\A[0-9]{4}-[0-9]{2}-[0-9]{2}\z/', $str)) {
        return false;
    } else {
        //-で分割されたそれぞれの文字列が日付として妥当であるか
        list($year, $month, $day) = explode('-', $str);
        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            return false;
        }
    }
    return true;
}

/**
 * 都道府県チェック
 *
 * @param string $str
 * @return bool true:都道府県として正しい／false:都道府県として正しくない
 */
function validatePrefecture(string $str): bool
{
    if (!in_array($str, PREFECTURE_LISTS)) {
        return false;
    } else if (in_array($str, REGION_LISTS)) {
        return false;
    }
    return true;
}

/**
 * 地方チェック
 *
 * @param string $str
 * @return bool true:地方として正しい／false:地方として正しくない
 */
function validateRegion(string $str): bool
{
    if (!in_array($str, REGION_LISTS)) {
        return false;
    }
    return true;
}

/**
 * 滞在レベルチェック
 *
 * @param string $str
 * @return bool true:滞在レベルとして正しい／false:滞在レベルとして正しくない
 */
function validateStayLevel(string $str): bool
{
    if (!in_array($str, STAY_LEVEL_LISTS)) {
        return false;
    }
    return true;
}

/**
 * 全件検索ワードチェック
 *
 * @param string $str
 * @return bool true:除外すべき文字が含まれていない／false:除外すべき文字が含まれている
 */
function allSearchCheck(string $str): bool
{
    if ($str != "全ての記録を見る" ) {
        return false;
    }
    return true;
}


