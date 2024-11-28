<header class="container header">
    <div class="logo">
        <img src="/public/img/logo.png" alt="Logo" />
        <span>Rimuoviamo tutto il superfluo dal link!</span>
    </div>
    <div class="nav">
        <ul>
            <li><a href="/">Homepage</a></li>
            <li><a href="/home/about">Chi siamo</a></li>
            <li><a href="/home/contact">Contattaci</a></li>
            <?php if (isset($_COOKIE['login'])) : ?>
                <li><a href="/user">Account</a></li>
            <?php else : ?>
                <li><a href="/user/auth">Accedi</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>