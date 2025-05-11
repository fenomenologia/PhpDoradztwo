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
                    <th>Zobacz wyniki</th>
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
                        echo "<td>"  . $row['imie'] . "</td>";
                        echo "<td>" . $row['nazwisko'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['nazwa'] . "</td>";
                        if ($row['nazwa'] == "zakonczony_kwestionariusz_osobowosci")
                        {
                            echo "<td><button type='submit' name='id' value='".$row["id"]."' class='btn btn-primary'>Wynik</button></td>";
                        }
                        else
                        {
                            echo "<td><button class='btn btn-secondary disabled'>Doradztwo nie zostało zakończone</button></td>";
                        }
                        echo "</form>";
                        echo "</tr>";
                    }
                }
                ?>  
            </tbody>
        </table>
        <a href="dodaj_klienta.php" class="btn btn-primary">Dodaj nowego klienta</a>
        <a href="zmien_haslo.php" class="btn btn-secondary">Zmień hasło</a><br />
        <a href="logout.php" class="btn btn-secondary mt-3">Wyloguj się</a>
    </div>
</body>
</html>