<!DOCTYPE html>
<?php
require_once 'conn.php';
session_start();

if (!isset($_SESSION['id_klienta']))
{
	header("Location: index.php");
	exit();
}

$sql = "SELECT id_status FROM doradztwo WHERE id_klienta = " . $_SESSION['id_klienta'];
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['id_status'];
if ($result != 2)
{
	header("Location: main_site.php");
	exit();
}

// Ustawiamy zmienne sesyjne, jeśli nie istnieją
if (!isset($_SESSION['odpowiedzi']))
{
	$_SESSION['odpowiedzi'] = [];
}

if (!isset($_SESSION['nr_pytania']))
{
	$_SESSION['nr_pytania'] = 1;
}

$nr_pytania = $_SESSION['nr_pytania'];

// Obsługa kliknięcia "Następne pytanie"
if (isset($_POST['nastepne_pytanie']) && isset($_POST['odpowiedz']))
{
	$odpowiedz = intval($_POST['odpowiedz']);
	$_SESSION['odpowiedzi'][] = [$nr_pytania, $odpowiedz];
	$_SESSION['nr_pytania']++;

	// Jeśli przekroczyliśmy pytanie 5, przejdź do wyników
	if ($_SESSION['nr_pytania'] > 5)
	{
		$_SESSION['wstaw'] = true;
		header("Location: przejscie.php");
		exit();
	}

	// Odświeżenie strony, by pokazać kolejne pytanie
	header("Location: motywacja.php");
	exit();
}

// Pobranie pytania z bazy
$pytanie_tekst = "";
$sql = "SELECT tresc FROM pytania_motywacje WHERE nr_pytania = " . intval($nr_pytania);
$wynik = mysqli_query($conn, $sql);

if ($wynik && mysqli_num_rows($wynik) > 0)
{
	$wiersz = mysqli_fetch_assoc($wynik);
	$pytanie_tekst = $wiersz['tresc']; // Poprawna nazwa kolumny!
}
else
{
	$pytanie_tekst = "Nie znaleziono pytania.";

}
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kwestionariusz motywacji</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
			<div class="collapse navbar-collapse justify-content-center text-white">
				<span class="navbar-text text-white fw-bold h2">Pytanie nr. <?php echo $_SESSION['nr_pytania'] ?></span>
			</div>
		</div>
	</nav>

    <main class="container-fluid mt-5 text-center bg-image bg-primary">
        <p class="h3 mb-4 fw-bold"><?php echo mb_strtoupper($pytanie_tekst); ?></p>
        <form method="post">
            <div class="d-flex justify-content-center flex-wrap mb-4">
                <?php
				for ($i = 0; $i <= 10; $i++)
				{
					echo '<div class="form-check form-check-inline mx-2">';
					echo '<input class="form-check-input" type="radio" name="odpowiedz" id="odp_' . $i . '" value="' . $i . '" required>';
					echo '<label class="form-check-label" for="odp_' . $i . '">' . $i . '</label>';
					echo '</div>';
				}
				?>
            </div>
            <button type="submit" name="nastepne_pytanie" class="btn btn-primary capital fw-bold">Następne pytanie</button>
        </form>
    </main>
	<?php
	require "footer.php";
	?>
</body>
</html>