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
                <input type="submit" value="Powrót do strony g³ównej" name="wys_doradce" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyœwietl liste przeprowadzonych doradztw" name="wys_doradztwo" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyœwietl pytania" name="wys_pytania" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wyœwietl cechy" name="wys_cechy" class="btn btn-primary">
            <br><br>
        </form>
        <h2>Dodawanie Doradcy</h2>
        <form method="POST">
            <input type="text" placeholder="imie" name="imie" required><br><br>
            <input type="text" placeholder="nazwisko" name="nazwisko" required><br><br>
            <input type="text" placeholder="email" name="email" required><br><br>
            <input type="submit" value="Dodaj" name="dod_dor" class="btn btn-primary"><br><br>
        </form>
        <?php
            $data = date("Y-m-d");
            if(isset($_POST['dod_dor']))
            {
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $email = $_POST['email'];
                $haslo = '$2a$12$bK40cV4FIaBo.Y.pGTY2NuXg3FklAPTcgnV/BOArWHkQUsG3PmpfG';
                $sql = "INSERT INTO doradca(email, haslo, czy_aktywny, data_utworzenia, czy_admin, imie, nazwisko) VALUES ('$email', '$haslo', '1', '$data', '0', '$imie', '$nazwisko')";
                mysqli_query($conn, $sql);
                header("Location: admin_doradcy.php");
            }
        ?>
    </div>
    <?php
    if (isset($_POST['wys_doradce'])) {
        header("location: admin.php");
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
    ?>
    <div class="container-fluid text-center">
        <?php
        $sql = "SELECT * FROM doradca; ";
        $result = mysqli_query($conn, $sql);
        echo "<table class='container-fluid text-center'>";
        echo "<tr><td>ID:</td><td>Imie:</td><td>Nazwisko:</td><td>Email:</td><td>Data Utworzenia:</td><td>Czy aktywny:</td>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['imie'] . "</td><td>" . $row['nazwisko'] . "</td><td>" . $row['email'] . "</td><td>" . $row['data_utworzenia'] . "</td><td>";
            if($row['czy_aktywny'] == 0)
            {
                $akt = 'nie';
            }
            else
            {
                $akt = 'tak';
            }
            echo $akt . "</td>" . "</tr>";
        }
        echo "</table>";
        ?>
        <br><h2>Blokowanie/Odblokowywanie Doradcy</h2>
        <form method="POST">
            <br>
                <input type="number" placeholder="Wpisz ID" name="id_dor" required>
            <br><br>
                <input type="submit" value="Zablokuj/Odblokuj Doradce" name="zablokuj" class="btn btn-primary">
            <br><br>
        </form>
        <?php
        if (isset($_POST['zablokuj'])) {
            $idd = $_POST['id_dor'];
            $ssql = "SELECT * FROM doradca WHERE id='$idd'; ";
            $result = mysqli_query($conn, $ssql);
            $row = mysqli_fetch_assoc($result);
            if($row['czy_aktywny'] == 1)
            {
            $sssql = "UPDATE doradca SET czy_aktywny = 0 WHERE id = '$idd';";
            }
            else
            {
            $sssql = "UPDATE doradca SET czy_aktywny = 1 WHERE id = '$idd';";
            }
            mysqli_query($conn, $sssql);
            header("Location: admin_doradcy.php");
        }
        ?>
    </div>
</body>
