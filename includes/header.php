<?php require_once __DIR__ . '/../env.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= isset($titulo_pagina) ? $titulo_pagina : "Nodesite - Salta"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>public/assets/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="<?= BASE_URL ?>public/css/styles.css?v=<?= time() ?>">
  <link rel="stylesheet" href="<?= BASE_URL ?>public/css/components/header.css?v=<?= time() ?>">
  <link rel="stylesheet" href="<?= BASE_URL ?>public/css/components/nav-bottom.css?v=<?= time() ?>">
  <?php if(isset($pagina_actual) && file_exists(__DIR__ . '/../public/css/components/' . $pagina_actual . '.css')): ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/components/<?= $pagina_actual ?>.css?v=<?= time() ?>">
  <?php endif; ?>
</head>
<body>
  <script>
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }
  </script>