<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Pagina dei contatti</title>
    <meta name="description" content="Feedback" />
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/fonts/fontawesome/css/all.min.css" />
</head>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Feedback</h1>
        <p>Scrivici se hai delle domande</p>
        <form action="/home/contact" method="post" class="form-control">
            <input type="text" name="name" placeholder="Inserisci il tuo nome" value="<?= $_POST['name'] ?? '' ?>" /><br />
            <input type="email" name="email" placeholder="Inserisci la tua email" value="<?= $_POST['email'] ?? '' ?>" /><br />
            <input type="text" name="age" placeholder="Inserisci la tua età" value="<?= $_POST['age'] ?? '' ?>" /><br />
            <textarea name="message" placeholder="Inserisci il tuo messaggio"><?= $_POST['message'] ?? '' ?></textarea>
            <div class="error"><?= $data['message'] ?? '' ?></div>
            <button class="btn" id="send">Invia</button>
        </form>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>

</html>