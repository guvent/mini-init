<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "layouts/links.php"; ?>
    <link rel="stylesheet" href="/static/dashboard.css">
    <title>Document</title>
</head>
<body>

<?php include "layouts/navbar.php"; ?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Kullanıcı Profili</h2>
            <hr>
            <form action="/menu/saveprofile" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">E Posta</label>
                        <input type="email" disabled class="form-control" id="inputEmail4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Parola</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Parola (Tekrar)</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password2">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>
</div>



    

    <?php include "layouts/scripts.php"; ?>
</body>
</html>