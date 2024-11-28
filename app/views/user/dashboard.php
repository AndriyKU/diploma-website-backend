<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Area personale</title>
    <meta name="description" content="Account dell'utente" />
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/css/user.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/fonts/fontawesome/css/all.min.css" />
</head>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Area personale</h1>
        <div class="user-info">
            <p>Ciao, <b><?= $data['user']['login'] ?? '' ?></b></p>

            <form action="/user" method="post">
                <input type="hidden" name="logout" value="<?= $data['user']['id'] ?>" />
                <button type="submit" class="btn">Esci</button>
            </form>
        </div>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>

</html>