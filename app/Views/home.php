<?= $this->extend('layout/home') ?>
<?= $this->section('main') ?>
<div class="home">
    <h2 class="title">程序</h2>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('css/home.min.css') ?>">
<?= $this->endSection() ?>
