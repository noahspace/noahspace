<?= $this->extend('layout/default') ?>

<?= $this->section('main') ?>
<div class="login">
    <?php if ($action === 'register') : ?>
        <div class="alert">注册为本站点用户</div>
    <?php endif; ?>
    <!-- 错误消息 -->
    <?php if (isset($errors)) : ?>
        <div class="alert error">
            <?php foreach ($errors as  $value) : ?>
                <div class="alert-item">
                    <strong>错误：</strong>
                    <p><?= $value ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!-- 登录表单 -->
    <form class="loginform" action="<?= $action_url ?>" method="post">
        <?php if ($action === 'login') : ?>
            <div class="label-input">
                <label for="account">用户名或电子邮箱地址</label>
                <input class="input" type="text" name="account">
            </div>
            <div class="label-input">
                <label for="password">密码</label>
                <input class="input" type="text" name="password">
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
                <input class="input" type="text" name="password">
            </div>
            <div class="label-input">
                <label for="confirmPassword">确认密码</label>
                <input class="input" type="text" name="confirmPassword">
            </div>
        <?php endif; ?>
        <button class="submit" type="submit">
            <?php if ($action === 'login') : ?>
                立即登录
            <?php elseif ($action === 'register') : ?>
                立即注册
            <?php endif; ?>
        </button>
    </form>
    <!-- 底部导航 -->
    <div class="nav">
        <?php if ($action === 'login') : ?>
            <a href="<?= site_url('register') ?>">注册</a>
        <?php elseif ($action === 'register') : ?>
            <a href="<?= site_url('login') ?>">登录</a>
        <?php endif; ?>
        <a href="">忘记密码</a>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('css/login.min.css') ?>">
<?= $this->endSection() ?>
