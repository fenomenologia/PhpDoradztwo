<!DOCTYPE html>
<?php
require_once "conn.php";
?>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid text-center w-50">
        <?php
        $id_klienta = $_POST['id'];
        $sql = "SELECT klient.imie, klient.nazwisko, doradztwo.data, cecha.nazwa, wynik.punkty
        FROM klient JOIN doradztwo ON doradztwo.id_klienta = klient.id 
        JOIN wynik ON wynik.id_doradztwa = doradztwo.id 
        JOIN cecha ON cecha.id = wynik.id_cechy 
        WHERE klient.id = " . $id_klienta;
        if ($result = mysqli_query($conn, $sql))
        {
            echo "<p class='h2'>Doradztwa klienta</p>";
            $ilosc_doradztw = mysqli_num_rows($result) / 5;
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Data doradztwa</th>
                            <th>Cecha</th>
                            <th>Ilość zdobytych punktów</th>
                        </tr>
                    </thead>
                    <tbody>";
            for ($j = 0; $j < $ilosc_doradztw*5; $j++)
            {
                $row = mysqli_fetch_assoc($result);
                if ($j % 5 ==0)
                {
                    echo "<tr><td rowspan=5>" . $row['data'] . "</td><td>" . $row['nazwa'] . "</td><td>" . $row['punkty'] . "</td></tr>";
                }
                else
                {
                    echo "<tr><td>" . $row['nazwa'] . "</td><td>" . $row['punkty'] . "</td></tr>";
                }
            }
            echo "</tbody></table>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Success!</strong> This alert box could indicate a successful or positive action.
                </div>";
        }
        ?>
        <a class="btn btn-primary" href="doradca.php">Powrót do strony głównej</a>
    </div>
</body>
</html>