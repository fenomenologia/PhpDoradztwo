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
                <input type="submit" value="Wyœwietl liste doradców" name="wys_doradce" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Powrót do strony g³ównej" name="str_gw" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyœwietl pytania" name="wys_pytania" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyœwietl cechy" name="wys_cechy" class="btn btn-primary">
            <br><br>
        </form>
    </div>
    <?php
    if (isset($_POST['wys_doradce'])) {
        header("location: admin_doradcy.php");
    }
    if (isset($_POST['str_gw'])) {
        header("location: admin.php");
    }
    if (isset($_POST['wys_pytania'])) {
        header("location: admin_pytania.php");
    }
    if (isset($_POST['wys_cechy'])) {
        header("location: admin_cechy.php");
    }
    $sql = "SELECT * FROM doradztwo WHERE id_status = '5'; ";
    $result = mysqli_query($conn, $sql);
    echo "<table class='container-fluid text-center'><tr><td>ID:</td><td>ID klienta:</td><td>ID doradcy:</td><td>Data: </td></tr>";
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['id_klienta'] . "</td><td>" . $row['id_doradcy'] . "</td><td>".$row['data']."</tr>";
    }
    echo "</table>";
    ?>
</body>