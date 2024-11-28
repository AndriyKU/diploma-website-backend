<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Crea un account</title>
    <meta name="description" content="Crea un account" />
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/fonts/fontawesome/css/all.min.css" />
</head>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1 class="website-name">Accorcia.link</h1>
        <p>Hai bisogno di abbreviare un collegamento? Prima di farlo, crea un account sul sito</p>
        <form action="/" method="post" class="form-control">
            <input type="email" name="email" placeholder="Inserisci un'email" value="<?= $_POST['email'] ?? '' ?>" /><br />
            <input type="text" name="login" placeholder="Inserisci un login" value="<?= $_POST['login'] ?? '' ?>" /><br />
            <input type="password" name="password" placeholder="Inserisci una password" value="<?= $_POST['password'] ?? '' ?>" /><br />
            <div class="error"><?= $data['message'] ?? '' ?></div>
            <button type="submit" class="btn">Registrati</button>
        </form>
        <p class="auth-message">Hai già un acoount? Allora puoi <a href="/user/auth" class="external-link">accedere</a></p>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>

</html>