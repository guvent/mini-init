<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "layouts/links.php"; ?>
    <link rel="stylesheet" href="/static/signin.css">
    <title>Document</title>
</head>
<body>
    <form class="form-signin" method="post" action="/login">
        <img class="mb-4" src="/static/avatar.jpg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Lütfen Giriş Yapın</h1>
        <label for="inputEmail" class="sr-only">E Posta Adresi</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="birisi@eposta.com" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Parola</label>
        <input type="password" id="inputPassword" class="form-control" name="passwd" placeholder="Parola" required="">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
        <p class="mt-5 mb-3 text-muted">© 2017-2019</p>
    </form>


    <?php include "layouts/scripts.php"; ?>
</body>
</html>