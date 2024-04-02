<?php declare(strict_types=1); ?>

<?php require_once(TEMPLATE_DIR . "header.php"); ?>
<div id="login_main">
    <h3 id="title">ログイン画面</h3>

    <?php if ($errorMessage !== '') { ?>
        <p class="error_message"><?= $errorMessage; ?></p>
    <?php } ?>

    <div class="text_center">
    <form action="login.php" method="POST">
        <div id="login_area">
            <div class="mb20">
                <span class="input_label">ログインID</span>
                <input type="text" name="login_id" value="<?= Utils::h($loginId); ?>" />
            </div>
            <div class="mb20">
                <span class="input_label">パスワード</span>
                <input type="password" name="password" value="" />
            </div>

            <div>
                <div class="text_center"><input type="submit" id="login_button" value="ログイン"></div>
            </div>
        </div>
    </form>
    </div>
</div>
<?php require_once(TEMPLATE_DIR . "footer.php"); ?>