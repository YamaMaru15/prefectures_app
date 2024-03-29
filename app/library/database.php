<?php
declare(strict_types=1);

class DataBase {
    private static PDO $pdo;

    public static function getInstance(): PDO 
    {
        try{
            if(!isset(self::$pdo)) {
                self::$pdo = new PDO(
                DSN, 
                DB_USER, 
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
                );
            }   
            return self::$pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    
    /**
     * トランザクション開始
     *
     * @param なし
     * @return なし
     */
    public static function beginTransaction(): void
    {
        if (self::getInstance()->inTransaction()) {
            return;
        }
        self::getInstance()->beginTransaction();
    }

    /**
     * コミット
     *
     * @param なし
     * @return なし
     */
    public static function commit(): void
    {
        if (!self::getInstance()->inTransaction()) {
            return;
        }
        self::getInstance()->commit();
    }

    /**
     * ロールバック
     *
     * @param なし
     * @return なし
     */
    public static function rollback(): void
    {
        if (!self::getInstance()->inTransaction()) {
            return;
        }
        self::getInstance()->rollback();
    }

    /**
     * SQLを実行して結果を取得する（select）
     * (結果が1行の場合はこちらを使用)
     *
     * @param string $sql 実行SQL
     * @param array $param 実行SQLに渡すパラメータ
     * @return array | bool SQL実行結果配列
     */
    public static function fetch(string $sql, array $param = []): array | bool
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * SQLを実行して結果を取得する（select）
     * (結果が2行以上の場合はこちらを使用)
     *
     * @param string $sql 実行SQL
     * @param array $param 実行SQLに渡すパラメータ
     * @return array SQL実行結果配列
     */
    public static function fetchAll(string $sql, array $param = []): array
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * SQLを実行する（delete,insert,update）
     *
     * @param string $sql 実行SQL
     * @param array $param 実行SQLに渡すパラメータ
     * @return bool SQL実行結果
     */
    public static function execute(string $sql, array $param = []): bool
    {
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($param);
    }
}

?>