<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();
?>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid text-center">
        <form method="POST">
            <br><br><br><br><br>
                <input type="submit" value="Wyświetl liste doradców" name="wys_doradce" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyświetl liste przeprowadzonych doradztw" name="wys_doradztwo" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyświetl pytania" name="wys_pytania" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyświetl cechy" name="wys_cechy" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyloguj się" name="logout" class="btn btn-primary">
            <br><br>
        </form>
    </div>
    <?php
    if(isset($_POST['wys_doradce'])) {
        header("location: admin_doradcy.php");
    }
    if (isset($_POST['wys_doradztwo'])) {
        header("location: admin_doradztwa.php");
    }
    if (isset($_POST['wys_pytania'])) {
        header("location: admin_pytania.php");
    }
    if (isset($_POST['wys_cechy'])) {
        header("location: admin_cechy.php");
    }
    if (isset($_POST['logout'])) {
        header("location: logout.php");
    }
    ?>
</body>
