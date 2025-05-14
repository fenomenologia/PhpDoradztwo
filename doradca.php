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
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
    <link rel="stylesheet" href="style.css" />
</head>
<body class="bg-primary d-flex text-center text-white">
    <header class="bg-white">
		<img src="zdjecia/header_image.jpg" alt="Header" style="height: 80px; width: auto" />
	</header>
    <nav class="navbar navbar-expand-sm">
		<div class="container-fluid d-flex justify-content-between align-items-center">
		
			<a href="#" class="navbar-brand"><img style="height: 100px" src="zdjecia/logo ibcu.png" alt="Logo"/></a>
    
		
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
    
			<div class="collapse navbar-collapse justify-content-center text-white" id="navbarNav">
				<ul class="navbar-nav text-white">
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary active text-white me-3 fw-bold" href="#">STRONA GŁÓWNA</a> 
                    </li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="dodaj_klienta.php">DODAJ NOWEGO KLIENTA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="zmien_haslo.php">ZMIEŃ HASŁO</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-danger text-white me-3 fw-bold" href="logout.php">WYLOGUJ SIĘ</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <main class="container-fluid text-center bg-image bg-primary flex-fill">
        <p class="h2 capital fw-bold">Twoi klienci</p>
        <table class='table table-dark table-stripped table-hover table-bordered mt-5 w-auto container-fluid'>
            <thead >
                <tr>
                    <th scope="col" class="capital">ID</th>
                    <th scope="col" class="capital">Imię</th>
                    <th scope="col" class="capital">Nazwisko</th>
                    <th scope="col" class="capital">E-mail</th>
                    <th scope="col" class="capital">Status doradztwa</th>
                    <th scope="col" class="capital">Zobacz wyniki</th>
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
                        echo "<th scope='row'>" . $row['id'] . "</th>";
                        echo "<td>"  . $row['imie'] . "</td>";
                        echo "<td>" . $row['nazwisko'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['nazwa'] . "</td>";
                        if ($row['nazwa'] == "zakonczony_kwestionariusz_osobowosci")
                        {
                            echo "<td><button type='submit' name='id' value='".$row["id"]."' class='btn btn-primary capital fw-bold'>Wynik</button></td>";
                        }
                        else
                        {
                            echo "<td><button class='btn btn-secondary disabled capital fw-bold'>Doradztwo nie zostało zakończone</button></td>";
                        }
                        echo "</form>";
                        echo "</tr>";
                    }
                }
                ?>  
            </tbody>
        </table>
    </main>
    <?php
    require "footer.php";
    ?>
</body>
</html>