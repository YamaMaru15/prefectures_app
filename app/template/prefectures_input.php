<?php declare(strict_types=1); ?>
<?php require_once(TEMPLATE_DIR . "header.php"); ?>


<div class="clearfix">
  <?php require_once(TEMPLATE_DIR . "menu.php"); ?>
  <div id="main">
    <h3 id="title">都道府県　記録登録画面</h3>
    <div id="input_area">
      <form action="prefectures_input.php" method="POST">
        <p><strong>記録情報を入力してください。全て必須入力です。</strong></p>
        <?php if ($errorMessage !== '') { ?>
          <p class="error_message"><?= $errorMessage; ?></p>
        <?php } ?>
        <?php if ($successMessage !== '') { ?>
          <p class="success_message"><?= $successMessage; ?></p>
        <?php } ?>

        <table>
          <tbody>
            <tr>
              <td>都道府県</td>
              <td>
                <?php if ($isEdit === false) { ?>
                  <select name="prefecture">
                    <option value="<?= Utils::h(''); ?>">選択してください</option>
                    <?php foreach(PREFECTURE_LISTS as $prefecture_value) { ?>
                      <option value="<?= Utils::h($prefecture_value); ?>"
                      <?= $prefecture === $prefecture_value ? "selected" : ""; ?>
                      <?= mb_strpos($prefecture_value, "地方") !== false ? "disabled" : ""; ?>>
                      <?= $prefecture_value; ?></option>
                    <?php } ?>
                  </select>
                <?php } else { ?>
                  <select name="prefecture">
                      <option value="<?= Utils::h($prefecture); ?>"><?= $prefecture; ?></option>
                  </select>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td>滞在レベル</td>
              <td>
                <select name="stay_level">
                  <option value="<?= Utils::h(''); ?>">選択してください</option>
                  <?php foreach(STAY_LEVEL_LISTS as $level_value) { ?>
                    <option value="<?= Utils::h($level_value); ?>"
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
                <textarea name="purpose" value="<?= Utils::h($purpose); ?>" rows="10" cols="50" ><?= $purpose ?></textarea>
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
