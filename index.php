<!DOCTYPE html>
<?php
    require_once 'conn.php';
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwestionariusz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
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
	<?php
	if (isset($_POST['zaloguj']))
	{
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		$sql1 = "SELECT id, email, haslo FROM klient WHERE email = '$login' AND status = 1";
		$sql2 = "SELECT id, email, haslo, czy_admin FROM doradca WHERE email = '$login' AND czy_aktywny = 1";
		$resultKlient = mysqli_query($conn, $sql1);
		$resultDoradca = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($resultKlient) != 0) //jeżeli email klienta jest w bazie
		{
			$row = mysqli_fetch_array($resultKlient);
			if (password_verify($pass, $row['haslo'])) //jeżeli hasło jest poprawne
			{
				//przejdź do strony z kwestionariuszem i zapisz id klienta
				session_start();
				$_SESSION['id_klienta'] = $row['id'];
				header("Location: main_site.php");
			}
			else //jeżeli hasło jest złe
			{
				$msg = "PODANO NIEPOPRAWNE HASŁO!";
			}
		}
		else if (mysqli_num_rows($resultDoradca) != 0) // jeżeli email doradcy jest w bazie
		{
			$row = mysqli_fetch_array($resultDoradca);
			if (password_verify($pass, $row['haslo'])) //jeżeli hasło jest poprawne
			{
				if ($row['czy_admin'] == 0)
				{
					//przejdź do strony doradcy i zapisz id doradcy
					session_start();
					$_SESSION['id_doradcy'] = $row['id'];
					header("Location: doradca.php");
				}
				else
				{
					//przejdź do strony admina i zapisz jego id
					session_start();
					$_SESSION['id_admina'] = $row['id'];
					header("Location: admin.php");
				}
			}
			else //jeżeli hasło jest złe
			{
				$msg = "PODANO NIEPOPRAWNE HASŁO!";
			}
		}
		else //jeżeli emaila nie ma w bazie
		{
			$msg = "PODANO NIEPOPRAWNY LOGIN!";
		}
	}
	?>
	<main class="container-fluid text-white bg-image bg-primary mt-5 flex-fill">
		<div class="container-fluid text-center w-25">
			<p class="h2 fw-bold">ZALOGUJ SIĘ</p>
			<form method="post" class="text-black">
				<div class="form-floating mt-5 mb-3">
					<input type="text" name="login" id="login" required class="form-control" placeholder="Podaj login lub email">
					<label for="login" class="form-label">Login lub e-mail</label>
				</div>
				<div class="form-floating mt-3 mb-3">
					<input type="password" name="pass" id="pass" class="form-control" required placeholder="Podaj hasło">
					<label for="pass" class="form-label">Hasło</label>
				</div>
				<span style="color: red" class="fw-bold mb-3 mt-3"><?php if (isset($msg))
					echo $msg;?></span><br />
				<input type="submit" value="ZALOGUJ SIĘ" name="zaloguj" class="btn btn-primary fw-bold mt-3">
			</form>
		</div>
	</main>
	<?php
	require "footer.php";
	?>
</body>
</html>
