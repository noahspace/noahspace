<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="<?= base_url('css/index.min.css') ?>">
    <?= $this->renderSection('css') ?>
</head>

<body>
    <?= $this->renderSection('main') ?>
    <?= $this->renderSection('js') ?>
</body>

</html>
