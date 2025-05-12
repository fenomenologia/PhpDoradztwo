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
	if ($result != 1)
	{
		header("Location: main_site.php");
		exit();
	}
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwestionariusz zainteresowań zawodowych</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
	<link href="style.css" rel="stylesheet" />
</head>
<body class="bg-primary text-center text-white">
    <?php
        //jeżeli zmienne nie są ustawione to je ustawia
        if (!isset($_SESSION['odpowiedzi'])) 
        {
            $_SESSION['odpowiedzi'] = [];
        }
        if (!isset($_SESSION['nr_pytania']))
        {
            $_SESSION['nr_pytania'] = 1;
        }
        $nr_pytania = $_SESSION['nr_pytania'];
        
    ?>
	<header class="bg-white">
		<img src="zdjecia/header_image.jpg" alt="Header" style="height: 80px; width: auto" />
	</header>

	<nav class="navbar navbar-expand-sm">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<a href="#" class="navbar-brand"><img style="height: 100px" src="zdjecia/logo ibcu.png" alt="Logo"/></a>
			<div class="collapse navbar-collapse justify-content-center text-white">
				<span class="navbar-text text-white fw-bold h2">Pytanie nr.<?php echo $_SESSION['nr_pytania']?></span>
			</div>
		</div>
	</nav>
	<main class="container-fluid mt-5 text-center bg-image bg-primary p-5">
        <?php
            $sql = "SELECT pytania FROM pytania WHERE nr_pytania = '$nr_pytania'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {
                $pytanie = mysqli_fetch_assoc($result);
            }
            else
            {
                header("Location: przejscie.php"); //jeśli nie ma już pytań przekierowuje do strony przejściowej
                exit();
            }
			$pytanie = mb_strtoupper($pytanie['pytania']);
            echo "<p class='h3 mt-3 mb-3 fw-bold'>".$pytanie."</p>";
        ?>
        <form method="post">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                    <label for="odpowiedz_tak" class="fw-bold">TAK</label>
                    <input type="radio" name="odpowiedz" id="odpowiedz_tak" required value="1">
                </div>
                <div class="col-sm-2">
                    <label for="odpowiedz_nie" class="fw-bold">NIE</label>
                    <input type="radio" name="odpowiedz" id="odpowiedz_nie" required value="0">
                </div>
                <div class="col-sm-4"></div>
            </div>
            <button type="submit" name="nastepne_pytanie" class="btn btn-primary mt-3 fw-bold">NASTĘPE PYTANIE</button>
        </form>
        <?php if ($_SESSION['nr_pytania'] > 1): ?>
            <form method="post">
                <button type="submit" name="cofnij" class="btn btn-secondary mt-3 fw-bold">COFNIJ</button>
            </form>
        <?php endif; ?>
    </main>
    <?php
        if (isset($_POST['nastepne_pytanie']) && isset($_POST['odpowiedz'])) //jeżeli udzielono odpowiedzi
        {
            $odp = $_POST['odpowiedz'] == "1" ? 1 : 0; //jeżeli odpowiedz to tak to ustawia 1, jeżeli nie to ustawia 0
            $_SESSION['odpowiedzi'][] = [$nr_pytania, $odp];; //zapisuje do tablicy nr pytania i odp na tak/nie
            $_SESSION['nr_pytania'] = $nr_pytania + 1; //zapisuje do sesji nr pytania
            unset($nr_pytania, $odp);
            header('Location: kwestionariusz.php');
            exit();
        }
        if (isset($_POST['cofnij'])) {
            
            if ($_SESSION['nr_pytania'] > 1) 
            {
                $_SESSION['nr_pytania'] = $nr_pytania - 1;
            }//Zmniejsza numer pytania tylko jak jest większy niż 1

            array_pop($_SESSION['odpowiedzi']); //Usuwa ostatnią odpowiedź

            unset($nr_pytania, $odp);
            header('Location: kwestionariusz.php');
            exit();
        }
	require "footer.php";
    ?>
</body>
</html>
