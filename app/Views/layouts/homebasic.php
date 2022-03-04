</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/icon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/index.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/banner.css') ?>">
    <?= $this->renderSection('styles') ?>
    <title>诺亚空间</title>
</head>

<body>
    <?= $this->include('components/banner') ?>
    <?= $this->renderSection('main') ?>
    <div class="footer"></div>
    <script src="<?= base_url('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('js/banner.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>
