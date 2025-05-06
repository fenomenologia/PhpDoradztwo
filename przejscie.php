<!DOCTYPE html>
<?php
require_once 'conn.php';
session_start();
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Przejście</title>
</head>
<body>
	<div class="container-fluid text-center text-white bg-primary p-5">
		<h1>Ukończono kwestionariusz!</h1>
	</div>
	<div class="container-fluid text-center mt-5">
		<?php
		$id_klienta = $_SESSION['id_klienta'];
		$sql = "SELECT id_status, id FROM doradztwo WHERE id_klienta = '$id_klienta' LIMIT 1";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		$id_statusu = $result['id_status'];
		$id_doradztwa = $result['id'];

		switch($id_statusu)
		{
			case 1:
				echo "<p class='h2'>Ukończyłeś/łaś kwestionariusz zainteresowań zawodowych!</h2><br>";
				echo "<a href='motywacja.php' class='btn btn-primary mt-3'>Rozpocznij następny kwestionariusz</a><br>";

				if (isset($_SESSION['odpowiedzi']))
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
						$id_klienta = $_SESSION['id_klienta'];
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

					unset($_SESSION['odpowiedzi'], $_SESSION['nr_pytania']);
				}
				break;
			case 2:
				if (isset($_SESSION['odpowiedzi']))
				{
					
				}
				else
				{
					//jeżeli nie ma odpowiedzi z drugiego kwestionariusza to znaczy że nie został on zrobiony, tylko użytkownik skończył pierwszy i odświeżył stronę
					echo "<p class='h2'>Ukończyłeś/łaś kwestionariusz zainteresowań zawodowych!</h2><br>";
					echo "<a href='motywacja.php' class='btn btn-primary mt-3'>Rozpocznij następny kwestionariusz</a><br>";
				}
				break;
			case 3:
				break;
			case 4:
				break;
			default:
				echo "Wystąpił błąd ze statusami!<br>";
				break;
		}
		?>
		<a href="main_site.php" class="btn btn-secondary mt-5">Wróć do strony głównej</a>
	</div>
</body>
</html>