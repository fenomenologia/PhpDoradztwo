<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();

if (!isset($_SESSION['id_doradcy']))
{
	header("Location: index.php");
	exit();
}
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
        if (isset($_POST['id']))
        {
            $id_klienta = $_POST['id'];
            $_SESSION['id_wysw'] = $id_klienta;
        }
        else
        {
            $id_klienta =  $_SESSION['id_wysw'];
        }

        $sql = "SELECT klient.imie, klient.nazwisko, doradztwo.data, doradztwo.id, cecha.nazwa, wynik.punkty
        FROM klient JOIN doradztwo ON doradztwo.id_klienta = klient.id 
        JOIN wynik ON wynik.id_doradztwa = doradztwo.id 
        JOIN cecha ON cecha.id = wynik.id_cechy 
        WHERE klient.id = " . $id_klienta;
        if ($result = mysqli_query($conn, $sql))
        {
            if (mysqli_num_rows($result) > 0)
            {
                echo "<p class='h2'>Doradztwa klienta</p>";
                $ilosc_doradztw = mysqli_num_rows($result) / 5;
                echo "<table class='table table-bordered'>
                    <thead class='table-primary'>
                        <tr>
                            <th>Data doradztwa</th>
                            <th>Cecha</th>
                            <th>Ilość zdobytych punktów</th>
                        </tr>
                    </thead>
                    <tbody>";
                for ($j = 0; $j < $ilosc_doradztw * 5; $j++)
                {
                    $row = mysqli_fetch_assoc($result);
                    if ($j % 5 == 0)
                    {
                        echo "<tr>
                            <td rowspan=5 class='align-middle'>" . $row['data'] . "</td>
                            <td>" . $row['nazwa'] . "</td>
                            <td>" . $row['punkty'] . "</td>
                           </tr>";
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
                echo "<p class='h2'>Ten klient nie ma żadnych doradztw</p>";
            }
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Błąd!</strong> Wystąpił błąd.
                </div>";
        }
        if (isset($_POST['usun']))
        {
            $sql = 'SELECT doradztwo.id FROM doradztwo WHERE id_klienta =' . $id_klienta;
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
                $sql = "DELETE FROM wynik WHERE wynik.id_doradztwa =" . $row[0];
                mysqli_query($conn, $sql);
                $sql = "DELETE FROM doradztwo WHERE doradztwo.id =" . $row[0];
                mysqli_query($conn, $sql);
            }
            $sql = "DELETE FROM klient WHERE id =" . $id_klienta;
            if (mysqli_query($conn, $sql))
            {
                header("Location: doradca.php");
            }
            else
            {
                echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Wystąpił nieoczekiwany błąd!</strong></div>';
            }
        }
        ?>
        <button class="btn btn-danger" onclick="naPewno()">Usuń tego klienta</button>
        <a class="btn btn-primary" href="doradca.php">Powrót do strony głównej</a>
    </div>
    <form id="usunForm" method="post" style="display: none">
        <input type="hidden" name="usun" value="1" />
    </form>
    <script>
        function naPewno()
        {
            let odp = confirm("Czy na pewno chcesz usunąć tego klienta?");
            if (odp == true)
            {
                document.getElementById("usunForm").submit();
            }
        }
    </script>
</body>
</html>