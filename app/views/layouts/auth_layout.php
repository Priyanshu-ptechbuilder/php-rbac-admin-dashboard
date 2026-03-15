<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= htmlspecialchars($pageTitle ?? 'Login') ?> | Metronic</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="<?= BASE_URL ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASE_URL ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/media/logos/favicon.ico" />
</head>
<!--begin::Body (from Metronic authentication/flows/basic/sign-in.html)-->
<body id="kt_body" class="bg-body">
    <?= $content ?>
    <script src="<?= BASE_URL ?>/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/scripts.bundle.js"></script>
</body>
</html>
