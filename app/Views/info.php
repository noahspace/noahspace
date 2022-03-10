<?= $this->extend('layout/default') ?>
<?= $this->section('main') ?>
<div class="info">
    <?php if ($action === 'resetPassword') : ?>
        <a class="link" href="<?= site_url('/') ?>">返回首页</a>
        <div class="alert">
            重置密码链接已经发送至邮箱，请查收邮件重置密码
        </div>
    <?php elseif ($action === 'resetPasswordSuccess') : ?>
        <a class="link" href="<?= site_url('login') ?>">返回登录</a>
        <div class="alert">
            密码修改成功
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('css/info.min.css') ?>">
<?= $this->endSection() ?>
