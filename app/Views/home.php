<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/index.min.css') ?>">
    <title></title>
</head>

<body>
    <?php if ($logged_in) : ?>
        你好，<?= $user['username'] ?>
        <a href="<?= site_url('logout') ?>">退出</a>
    <?php else : ?>
        <a href="<?= site_url('login') ?>">登录</a>
    <?php endif; ?>

</body>

</html>
