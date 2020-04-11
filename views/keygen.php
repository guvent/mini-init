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
            <h2>Keyler</h2>
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Durum</th>
                    <th scope="col">IP Adresi</th>
                    <th scope="col">Key</th>
                    <th scope="col" style="text-align: center;">Seçenekler</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($response as $value) { ?>
                    <tr>
                            <?php
                                switch ($value["status"])
                                {
                                    case "D":
                                        echo '<th class="text-danger">Pasif</th>';
                                        break;
                                    case "A":
                                        echo '<th class="text-success">Aktif</th>';
                                        break;
                                    case "O":
                                        echo '<th class="text-warning">Onay Bekliyor</th>';
                                        break;
                                }
                            ?>

                        <td><?php echo $value["ipaddress"]; ?></td>
                        <td><?php echo $value["key"]; ?></td>
                        <td style="text-align: center;">
                            <a class="btn btn-success"
                                href="/menu/keys/edit/<?php echo $value["id"]; ?>"
                            >Düzenle</a>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

    <?php
        //var_dump($response);
    ?>

    <?php include "layouts/scripts.php"; ?>

</body>
</html>