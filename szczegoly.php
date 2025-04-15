<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();
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
            echo "<p class='h2'>Doradztwa klienta</p>";
            $ilosc_doradztw = mysqli_num_rows($result) / 5;
            echo "<table class='table table-bordered'>
                    <thead class='table-primary'>
                        <tr>
                            <th>Data doradztwa</th>
                            <th>Cecha</th>
                            <th>Ilość zdobytych punktów</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>";
            for ($j = 0; $j < $ilosc_doradztw*5; $j++)
            {
                $row = mysqli_fetch_assoc($result);
                if ($j % 5 ==0)
                {
                    echo "<tr>
                            <td rowspan=5 class='align-middle'>" . $row['data'] . "</td>
                            <td>" . $row['nazwa'] . "</td>
                            <td>" . $row['punkty'] . "</td>
                            <td rowspan=5 class='align-middle'><button type='submit' onclick='naPewno(".$row['id'].")' class='btn btn-primary'>Usuń to doradztwo</button></td>
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
            echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Błąd!</strong> Wystąpił błąd.
                </div>";
        }
        if (isset($_POST['usun']))
        {
            $idDoUsuniecia = $_POST['usun'];
            $sql = "DELETE FROM wynik WHERE wynik.id_doradztwa =" . $idDoUsuniecia;
            mysqli_query($conn, $sql);
            $sql = "DELETE FROM doradztwo WHERE doradztwo.id =" . $idDoUsuniecia;

            if (mysqli_query($conn, $sql))
            {
                echo "<div class='alert alert-success'>Doradztwo zostało usunięte.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
            }
            else
            {
                echo "<div class='alert alert-danger'>Błąd podczas usuwania doradztwa.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
            }
        }
        ?>
        <a class="btn btn-primary" href="doradca.php">Powrót do strony głównej</a>
    </div>
    <form id="usunForm" method="post" style="display: none">
        <input type="hidden" name="usun" id="usunInput"/>
    </form>
    <script>
        function naPewno(id)
        {
            let odp = confirm("Czy na pewno chcesz usunąć to doradztwo?");
            if (odp == true)
            {
                document.getElementById('usunInput').value = id;
                document.getElementById('usunForm').submit();
            }
        }
    </script>
</body>
</html>