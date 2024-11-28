<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <meta name="description" content="Pagina autenticazione" />
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/fonts/fontawesome/css/all.min.css" />
</head>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Login</h1>
        <p>Qui puoi accedere al sito</p>
        <form action="/user/auth" method="post" class="form-control">
            <input type="text" name="login" placeholder="Inserisci il tuo login" value="<?= $_POST['login'] ?? '' ?>" /><br />
            <input type="password" name="password" placeholder="Inserisci la tua password" value="<?= $_POST['password'] ?? '' ?>" /><br />
            <div class="error"><?= $data['message'] ?? '' ?></div>
            <button type="submit" class="btn">Fatto</button>
        </form>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>

</html>