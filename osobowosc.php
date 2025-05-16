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
if ($result != 4)
{
	header("Location: main_site.php");
	exit();
}

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwestionariusz osobowości</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
	<link rel="stylesheet" href="style.css" />
</head>
<body class="bg-primary text-white text-center d-flex">
    <?php
    if (!isset($_SESSION['odp_os'])) {
        $_SESSION['odp_os'] = [];
    }

    if (!isset($_SESSION['nr_pyt_os'])) {
        $_SESSION['nr_pyt_os'] = 1;
    }
    $nr_pytania = $_SESSION['nr_pyt_os'];

    ?>
	<header class="bg-white">
		<img src="zdjecia/header_image.jpg" alt="Header" style="height: 80px; width: auto" />
	</header>

	<nav class="navbar navbar-expand-sm">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<a href="#" class="navbar-brand"><img style="height: 100px" src="zdjecia/logo ibcu.png" alt="Logo"/></a>
			<div class="collapse navbar-collapse justify-content-center text-white">
				<span class="navbar-text text-white fw-bold h2">Pytanie nr. <?php echo $_SESSION['nr_pyt_os'] ?></span>
			</div>
		</div>
	</nav>

    <main class="container-fluid mt-5 text-center bg-image bg-primary">
        <?php
        $sql = "SELECT tresc FROM pytania_osobowosc WHERE id = '$nr_pytania'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $pytanie = mysqli_fetch_assoc($result);
        } else {
            $mocne = [];
            $slabe = [];

            foreach ($_SESSION['odp_os'] as $odpowiedz) {
                list($id_pytania, $wartosc) = $odpowiedz;
                if ($wartosc == 1) {
                    $query = "SELECT tresc FROM pytania_osobowosc WHERE id = $id_pytania";
                    $res = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($res)) {
                        $tresc = $row['tresc'];
                        if ($id_pytania >= 1 && $id_pytania <= 54) {
                            $mocne[] = $tresc;
                        } elseif ($id_pytania > 54) {
                            $slabe[] = $tresc;
                        }
                    }
                }
            }

            $mocne_str = implode(",", $mocne);
            $slabe_str = implode(",", $slabe);

			unset($_SESSION['odp_os']);
			unset($_SESSION['nr_pyt_os']);

			$_SESSION['odpowiedzi_osobowosc'] = [$mocne_str, $slabe_str];
			$_SESSION['wstaw'] = true;
			header("Location: przejscie.php");

            exit();
        }
		echo "<p class='h2 fw-bold mb-3'>CZY TA CECHA DO CIEBIE PASUJE?</p>";
        echo "<p class='h3 mt-3 mb-3 fw-bold'>" . $pytanie['tresc'] . "</p>";
        ?>
        <form method="post">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                    <input type="radio" class="btn-check" name="odp_os" id="odpowiedz_tak" required value="1">
					<label for="odpowiedz_tak" class="fw-bold btn btn-outline-primary capital">TAK</label>
                </div>
                <div class="col-sm-2">
                    <input type="radio" class="btn-check" name="odp_os" id="odpowiedz_nie" required value="0">
					<label for="odpowiedz_nie" class="fw-bold btn btn-outline-primary capital">NIE</label>
                </div>
                <div class="col-sm-4"></div>
            </div>

            <button type="submit" name="nastepne_pytanie" class="btn btn-primary mt-3 capital fw-bold">Następne pytanie</button>
        </form>
        <?php if ($_SESSION['nr_pyt_os'] > 1): ?>
            <form method="post">
                <button type="submit" name="cofnij" class="btn btn-secondary mt-3 capital fw-bold">Cofnij</button>
            </form>
        <?php endif; ?>
    </main>
    <?php
    if (isset($_POST['nastepne_pytanie']) && isset($_POST['odp_os'])) //jeżeli udzielono odpowiedzi
    {
        $odp = $_POST['odp_os'] == "1" ? 1 : 0; //jeżeli odpowiedz to tak to ustawia 1, jeżeli nie to ustawia 0

        $_SESSION['odp_os'][] = [$nr_pytania, $odp];
        ; //zapisuje do tablicy nr pytania i odp na tak/nie
        $_SESSION['nr_pyt_os'] = $nr_pytania + 1; //zapisuje do sesji nr pytania
        unset($nr_pytania, $odp);
        header('Location: osobowosc.php');

        exit();
    }
	if (isset($_POST['cofnij']))
	{
		if ($_SESSION['nr_pyt_os'] > 1)
		{
			$_SESSION['nr_pyt_os'] -= 1;
		}

		array_pop($_SESSION['odp_os']);
		unset($nr_pytania, $odp);
		header('Location: osobowosc.php');
		exit();
	}
	require "footer.php";
    ?>
</body>
</html>
