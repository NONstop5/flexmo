<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="/libs/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">

    <title><?php echo $pageTitle ?></title>
</head>
<body>

<h1>Layout1</h1>
<div class="row">
    <div class="col-12 card">
        <div class="card-header bg-success text-white">Header</div>
        <div class="card-body">
            <?php echo $content ?>
        </div>
        <div class="card-footer bg-success text-white">Footer</div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="/libs/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
