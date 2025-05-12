<!DOCTYPE html>
<?php
require_once 'conn.php';
session_start();

//jezeli nie zalogowano to przenosi na index.php
if (!isset($_SESSION['id_klienta']))
{
	header("Location: index.php");
	exit();
}
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Przejście</title>
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
	<link href="style.css" rel="stylesheet" />
</head>
<body class="text-white text-center bg-primary">
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
			  <a class="nav-link active btn btn-primary text-white me-3 fw-bold" href="index.php">STRONA GŁÓWNA</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="o_projekcie.php">O PROJEKCIE</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="kontakt.php">KONTAKT</a>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	<main class="container-fluid text-center bg-image bg-primary mt-5">
		<?php
		$id_klienta = $_SESSION['id_klienta'];
		$sql = "SELECT id_status, id FROM doradztwo WHERE id_klienta = '$id_klienta' LIMIT 1";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		$id_statusu = $result['id_status'];
		$id_doradztwa = $result['id'];

		switch($id_statusu)
		{
			//ZAINTERESOWAŃ zAWODOWYCH
			case 1:
				echo "<p class='h2 fw-bold capital'>Ukończyłeś/łaś kwestionariusz zainteresowań zawodowych!</p><br>";
				echo "<a href='motywacja.php' class='btn btn-primary mt-3 fw-bold'>ROZPOCZNIJ NASTĘPNY KWESTIONARIUSZ</a><br>";

				if (isset($_SESSION['odpowiedzi']) && isset($_SESSION['wstaw']))
				{
					$cechy = ["Kierownicze" => 0, "Społeczne" => 0, "Metodyczne" => 0, "Innowacyjne" => 0, "Przedmiotowe" => 0];
					//przetworzenie wyników
					$odpowiedzi = $_SESSION['odpowiedzi'];
					foreach ($odpowiedzi as $odp)
					{
						if ($odp[1] == 1)
						{
							switch ($odp[0] % 5)
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
					$sql = "SELECT COUNT(*) AS count FROM wynik WHERE id_doradztwa = '$id_doradztwa'";
					$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['count'];
					if ($result == 0)
					{
						//wstawienie do bazy
						$sql = "INSERT INTO wynik (id_doradztwa, id_cechy, punkty) VALUES 
						(" . $id_doradztwa . ", 1, " . $cechy['Kierownicze'] . "),
						(" . $id_doradztwa . ", 2, " . $cechy['Społeczne'] . "),
						(" . $id_doradztwa . ", 3, " . $cechy['Metodyczne'] . "),
						(" . $id_doradztwa . ", 4, " . $cechy['Innowacyjne'] . "),
						(" . $id_doradztwa . ", 5, " . $cechy['Przedmiotowe'] . ")";
						mysqli_query($conn, $sql);
						$current_date = date("Y-m-d");
						$sql = "UPDATE doradztwo SET id_status = 2, data = '$current_date' WHERE id =" . $id_doradztwa;
						mysqli_query($conn, $sql);
					}

					unset($_SESSION['odpowiedzi'], $_SESSION['nr_pytania'], $_SESSION['wstaw']);
				}
				break;

			//MOTYWACJI
			case 2:
				if (isset($_SESSION['odpowiedzi']) && isset($_SESSION['wstaw']))
				{
					echo "<p class='h2 fw-bold capital'>Ukończyłeś/łaś kwestionariusz motywacji!</p><br>";
					echo "<a href='styleuczenia.php' class='btn btn-primary mt-3 fw-bold'>ROZPOCZNIJ NASTĘPNY KWESTIONARIUSZ</a><br>";

					$odpowiedzi = $_SESSION['odpowiedzi'];
					//wstawienie wyników
					$sql = "SELECT COUNT(*) AS count FROM wynik_motywacje WHERE id_doradztwa = '$id_doradztwa'";
					$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['count'];
					if ($result == 0)
					{
						foreach ($odpowiedzi as $odp)
						{
							$sql = "INSERT INTO wynik_motywacje (id_doradztwa, punkty, id_pytania) VALUES ('$id_doradztwa'," . $odp[1] . ", " . $odp[0] . ")";
							mysqli_query($conn, $sql);
						}
						$sql = "UPDATE doradztwo SET id_status = 3 WHERE id = '$id_doradztwa'";
						mysqli_query($conn, $sql);
					}
					unset($_SESSION['odpowiedzi'], $_SESSION['nr_pytania'], $_SESSION['wstaw']);
				}
				else
				{
					//jeżeli nie ma odpowiedzi z drugiego kwestionariusza to znaczy że nie został on zrobiony, tylko użytkownik skończył pierwszy i odświeżył stronę
					echo "<p class='h2 fw-bold capital'>Ukończyłeś/łaś kwestionariusz zainteresowań zawodowych!</p><br>";
					echo "<a href='motywacja.php' class='btn btn-primary mt-3 fw-bold'>ROZPOCZNIJ NASTĘPNY KWESTIONARIUSZ</a><br>";
				}
				break;

			//STYLÓW UCZENIA SIĘ
			case 3:
				if (isset($_SESSION['odpowiedzi_style']) && isset($_SESSION['wstaw']))
				{
					echo "<p class='h2 fw-bold capital'>Ukończyłeś/łaś kwestionariusz styli uczenia się!</p><br>";
					echo "<a href='osobowosc.php' class='btn btn-primary mt-3 fw-bold'>ROZPOCZNIJ NASTĘPNY KWESTIONARIUSZ</a><br>";
					$odpowiedzi = $_SESSION['odpowiedzi_style'];

					//wstawienie wyników do bazy
					$sql = "SELECT COUNT(*) AS count FROM wynik_style_uczenia WHERE id_doradztwa = '$id_doradztwa'";
					$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['count'];

					if ($result == 0) //jeżeli nie wstawiono wyników
					{
						$przetworzone = ['wzrokowiec' => 0, 'sluchowiec' => 0, 'ruchowiec' => 0];
						//przetworzenie wyników
						foreach($odpowiedzi as $odp)
						{
							//odp = [pyt, wzrokowiec, sluchowiec, ruchowiec];
							$przetworzone['wzrokowiec'] += $odp[1];
							$przetworzone['sluchowiec'] += $odp[2];
							$przetworzone['ruchowiec'] += $odp[3];
						}
						$sql = "INSERT INTO wynik_style_uczenia (id_doradztwa, id_stylu, punkty) VALUES
								('$id_doradztwa', 1, ".$przetworzone['wzrokowiec']."),
								('$id_doradztwa', 2, ".$przetworzone['sluchowiec']."),
								('$id_doradztwa', 3, ".$przetworzone['ruchowiec'].")";
						mysqli_query($conn, $sql);
						$sql = "UPDATE doradztwo SET id_status = 4 WHERE id = '$id_doradztwa'";
						mysqli_query($conn, $sql);
					}
					unset($_SESSION['odpowiedzi_style'], $_SESSION['nr_pytania_style'], $_SESSION['wstaw']);
				}
				else
				{
					//jeżeli nie ma odpowiedzi z trzeciego kwestionariusza to znaczy że nie został on zrobiony, tylko użytkownik skończył drugi i odświeżył stronę
					echo "<p class='h2 fw-bold capital'>Ukończyłeś/łaś kwestionariusz motywacji!</p><br>";
					echo "<a href='styleuczenia.php' class='btn btn-primary mt-3 fw-bold'>ROZPOCZNIJ NASTĘPNY KWESTIONARIUSZ</a><br>";
				}
				break;

			//OSOBOWOŚCI
			case 4:
				if (isset($_SESSION['odpowiedzi_osobowosc']) && isset($_SESSION['wstaw']))
				{
					echo "<p class='h2 fw-bold capital'>Ukończyłeś wszystkie kwestionariusze!</p>";

					$mocne = $_SESSION['odpowiedzi_osobowosc'][0];
					$slabe = $_SESSION['odpowiedzi_osobowosc'][1];

					$sql = "SELECT COUNT(*) AS count FROM wynik_osobowosc WHERE id_doradztwa = '$id_doradztwa'";
					$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['count'];

					if ($result == 0)
					{
						//wstawienie wyników
						$sql = "INSERT INTO wynik_osobowosc (id_doradztwa, mocne_strony, slabe_strony) VALUES ('$id_doradztwa', '$mocne', '$slabe')";
						mysqli_query($conn, $sql);
						$sql = "UPDATE doradztwo SET id_status = 5 WHERE id = '$id_doradztwa'";
						mysqli_query($conn, $sql);
					}
					unset($_SESSION['odpowiedzi_osobowosc'], $_SESSION['wstaw']);
				}
				else
				{
					//ta sama sytuacja co poprzednio - użytkownik odświeżył stronę po kwestionariuszu stylów uczenia się
					echo "<p class='h2 fw-bold capital'>Ukończyłeś/łaś kwestionariusz styli uczenia się!</p><br>";
					echo "<a href='osobowosc.php' class='btn btn-primary mt-3 fw-bold'>ROZPOCZNIJ NASTĘPNY KWESTIONARIUSZ</a><br>";
				}
				break;

			//WSZYSTKO ZAKOŃCZONE
			case 5:
				echo "<p class='h2 capital'>Ukończyłeś wszystkie kwestionariusze!</p>";
				break;

			default:
				echo "WYSTĄPIŁ BŁĄD ZE STATUSAMI!<br>";
				break;
		}
		?>
		<a href="main_site.php" class="btn btn-secondary mt-5 fw-bold">WRÓĆ DO STRONY GŁÓWNEJ</a>
	</main>
	<?php
	require "footer.php";
	?>
</body>
</html>