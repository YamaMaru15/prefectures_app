<?php
declare(strict_types=1);

class Prefectures
{
    /**
     * 都道府県名をキーに都道府県記録が存在するか判定する
     *
     * @param string $prefectures 都道府県名
     * @return bool true:存在する／false:存在しない
     */
    public static function isExists(string $prefectures): bool
    {
        $sql = "SELECT COUNT(*) AS count FROM visit_records WHERE prefectures = :prefectures";
        $param = ["prefectures" => $prefectures];
        $count = DataBase::fetch($sql, $param);
        if ($count["count"] >= 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 都道府県名をキーに記録情報を取得する
     *
     * @param string $prefectures 都道府県名
     * @return array SQL実行結果配列
     */
    public static function getByPrefectures(string $prefectures): array
    {
        $sql = "SELECT * FROM visit_records WHERE prefectures = :prefectures";
        $param = ["prefectures" => $prefectures];
        return DataBase::fetch($sql, $param);
    }

    /**
     * 都道府県名をキーに記録を削除する
     *
     * @param string $prefectures 都道府県名
     * @return bool SQL実行結果
     */
    public static function deleteByPrefectures(string $prefectures): bool
    {
        $sql = "DELETE FROM visit_records` WHERE prefectures = :prefectures";
        $param = ["prefectures" => $prefectures];
        return DataBase::execute($sql, $param);
    }
    /**
     * 検索条件にヒットした記録件数を取得する
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @return string SQL実行結果
     */
    public static function searchCount(
        string $prefecture, string $region, string $stay_level, string $visit_date
    ): string | int
    {
        list($whereSql, $param) =
            self::getSearchWhereSqlAndParam($prefecture, $region, $stay_level, $visit_date);
        $sql = "SELECT COUNT(*) AS count FROM visit_records WHERE 1 = 1 {$whereSql}";
        $count = DataBase::fetch($sql, $param);
        return $count["count"];
    }

    /**
     * 検索条件にヒットした記録情報を取得する
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @return array SQL実行結果
     */
    public static function searchData(
        string $prefecture, string $region, string $stay_level, string $visit_date
    ): array
    {
        list($whereSql, $param) = 
            self::getSearchWhereSqlAndParam($prefecture, $region, $stay_level, $visit_date);
        $sql = "SELECT * FROM visit_records WHERE 1 = 1 {$whereSql} ORDER BY visit_date";
        return DataBase::fetchAll($sql, $param);
    }

    /**
     * 記録情報を登録する
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @param string $purpose 訪問理由
     * @return bool SQL実行結果
     */
    public static function insert(
        string $prefecture,
        string $region,
        string $stay_level,
        string $visit_date,
        string $purpose
    ): bool {
        $sql  = "INSERT INTO visit_records ( ";
        $sql .= "  prefecture, ";
        $sql .= "  region, ";
        $sql .= "  stay_level, ";
        $sql .= "  visit_date, ";
        $sql .= "  purpose, ";
        $sql .= ") VALUES (";
        $sql .= "  :prefecture, ";
        $sql .= "  :region, ";
        $sql .= "  :stay_level, ";
        $sql .= "  :visit_date, ";
        $sql .= "  :purpose, ";
        $sql .= ")";

        $param = [
            "prefecture" => $prefecture,
            "namregione" => $region,
            "stay_level" => $stay_level,
            "visit_date" => $visit_date,
            "purpose" => $purpose
        ];
        return DataBase::execute($sql, $param);
    }

    /**
     * 記録情報を更新する
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @param string $purpose 訪問理由
     * @return bool SQL実行結果
     */
    public static function update(
        string $prefecture,
        string $region,
        string $stay_level,
        string $visit_date,
        string $purpose
    ): bool {
        $sql  = "UPDATE visit_records ";
        $sql .= "SET prefecture = :prefecture, ";
        $sql .= "  region = :region, ";
        $sql .= "  stay_level = :stay_level, ";
        $sql .= "  visit_date = :visit_date, ";
        $sql .= "  purpose = :purpose, ";
        $sql .= "WHERE prefecture = :prefecture ";

        $param = [
            "prefecture" => $prefecture,
            "namregione" => $region,
            "stay_level" => $stay_level,
            "visit_date" => $visit_date,
            "purpose" => $purpose
        ];
        return DataBase::execute($sql, $param);
    }

    /**
     * 検索条件SQL生成
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @return array WHERE句のSQL, SQLに渡すパラメータ
     */
    private static function getSearchWhereSqlAndParam(
        $prefecture,
        $region,
        $stay_level,
        $visit_date
    ): array
    {
        $whereSql = '';
        $param = [];
        // 都道府県、地方、滞在レベルに「--すべての記録を見る--」が含まれる　かつ
        // 訪問日が空白の場合は全件検索
        // 都道府県に「--すべての記録を見る--」入力されているか
        if ($prefecture !== '全ての記録を見る') {
            // 検索条件に都道府県を追加
            $whereSql .= 'AND prefecture = :prefecture ';
            $param['prefecture'] = $prefecture;
        }
        // 地方に「--すべての記録を見る--」が入力されているか
        if ($region !== '全ての記録を見る') {
            // 検索条件に地方を追加
            $whereSql .= 'AND region = :region ';
            $param['region'] = $region;
        }
        // 滞在に「--すべての記録を見る--」レベルが入力されているか
        if ($stay_level !== '全ての記録を見る') {
            // 検索条件に滞在レベルを追加
            $whereSql .= 'AND stay_level = :stay_level ';
            $param['stay_level'] = $stay_level;
        }
        // 訪問日が入力されている
        if ($visit_date !== '') {
            // 検索条件に訪問日を追加
            $whereSql .= 'AND visit_date = :visit_date ';
            $param['visit_date'] = $visit_date;
        }
        return [$whereSql, $param];
    }
}

?>