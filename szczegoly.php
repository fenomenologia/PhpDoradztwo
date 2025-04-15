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
    <div class="container-fluid">
        <?php
        $id_klienta = $_POST['id'];
        $sql = "SELECT doradztwo.data, cecha.nazwa, wynik.punkty
        FROM klient JOIN doradztwo ON doradztwo.id_klienta = klient.id 
        JOIN wynik ON wynik.id_doradztwa = doradztwo.id 
        JOIN cecha ON cecha.id = wynik.id_cechy 
        WHERE klient.id = " . $id_klienta;
        if ($result = mysqli_query($conn, $sql))
        {
            $ilosc_doradztw = mysqli_num_rows($result) / 5;
            for ($i=0; $i<$ilosc_doradztw; $i++)
            {
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                              <th>Data doradztwa</th>
                              <th>Cecha</th>
                              <th>Ilość zdobytych punktów</th>
                            </tr>
                        </thead>
                        <tbody>";
                for ($j = 0; $j < 5; $j++)
                {
                    $row = mysqli_fetch_assoc($result);
                    if ($j == 0)
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
        }
        else
        {
            //błąd bazy
        }
        ?>
    </div>
</body>
</html>