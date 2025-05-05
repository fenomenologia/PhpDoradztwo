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
    <div class="container-fluid text-center p-5">
        <?php
            $cechy = ["Kierownicze" => 0, "Społeczne" => 0, "Metodyczne" => 0, "Innowacyjne" => 0, "Przedmiotowe" => 0];

            //przetworzenie wyników
            $odpowiedzi = $_SESSION['odpowiedzi'];
            foreach($odpowiedzi as $odp)
            {
                if ($odp[1] == 1)
                {
                    switch($odp[0] % 5)
                    {
                        case 1:
                            $cechy['Kierownicze']++;
                            break;
                        case 2:
                            $cechy['Społeczne']++;
                            break;
                        case 3:
                            $cechy['Metodyczne']++;
                            break;
                        case 4:
                            $cechy['Innowacyjne']++;
                            break;
                        case 0:
                            $cechy['Przedmiotowe']++;
                            break;
                    }
                }
            }

            if (!isset($_SESSION['wyniki_wstawione']))
            {
                //wstawienie do bazy
                $id_klienta = $_SESSION['id_klienta'];
                $sql = "SELECT id FROM doradztwo WHERE id_klienta = '$id_klienta'";
                $id_doradztwa = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                $sql = "INSERT INTO wynik (id_doradztwa, id_cechy, punkty) VALUES 
                (".$id_doradztwa['id'].", 1, ".$cechy['Kierownicze']."),
                (".$id_doradztwa['id'].", 2, ".$cechy['Społeczne']."),
                (".$id_doradztwa['id'].", 3, ".$cechy['Metodyczne']."),
                (".$id_doradztwa['id'].", 4, ".$cechy['Innowacyjne']."),
                (".$id_doradztwa['id'].", 5, ".$cechy['Przedmiotowe'].")";
                mysqli_query($conn, $sql);
                $current_date = date("Y-m-d");
                $sql = "UPDATE doradztwo SET id_status = 2, data = '$current_date' WHERE id =".$id_doradztwa['id'];
                mysqli_query($conn, $sql);
                $_SESSION['wyniki_wstawione'] = true;
            }
            arsort($cechy);
            foreach($cechy as $nazwa => $punkty)
            {
                $sql = "SELECT opis FROM cecha WHERE nazwa = '$nazwa'";
                $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                echo "<div class='row'>";
                echo "<div class='col'>";
                echo "<p class='h3'>".$nazwa."</p>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-xl-2'></div><div class='col-xl-8'>";
                echo $result['opis'];
                echo "<div class='col-xl-2'></div></div></div>";
                echo "<div class='row mt-3 mb-3'><div class='col'>";
                echo "<p class='h5'>".$punkty." punktów</p>";
                echo "</div></div>";
            }
        ?>
        <br>
        <a href="main_site.php" class="btn btn-primary">Powrót do strony głównej</a>
    </div>
</body>
</html>