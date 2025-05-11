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

// Zmieniamy status, jeśli potrzeba
if (isset($_POST['rozpocznij_doradztwo']) && isset($_SESSION['id_statusu']) && $_SESSION['id_statusu'] == 1) 
{
    mysqli_query($conn, "UPDATE doradztwo SET id_status = 2 WHERE id_klienta = " . intval($_SESSION['id_klienta']));
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
		header("Location: przejscie.php");
		exit();
	}
	else
	{

	}

	// Odświeżenie strony, by pokazać kolejne pytanie
	header("Location: motywacja.php");
	exit();

if (isset($_POST['nastepne_pytanie']) && isset($_POST['odpowiedz'])) 
{
    $odpowiedz = intval($_POST['odpowiedz']);
    $_SESSION['odpowiedzi'][] = [$nr_pytania, $odpowiedz];
    $_SESSION['nr_pytania']++;

    // Jeśli przekroczyliśmy pytanie 5, przejdź do wyników
    if ($_SESSION['nr_pytania'] > 5) 
    {
        header("Location: wynik_motywacje.php");
        exit();
    }
    else 
    {
        
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

if ($wynik && mysqli_num_rows($wynik) > 0) 
{
    $wiersz = mysqli_fetch_assoc($wynik);
    $pytanie_tekst = $wiersz['tresc']; 
} else 
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
</head>
<body>
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <p class="h2">Pytanie nr. <?php echo $nr_pytania; ?></p>
    </div>

    <div class="container mt-5 text-center p-5">
        <p class="h3 mb-4"><?php echo htmlspecialchars($pytanie_tekst); ?></p>
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
            <button type="submit" name="nastepne_pytanie" class="btn btn-primary">Następne pytanie</button>
        </form>
    </div>
</body>
</html>