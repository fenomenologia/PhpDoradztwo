<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid bg-primary text-white text-center p-5">
        <p class="h2">Wynik doradztwa</p>
    </div>
    <div class="container-fluid text-center">
        <?php
        $odpowiedzi = $_SESSION['odpowiedzi_style'];
        $style = ['Wzrokowiec' => 0, 'Słuchowiec' => 0, 'Ruchowiec/Czuciowiec' => 0];
        foreach($odpowiedzi as $odp)
        {
            $style['Wzrokowiec'] += $odp[1];
            $style['Słuchowiec'] += $odp[2];
            $style['Ruchowiec/Czuciowiec'] += $odp[3];
        }
        if (!isset($_SESSION['styl_wstawiony']))
        {
            $id_klienta = $_SESSION['id_klienta'];
            $data = date('Y-m-d');

            $sql = 'SELECT id_doradcy FROM doradztwo WHERE id_klienta = ' . $id_klienta;
            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $id_doradcy = $result['id_doradcy'];

            $sql = "INSERT INTO doradztwo (id_klienta, id_doradcy, id_status, data, rodzaj_doradztwa) VALUES ('$id_klienta', '$id_doradcy', 3, '$data', 'uczenia')";
            mysqli_query($conn, $sql);
            $id_doradztwa = mysqli_insert_id($conn);

            $sql = "INSERT INTO wynik_style_uczenia (id_doradztwa, id_stylu, punkty) VALUES ('$id_doradztwa',1,'$wzrokowiecPkt')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO wynik_style_uczenia (id_doradztwa, id_stylu, punkty) VALUES ('$id_doradztwa',2,'$sluchowiecPkt')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO wynik_style_uczenia (id_doradztwa, id_stylu, punkty) VALUES ('$id_doradztwa',3,'$ruchowiecPkt')";

            if (mysqli_query($conn, $sql))
            {
                $_SESSION['styl_wstawiony'] = true;
            }
        }
        //WYŚWIETLANIE WYNIKU
        arsort($style);
        foreach($style as $nazwa => $punkty)
        {
            $sql = "SELECT nazwa, tresc FROM style_uczenia WHERE nazwa = '$nazwa'";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            echo "<div class='container-fluid mt-3 mb-3 text-center'>";
            echo "<p class='h3'>$nazwa</p>";
            echo $result['tresc'].".<br>";
            echo "<b>$punkty punktów</b>";
            echo "</div>";
        }
    ?>
        <a href="main_site.php" class="btn btn-primary">Powrót do strony głównej</a>
    </div>
</body>
</html>