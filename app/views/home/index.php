<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Accorcia.link</title>
    <meta name="description" content="Homepage" />
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/css/link.css" charset="utf-8" />
    <link rel="stylesheet" href="/public/fonts/fontawesome/css/all.min.css" />
</head>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1 class="website-name">Accorcia.link</h1>
        <p>Hai bisogno di abbreviare un collegamento? Ora lo faremo!</p>
        <form action="/" method="post" class="form-control">
            <input type="url" name="link" placeholder="Link completo" value="<?= $_POST['link'] ?? '' ?>" /><br />
            <input type="text" name="alias" placeholder="Nome breve" value="<?= $_POST['alias'] ?? '' ?>" /><br />
            <div class="error"><?= $data['message'] ?? '' ?></div>
            <button type="submit" class="btn">Accorcia</button>
        </form>
    </div>

    <?php if (count($data['links']) > 0) : ?>
        <div class="container main">
            <h2>Link abbreviati</h2>
            <div class="links">
                <?php foreach ($data['links'] as $el) : ?>
                    <div class="link">
                        <p><b>Completo:</b> <?= $el['link'] ?></p>
                        <p><b>Abbreviato:</b> <a href="/s/<?= $el['alias'] ?>">localhost/s/<?= $el['alias'] ?></a></p>
                        <form action="/" method="post">
                            <input type="hidden" name="delete_link" value="<?= $el['id'] ?>" />
                            <button class="btn">Elimina <i class="fas fa-trash"></i></button></a>
                        </form>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif; ?>

    <?php require 'public/blocks/footer.php' ?>
</body>