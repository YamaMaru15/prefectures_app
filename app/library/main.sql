-- prefectures_app
-- 訪問記録テーブル
CREATE TABLE visit_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prefecture VARCHAR(255),
    region VARCHAR(255),
    stay_level VARCHAR(255),
    visit_date DATE,
    purpose VARCHAR(255)
);
