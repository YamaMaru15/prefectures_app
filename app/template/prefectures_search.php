<?php declare(strict_types=1); ?>
<?php require_once(TEMPLATE_DIR . "header.php"); ?>

<div class="clearfix">
<?php require_once(TEMPLATE_DIR . "menu.php"); ?>

    <div id="main">
        <h3 id="title">都道府県　記録検索画面</h3>

        <div id="search_area">
            <div id="sub_title">検索条件</div>
            <form action="prefectures_search.php" method="GET">
                <div id="form_area">
                    <div class="clearfix">
                        <div class="input_area">
                            <span class="input_label">都道府県</span>
                            <select name="prefecture">
                                <option value="<?= Utils::h('全ての記録を見る'); ?>">全ての記録を見る</option>
                                <?php foreach(PREFECTURE_LISTS as $prefecture_value) { ?>
                                    <option value="<?= Utils::h($prefecture_value); ?>"
                                    <?= $prefecture === $prefecture_value ? "selected" : ""; ?>
                                    <?= mb_strpos($prefecture_value, "地方") !== false ? "disabled" : ""; ?>>
                                    <?= $prefecture_value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input_area">
                            <span class="input_label">地方</span>
                            <select name="region">
                            <option value="<?= Utils::h('全ての記録を見る'); ?>">全ての記録を見る</option>
                                <?php foreach(REGION_LISTS as $region_value) { ?>
                                    <option value="<?= Utils::h($region_value); ?>"
                                    <?= $region === $region_value ? "selected" : ""; ?>>
                                    <?= $region_value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input_area">
                            <span class="input_label">滞在レベル</span>
                            <select name="stay_level">
                            <option value="<?= Utils::h('全ての記録を見る'); ?>">全ての記録を見る</option>
                                <?php foreach(STAY_LEVEL_LISTS as $level_value) { ?>
                                    <option value="<?= Utils::h($level_value); ?>"
                                    <?= $stay_level === $level_value ? "selected" : ""; ?>>
                                    <?= $level_value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input_area"><span class="input_label">訪問日</span>
                            <input type="date" name="visit_date" value="<?= Utils::h($visit_date); ?>" >
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="input_area_right"><input type="submit" id="search_button" value="検索"></div>
                    </div>
                </div>
            </form>
        </div>

    <?php if ($errorMessage !== '') { ?>
        <p class="error_message"><?= $errorMessage; ?></p>
    <?php } ?>

    <?php if ($successMessage !== '') { ?>
        <p class="success_message"><?= $successMessage; ?></p>
    <?php } ?>

        <div id="page_area">
            <div id="page_count"><?= Utils::h($count); ?> 件の記録があります。</div>
        </div>

        <div id="search_result">
            <table>
                <thead>
                    <tr>
                        <th>都道府県名</th>
                        <th>地方</th>
                        <th>滞在レベル</th>
                        <th>訪問日</th>
                        <th>訪問理由</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($count >= 1) { ?>
                        <?php foreach ($data as $row) {?>
                            <tr>
                                 <!-- //記録情報の表示 -->
                                <td><?= Utils::h($row["prefecture"]); ?></td>
                                <td><?= Utils::h($row["region"]); ?></td>
                                <td><?= Utils::h($row["stay_level"]); ?></td>
                                <td><?= Utils::h($row["visit_date"]); ?></td>
                                <td><?= Utils::h($row["purpose"]); ?></td>
                                <td class="button_area">
                                    <button class="edit_button"
                                        onclick="editRecord('<?= Utils::h($row["prefecture"]); ?>');">
                                        編集
                                    </button>
                                    <button class="delete_button"
                                        onclick="deleteRecord('<?= Utils::h($row["prefecture"]); ?>');">
                                        削除
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="prefectures_input.php" name="edit_form"  method="POST">
    <input type="hidden" name="prefecture" value="" />
    <input type="hidden" name="edit" value="1" />
</form>

<form action="prefectures_search.php" name="delete_form"  method="POST">
    <input type="hidden" name="prefecture" value="" />
    <input type="hidden" name="delete" value="1" />
</form>

<script src="./js/search.js"></script>

<?php require_once(TEMPLATE_DIR . "footer.php"); ?>

