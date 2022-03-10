<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
    <link rel="stylesheet" href="<?= base_url('css/index.min.css') ?>">
    <?= $this->renderSection('css') ?>
</head>

<body>
    <div class="wrapper">
        <div class="aside">
            <div class="logo">
                <a href="">
                    <img src="<?= base_url('img/logo.svg') ?>" alt="">
                    <div class="title"><span>noah</span>apps</div>
                </a>
            </div>
            </a>
        </div>
        <div class="container">
            <div class="header">
                <form class="search" action="" method="get">
                    <input type="" name="search">
                </form>
                <div class="user">
                    <?php if ($logged_in) : ?>
                        <div class="avatar" style="background-image:url(<?= base_url('img/default-avatar.png') ?>)"></div>
                        <div class="user-panel">
                            <ul class="menu">
                                <li><a href=""><?= $user['username'] ?></a></li>
                                <li><a href="<?= site_url('logout') ?>">退出登录</a></li>
                            </ul>

                        </div>
                    <?php else : ?>
                        <a class="btn" href="<?= site_url('login') ?>">登录</a>
                    <?php endif; ?>
                </div>
            </div>
            <?= $this->renderSection('main') ?>
        </div>
    </div>
    <?= $this->renderSection('js') ?>
</body>

</html>
