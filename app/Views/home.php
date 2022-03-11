<?= $this->extend('layout/home') ?>
<?= $this->section('main') ?>
<h2 class="category-title">程序</h2>
<ul class="app-list">
    <?php for ($i = 0; $i < 20; $i++) : ?>
        <li class="item">
            <a href="">
                <div class="logo" style="background-image: url(<?= base_url('img/default-app.png') ?>);"></div>
                <div class="info">
                    <div class="title">
                        <h3>计算器</h3>
                        <div class="version">1.0.0</div>
                    </div>
                    <small>强大的计算器</small>
                </div>
            </a>
        </li>
    <?php endfor; ?>
</ul>
<h2 class="category-title">游戏</h2>
<ul class="game-list">
    <?php for ($i = 0; $i < 20; $i++) : ?>
        <li class="item">
            <a href="">
                <div class="preview" style="background-image: url(<?= base_url('img/default-game.png') ?>);"></div>
                <div class="info">
                    <h3>坦克大战</h3>
                    <small>在线/射击/模拟</small>
                </div>
            </a>
        </li>
    <?php endfor; ?>
</ul>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('css/home.min.css') ?>">
<?= $this->endSection() ?>
