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
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
</head>
<body>
    <div class="container-fluid text-center">
        <form method="POST">
            <br><br><br><br><br>
                <input type="submit" value="Powrót do strony głównej" name="str_gw" class="btn btn-primary">
            <br><br>
        </form>
    </div>
    <?php
    if (isset($_POST['str_gw'])) {
        header("location: admin.php");
    }
    ?>
    <div class="container-fluid text-center">
        <h2>Cechy</h2>
        <?php
        $sql = "SELECT * FROM cecha";
        $result = mysqli_query($conn, $sql);
        echo "<table><tr><td>ID:</td><td>Nazwa:</td><td>Opis:</td><td></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nazwa'] . "</td><td>" . $row['opis'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <h2>Dodawanie/Modyfikacja Cech</h2>
        <form method="POST">
            <input type="text" placeholder="nazwa" name="nazwa" required><br><br>
            <input type="text" placeholder="opis" name="opis" required><br><br>
            <input type="submit" value="Dodaj/Zmień" name="dod_c" class="btn btn-primary"><br><br>
        </form>
        <?php
        if (isset($_POST['dod_c'])) {
            $nazwa = $_POST['nazwa'];
            $opis = $_POST['opis'];
            $is = false;
            $ressult = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($ressult))
            {
                if($row['nazwa'] == $nazwa)
                {
                    $is = true;
                }
            }
            if($is == true)
            {
                $ssql = "UPDATE cecha SET opis = '$opis' WHERE nazwa = '$nazwa'; ";
            } else {
                $ssql = "INSERT INTO cecha(nazwa, opis) VALUES ('$nazwa', '$opis'); ";
            }
            mysqli_query($conn, $ssql);
            header("Location: admin_cechy.php");
        }
        ?>
                <h2>Style Uczenia</h2>
        <?php
        $sqll = "SELECT * FROM style_uczenia";
        $result = mysqli_query($conn, $sqll);
        echo "<table><tr><td>ID:</td><td>Nazwa:</td><td>Opis:</td><td></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nazwa'] . "</td><td>" . $row['tresc'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <h2>Dodawanie/Modyfikacja Stylów</h2>
        <form method="POST">
            <input type="text" placeholder="nazwa" name="nazwaa" required><br><br>
            <input type="text" placeholder="opis" name="opisa" required><br><br>
            <input type="submit" value="Dodaj/Zmień" name="dod_ca" class="btn btn-primary"><br><br>
        </form>
        <?php
        if (isset($_POST['dod_ca'])) {
            $nazwa = $_POST['nazwaa'];
            $opis = $_POST['opisa'];
            $is = false;
            $ressult = mysqli_query($conn, $sqll);
            while ($row = mysqli_fetch_assoc($ressult)) {
                if ($row['nazwa'] == $nazwa) {
                    $is = true;
                }
            }
            if ($is == true) {
                $ssql = "UPDATE style_uczenia SET tresc = '$opis' WHERE nazwa = '$nazwa'; ";
            } else {
                $ssql = "INSERT INTO style_uczenia(nazwa, tresc) VALUES ('$nazwa', '$opis'); ";
            }
            mysqli_query($conn, $ssql);
            header("Location: admin_cechy.php");
        }
        ?>
    </div>
</body>
