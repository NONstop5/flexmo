<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="/libs/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">

    <title><?php echo $pageTitle ?></title>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/">Logo</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/about">О нас</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/catalog">Каталог</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/contacts">Контакты</a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <h1><?php echo $pageTitle ?></h1>
    <div class="card">
        <div class="card-header bg-primary text-white">Header</div>
        <div class="card-body">
            <?php echo $content ?>
        </div>
        <div class="card-footer">Footer</div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="/libs/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
