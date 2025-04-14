<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();
?>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel doradcy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid text-center">
        <p class="h2">Twoi klienci</p>
        <table class="table table-hover table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>E-mail</th>
                    <th>Status doradztwa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_doradcy = $_SESSION['id_doradcy'];
                $sql = "SELECT klient.id, klient.imie, klient.nazwisko, klient.email, status.nazwa FROM klient 
                    JOIN doradztwo ON doradztwo.id_klienta = klient.id
                    JOIN status ON doradztwo.id_status = status.id
                    WHERE doradztwo.id_doradcy = '$id_doradcy'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<form action='szczegoly.php' method='post'>";
                           echo "<button type='submit'>";
                                echo "<td>"  . $row['imie'] . "</td>";
                                echo "<td>" . $row['nazwisko'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['nazwa'] . "</td>";
                            echo "</button>";
                            echo "<input type='hidden' name='id_klienta' value=" . $row['id'] . ">";
                        echo "</form>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="dodaj_klienta.php" class="btn btn-primary">Dodaj nowego klienta</a>
        <a href="logout.php" class="btn btn-secondary">Wyloguj się</a>
    </div>
</body>
</html>