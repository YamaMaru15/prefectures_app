<?php declare(strict_types=1); ?>
<?php require_once(TEMPLATE_DIR . "header.php"); ?>


<?php //var_dump($prefecture); ?>
<div class="clearfix">
  <?php require_once(TEMPLATE_DIR . "menu.php"); ?>

  <div id="main">
    <h3 id="title">都道府県　記録登録画面</h3>

    <div id="input_area">
      <form action="prefectures_input.php" method="POST">
        <p><strong>記録情報を入力してください。全て必須です。</strong></p>

        <?php //メッセージ表示 ?>
        <?php if ($errorMessage !== '') { ?>
          <p class="error_message"><?= $errorMessage; ?></p>
        <?php } ?>
        <?php if ($successMessage !== '') { ?>
          <p class="success_message"><?= $successMessage; ?></p>
        <?php } ?>

        <?php //各入力項目表示 ?>
        <table>
          <tbody>
            <tr>
              <td>都道府県</td>
              <?php // (新規登録時)都道府県名入力可 ?>
              <?php // (更新時)都道府県名入力不可 ?>
              <td>
                <?php if ($isEdit === false) { ?>
                  <select name="prefecture">
                    <?php foreach(PREFECTURE_LISTS as $prefecture_value) { ?>
                      <option value="<?= $prefecture_value; ?>"
                      <?= $prefecture === $prefecture_value ? "selected" : ""; ?>
                      <?= mb_strpos($prefecture_value, "地方") !== false ? "disabled" : ""; ?>
                      <?= mb_strpos($prefecture_value, "--全ての記録を見る--") !== false ? "disabled" : ""; ?>>
                      <?= $prefecture_value; ?></option>
                    <?php } ?>
                  </select>
                <?php } else { ?>
                  <select name="prefecture">
                    <option value="<?= Utils::h($prefecture_value); ?>" disabled 
                    <?= $prefecture === $prefecture_value ? "selected" : ""; ?> >
                  </select>
                  <input type="hidden" name="prefecture" 
                    value="<?= Utils::h($prefecture_value); ?>" />
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td>滞在レベル</td>
              <td>
                <select name="stay_level">
                  <?php foreach(STAY_LEVEL_LISTS as $level_value) { ?>
                    <option value="<?= $level_value; ?>"
                    <?= $stay_level === $level_value ? "selected" : ""; ?>>
                    <?= $level_value; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>訪問日</td>
              <td>
                <input type="date" name="visit_date" value="<?= Utils::h($visit_date); ?>" />
              </td>
            </tr>
            <tr>
              <td>訪問理由</td>
              <td>
                <textarea name="purpose" value="<?= Utils::h($purpose); ?>" rows="5" cols="33" ></textarea>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="clearfix">
          <div class="input_area_right">
            <input type="hidden" name="save" value="1" />
            <input type="hidden" name="edit" 
              value="<?= $isEdit === true ? "1" : ""; ?>" />
            <input type="submit" id="input_button" value="登録">
            <input type="button" id="back_button" value="戻る" onclick="location.href='prefectures_search.php'; return false;">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once(TEMPLATE_DIR . "footer.php"); ?>
