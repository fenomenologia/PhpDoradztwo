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
                <input type="submit" value="Wy�wietl liste doradc�w" name="wys_doradce" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wy�wietl liste przeprowadzonych doradztw" name="wys_doradztwo" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Powr�t do strony g��wnej" name="str_gw" class="btn btn-primary">
            <br><br>
                <input type="submit" value="Wy�wietl cechy" name="wys_cechy" class="btn btn-primary">
            <br><br>
        </form>
    </div>
    <?php
    if (isset($_POST['wys_doradce'])) {
        header("location: admin_doradcy.php");
    }
    if (isset($_POST['wys_doradztwo'])) {
        header("location: admin_doradztwa.php");
    }
    if (isset($_POST['str_gw'])) {
        header("location: admin.php");
    }
    if (isset($_POST['wys_cechy'])) {
        header("location: admin_cechy.php");
    }
    ?>
    <div class="container-fluid text-center">
        <h1>PYTANIA:</h1>
        <h3>Kwestionariusz zainteresowa� zawodowych:</h3>
        <?php
        $sql = "SELECT * FROM pytania; ";
        $result = mysqli_query($conn, $sql);
        echo "<table class='container-fluid text-center'><tr><td>ID:</td><td>Nr. Pytania:</td><td>Tre��:</td></tr>";
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nr_pytania'] . "</td><td>" . $row['pytania'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <h3>Dodawanie/Zmiana pyta�:</h3>
        <form method="POST">
            <input type="text" name="pytanie" placeholder="Wpisz tre�� pytania" required>
            <input type="number" name="nr_pyt" value="Wpisz numer pytania" required>
            <input type="submit" name="dodaj_a" value="Dodaj/zamie� pytanie">
        </form>
        <?php
            if(isset($_POST['dodaj_a']))
            {
            $pytanie = $_POST['pytanie'];
            $nr = $_POST['nr_pyt'];
            $is = false;
            $sqll = "SELECT * FROM pytania; ";
            $resullt = mysqli_query($conn, $sqll);
            while($row = mysqli_fetch_assoc($resullt))
            {
                if($row['nr_pytania'] == $nr)
                {
                    $is = true;
                }
            }
                if ($is == true) {
                    $ssql = "UPDATE pytania SET pytania = '$pytanie' WHERE nr_pytania = '$nr'; ";
                } else {
                    $ssql = "INSERT INTO pytania(pytania, nr_pytania) VALUES ('$pytanie', '$nr'); ";
                }
            mysqli_query($conn, $ssql);
            header("Location: admin_pytania.php");
            }
        ?>
        <br><br><br>
        <h3>Kwestionariusz motywacji:</h3>
        <?php
        $sqql = "SELECT * FROM pytania_motywacje; ";
        $result = mysqli_query($conn, $sqql);
        echo "<table class='container-fluid text-center'><tr><td>ID:</td><td>Nr. Pytania:</td><td>Tre��:</td></tr>";
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nr_pytania'] . "</td><td>" . $row['tresc'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <h3>Dodawanie/Zmiana pyta�:</h3>
        <form method="POST">
            <input type="text" name="pytanie_b" placeholder="Wpisz tre�� pytania" required>
            <input type="number" name="nr_pyt_b" value="Wpisz numer pytania" required>
            <input type="submit" name="dodaj_b" value="Dodaj/zamie� pytanie">
        </form>
        <?php
        if (isset($_POST['dodaj_b'])) {
            $pytanie = $_POST['pytanie_b'];
            $nr = $_POST['nr_pyt_b'];
            $iss = false;
            $sqlll = "SELECT * FROM pytania_motywacje;";
            $resullt = mysqli_query($conn, $sqlll);
            while ($row = mysqli_fetch_assoc($resullt)) {
                if ($row['nr_pytania'] == $nr) {
                    $iss = true;
                }
            }
            if ($iss == true) {
                $ssqll = "UPDATE pytania_motywacje SET tresc = '$pytanie' WHERE nr_pytania = '$nr'; ";
            } else {
                $ssqll = "INSERT INTO pytania_motywacje(tresc, nr_pytania) VALUES ('$pytanie', '$nr'); ";
            }
            mysqli_query($conn, $ssqll);
            header("Location: admin_pytania.php");
        }
        ?>
         <br><br><br>
        <h3>Kwestionariusz osobowości:</h3>
        <?php
        $sqqll = "SELECT * FROM pytania_osobowosc; ";
        $result = mysqli_query($conn, $sqqll);
        echo "<table class='container-fluid text-center'><tr><td>ID:</td><td>Rodzaj:</td><td>Tre��:</td></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['rodzaj'] . "</td><td>" . $row['tresc'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <h3>Dodawanie pyta�:</h3>
        <form method="POST">
            <input type="text" name="pytanie_c" placeholder="Wpisz nazwe cechy" required>
            <select name="select" required>
                <option value="mocne">mocne</option>
                <option value="slabe">słabe</option>
            </select>
            <input type="submit" name="dodaj_c" value="Dodaj ceche">
        </form>
        <?php
        if (isset($_POST['dodaj_c'])) {
            $pytanie = $_POST['pytanie_c'];
            $rodz = $_POST['select'];
            $ssqll = "INSERT INTO pytania_osobowosc(tresc, rodzaj) VALUES ('$pytanie', '$rodz'); ";
            mysqli_query($conn, $ssqll);
            header("Location: admin_pytania.php");
        }
        ?>
        <h3>Zmiana pyta�:</h3>
        <form method="POST">
            <input type="number" name="id" required>
            <input type="text" name="pytanie_ca" placeholder="Wpisz nazwe cechy" required>
            <select name="select_a" required>
                <option value="mocne">mocne</option>
                <option value="slabe">słabe</option>
            </select>
            <input type="submit" name="dodaj_ca" value="Zmień ceche">
        </form>
        <?php
        if (isset($_POST['dodaj_ca'])) {
            $pytanie = $_POST['pytanie_ca'];
            $rodz = $_POST['select_a'];
            $id = $_POST['id'];
            $ssqll = "UPDATE pytania_osobowosc SET tresc='$pytanie', rodzaj='$rodz' WHERE id='$id'";
            mysqli_query($conn, $ssqll);
            header("Location: admin_pytania.php");
        }
        ?>
                <br><br><br>
        <h3>Kwestionariusz styli uczenia:</h3>
        <?php
        $sqql = "SELECT * FROM pytania_style; ";
        $result = mysqli_query($conn, $sqql);
        echo "<table class='container-fluid text-center'><tr><td>ID:</td><td>Nr. Pytania:</td><td>Tre��:</td></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nr_pytania'] . "</td><td>" . $row['tresc'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <h3>Dodawanie/Zmiana pyta�:</h3>
        <form method="POST">
            <input type="text" name="pytanie_da" placeholder="Wpisz tre�� pytania" required><br />
                        <input type="text" name="pytanie_db" placeholder="opcja dla wzrokowca" required><br />
                        <input type="text" name="pytanie_dc" placeholder="opcja dla słuchowca" required><br />
                        <input type="text" name="pytanie_dd" placeholder="opcja dla ruchowca" required><br /><br /><br />
            <input type="number" name="nr_pyt_d" value="Wpisz numer pytania" required>
            <input type="submit" name="dodaj_d" value="Dodaj/zamie� pytanie">
        </form>
        <?php
        if (isset($_POST['dodaj_d'])) {
            $pytanie = $_POST['pytanie_da'];
            $wzrok = $_POST['pytanie_db'];
            $sluch = $_POST['pytanie_dc'];
            $ruch = $_POST['pytanie_dd']; 
            $nr = $_POST['nr_pyt_d'];
            $iss = false;
            $sqlll = "SELECT * FROM pytania_style;";
            $resullt = mysqli_query($conn, $sqlll);
            while ($row = mysqli_fetch_assoc($resullt)) {
                if ($row['nr_pytania'] == $nr) {
                    $iss = true;
                    $ide = $row['id'];
                }
            }
            if ($iss == true) {
                $id1 = $ide - 3;
                $id2 = $ide - 2;
                $id3 = $ide - 1;
                $id4 = $ide;

                $ssqll = "UPDATE pytania_style SET tresc = '$pytanie' WHERE nr_pytania = '$nr' AND id = $id1;";
                $ssqll2 = "UPDATE pytania_style SET tresc = '$wzrok' WHERE nr_pytania = '$nr' AND id = $id2;";
                $ssqll3 = "UPDATE pytania_style SET tresc = '$sluch' WHERE nr_pytania = '$nr' AND id = $id3;";
                $ssqll4 = "UPDATE pytania_style SET tresc = '$ruch' WHERE nr_pytania = '$nr' AND id = $id4;";
            } else {
                $ssqll = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$pytanie', '$nr'); ";
                $ssqll2 = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$wzrok', '$nr'); ";
                $ssqll3 = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$sluch', '$nr'); ";
                $ssqll4 = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$ruch', '$nr'); ";
            }
            mysqli_query($conn, $ssqll);
            mysqli_query($conn, $ssqll2);
            mysqli_query($conn, $ssqll3);
            mysqli_query($conn, $ssqll4);
            header("Location: admin_pytania.php");
        }
        ?>
    </div>
</body>