<?= $this->extend('layout/default') ?>
<?= $this->section('main') ?>
<div class="login">
    <div class="top-nav">
        <a href="<?= site_url('/') ?>" class="back">
            <span class="material-icons-round">navigate_before</span>
            <span>返回首页</span>
        </a>
    </div>
    <?php if ($action === 'register') : ?>
        <div class="alert">注册为本站点用户</div>
    <?php endif; ?>
    <?php if (isset($errors)) : ?>
        <div class="alert error">
            <?php foreach ($errors as  $error) : ?>
                <div class="alert-item">
                    <strong>错误：</strong>
                    <p><?= esc($error) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form class="loginform" action="<?= current_url() ?>" method="post">
        <input type="hidden" name="code" value="<?= $code ?>">
        <?php if ($action === 'login') : ?>
            <div class="label-input">
                <label for="account">用户名或邮箱</label>
                <input class="input" type="text" name="account" value="<?= old('account') ?>">
            </div>
            <div class="label-input">
                <label for="password">密码</label>
                <input class="input" type="password" name="password">
            </div>
        <?php elseif ($action === 'register') : ?>
            <div class="label-input">
                <label for="username">用户名</label>
                <input class="input" type="text" name="username">
            </div>
            <div class="label-input">
                <label for="email">邮箱</label>
                <input class="input" type="text" name="email">
            </div>
            <div class="label-input">
                <label for="password">密码</label>
                <input class="input" type="password" name="password">
            </div>
            <div class="label-input">
                <label for="confirmPassword">确认密码</label>
                <input class="input" type="password" name="confirmPassword">
            </div>
        <?php elseif ($action === 'resetPasswordSendEmail') : ?>
            <input type="hidden" name="action" value="<?= $action ?>">
            <div class="label-input">
                <label for="email">用户名或邮箱</label>
                <input class="input" type="text" name="account" value="<?= old('account') ?>">
            </div>
        <?php elseif ($action === 'resetPasswordSuccess') : ?>
            <input type="hidden" name="action" value="<?= $action ?>">
            <input type="hidden" name="uid" value="<?= $uid ?>">
            <div class="label-input">
                <label for="password">新密码</label>
                <input class="input" type="password" name="password">
            </div>
            <div class="label-input">
                <label for="confirmPassword">确认新密码</label>
                <input class="input" type="password" name="confirmPassword">
            </div>
        <?php endif; ?>
        <button class="submit" type="submit">
            <?php if ($action === 'login') : ?>
                立即登录
            <?php elseif ($action === 'register') : ?>
                立即注册
            <?php elseif ($action === 'resetPasswordSendEmail') : ?>
                提交
            <?php elseif ($action === 'resetPasswordSuccess') : ?>
                立即重置密码
            <?php endif; ?>
        </button>
    </form>
    <div class="nav">
        <?php if ($action === 'login') : ?>
            <a href="<?= site_url('register') ?>">注册</a>
        <?php elseif ($action === 'register' || $action === 'resetPasswordSendEmail' || $action === 'resetPasswordSuccess') : ?>
            <a href="<?= site_url('login') ?>">登录</a>
        <?php endif; ?>
        <?php if ($action === 'login' || $action === 'register') : ?>
            <a href="<?= site_url('reset-password') ?>">忘记密码</a>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('css/login.min.css') ?>">
<?= $this->endSection() ?>
