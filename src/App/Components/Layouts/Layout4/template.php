<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/">Logo</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/about">О нас</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"
               href="#"
               id="navbarDropdownMenuLink"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false"
            >
                Каталог
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/catalog/phones">Телефоны</a>
                <a class="dropdown-item" href="/catalog/notebooks">Ноутбуки</a>
                <a class="dropdown-item" href="#">Планшеты</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/contacts">Контакты</a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <h1><?php echo $pageTitle ?></h1>
    <div class="card">
        <div class="card-header bg-danger text-white">Header</div>
        <div class="card-body"><?php echo $content ?></div>
        <div class="card-footer">Footer</div>
    </div>
</div>
