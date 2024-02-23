<?php
declare(strict_types=1);

// データベースにアクセスするための準備、定数定義
define('DSN', 'mysql:dbname=prefectures_app;host=localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
//define('SITE_URL', 'http://localhost/prefectures_app/public/VisitRecord/index.php');
// define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);


define("STAY_LEVEL_LISTS", [
    //"--全ての記録を見る--",
    "未訪問",
    "尋ねた・通過した",
    "旅行（日帰り）",
    "旅行（宿泊）",
    "暮らした",
]);

define("PREFECTURE_LISTS", [
    //"--全ての記録を見る--",
    "北海道地方",
    "　北海道",
    "東北地方",
    "　青森県",
    "　岩手県",
    "　宮城県",
    "　秋田県",
    "　山形県",
    "　福島県",
    "関東地方",
    "　東京都",
    "　茨城県",
    "　栃木県",
    "　群馬県",
    "　埼玉県",
    "　千葉県",
    "　神奈川県",
    "中部地方",
    "　新潟県",
    "　富山県",
    "　石川県",
    "　福井県",
    "　山梨県",
    "　長野県",
    "　岐阜県",
    "　静岡県",
    "　愛知県",
    "近畿地方",
    "　京都府",
    "　大阪府",
    "　三重県",
    "　滋賀県",
    "　兵庫県",
    "　奈良県",
    "　和歌山県",
    "中国地方",
    "　鳥取県",
    "　島根県",
    "　岡山県",
    "　広島県",
    "　山口県",
    "四国地方",
    "　徳島県",
    "　香川県",
    "　愛媛県",
    "　高知県",
    "九州地方",
    "　福岡県",
    "　佐賀県",
    "　長崎県",
    "　大分県",
    "　熊本県",
    "　宮崎県",
    "　鹿児島県",
    "　沖縄県",
]);

define("REGION_LISTS", [
    //"--全ての記録を見る--",
    "北海道地方",
    "東北地方",
    "関東地方",
    "中部地方",
    "近畿地方",
    "中国地方",
    "四国地方",
    "九州地方",
]);

define("REGION_NORTH_EAST", [
    "青森県",
    "岩手県",
    "宮城県",
    "秋田県",
    "山形県",
    "福島県",
]);

define("REGION_EAST", [
    "東京都",
    "茨城県",
    "栃木県",
    "群馬県",
    "埼玉県",
    "千葉県",
    "神奈川県",
]);

define("REGION_CENTRAL", [
    "新潟県",
    "富山県",
    "石川県",
    "福井県",
    "山梨県",
    "長野県",
    "岐阜県",
    "静岡県",
    "愛知県",
]);

define("REGION_PROXIMAL", [
    "京都府",
    "大阪府",
    "三重県",
    "滋賀県",
    "兵庫県",
    "奈良県",
    "和歌山県",
]);

define("REGION_CHINA", [
    "鳥取県",
    "島根県",
    "岡山県",
    "広島県",
    "山口県",
]);

define("REGION_FOUR", [
    "徳島県",
    "香川県",
    "愛媛県",
    "高知県",
]);

define("REGION_NINE", [
    "福岡県",
    "佐賀県",
    "長崎県",
    "大分県",
    "熊本県",
    "宮崎県",
    "鹿児島県",
    "沖縄県",
]);
