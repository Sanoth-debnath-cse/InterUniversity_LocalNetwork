<?php
session_start();
include("templates/header.php");
include("templates/content.php");
include("templates/footer.php");
include("login.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<script>
    $(function () {
        $('#sp_form').hide();


        $('#sp_login').click(function () {
            $('#sp_form').show();

        })

    })
</script>
</body>
</html>
