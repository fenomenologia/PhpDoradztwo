<!DOCTYPE html>
<?php
    require_once 'conn.php';
    session_start();

	if (!isset($_SESSION['id_klienta']))
	{
		header("Location: index.php");
		exit();
	}
?>
<html lang="en">
<head>
  <title>Strona główna</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
    
		
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
    
		<div class="collapse navbar-collapse justify-content-center text-white" id="navbarNav">
		  <ul class="navbar-nav text-white">
			<li class="nav-item">
			  <a class="nav-link active btn btn-primary text-white me-3 fw-bold" href="main_site.php">STRONA GŁÓWNA</a>
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
	<main class="container-fluid p5 text-white bg-image bg-primary mt-5 flex-fill">
  
		<?php
			$id_klienta = $_SESSION['id_klienta'];
			$sql = "SELECT id_status FROM doradztwo WHERE id_klienta = '$id_klienta' AND id_status IS NOT NULL";
			$result = mysqli_fetch_array(mysqli_query($conn, $sql));
			$id_statusu = $result['id_status'];
			$_SESSION['id_statusu'] = $id_statusu;
			$czy_zakonczono = false;

			switch ($id_statusu)
			{
				case 1:
					echo "<p class='h2 fw-bold'>NIE ROZPOCZĘTO DORADZTWA</p>";
					echo "<a href='kwestionariusz.php' class='btn btn-primary w-50 mt-3 fw-bold'>ROZPOCZNIJ KWESTIONARIUSZ ZAINTERESOWAŃ ZAWODOWYCH</a>";
					break;
				case 2:
					echo "<p class='h2 fw-bold'>UKOŃCZONO 1/4 KWESTIONARIUSZE</p>";
					echo "<a href='motywacja.php' class='btn btn-primary w-50 mt-3 fw-bold'>ROZPOCZNIJ KWESTIONARIUSZ MOTYWACJI</a>";
					break;
				case 3:
					echo "<p class='h2 fw-bold'>UKOŃCZONO 2/4 KWESTIONARIUSZE</p>";
					echo "<a href='styleuczenia.php' class='btn btn-primary w-50 mt-3 fw-bold'>ROZPOCZNIJ KWESTIONARIUSZ STYLI UCZENIA SIĘ</a>";
					break;
				case 4:
					echo "<p class='h2 fw-bold'>UKOŃCZONO 3/4 KWESTIONARIUSZE</p>";
					echo "<a href='osobowosc.php' class='btn btn-primary w-50 mt-3 fw-bold'>ROZPOCZNIJ KWESTIONARIUSZ OSOBOWOŚCI</a>";
					break;
				case 5:
					echo "<p class='h2 fw-bold'>UKOŃCZONO DORADZTWO ZAWODOWE</p>";
					break;
			}
		?>
		<div class="mt-3 mb-3 container-fluid text-center">
			<br>
			<form method="POST"> 
				<button type='submit' name='zmiana' class='btn btn-primary fw-bold'>ZMIEŃ HASŁO</button>
			</form>
			<br>
			<?php
				if (isset($_POST['nowe_haslo'])) {
					$nowehaslo = $_POST['nowe_haslo'];
					$hasz = password_hash($nowehaslo, PASSWORD_BCRYPT);
					$ssql = "UPDATE klient SET haslo = '$hasz' WHERE id='$id_klienta'";
					mysqli_query($conn, $ssql);
				}
				if(isset($_POST['zmiana'])): ?>
				<form method='POST' id="changePassForm" class="w-25 container-fluid text-black">
					<div class="form-floating mt-3">
						<input type='password' name='nowe_haslo' class="form-control" id="nowe_haslo" placeholder='wpisz nowe hasło'>
						<label for="nowe_haslo" class="">Nowe hasło</label>
					</div>
					<div class="form-floating mt-3">
						<input type="password" name="nowe_haslo_repeat" class="form-control" id="nowe_haslo_repeat" placeholder="powtórz hasło" />
						<label for="nowe_haslo_repeat">Powtórz hasło</label>
					</div>
					<p id="error" style="display: none"></p>
					<input type='button' name='zmien' onclick="passwordCheck()" class="mt-3 btn btn-primary fw-bold" value='POTWIERDŹ'>
				</form>
			<?php endif ?>
			<a href="logout.php" class="btn btn-secondary mt-3 fw-bold">WYLOGUJ SIĘ</a>
		</div>
	</main>
	<?php
	require "footer.php";
	?>
	<script>
		function passwordCheck()
		{
			const form = document.getElementById('changePassForm');
			const error = document.getElementById('error');
			let pass = document.getElementById('nowe_haslo').value;
			let passRepeat = document.getElementById('nowe_haslo_repeat').value;

			function displayError(message)
			{
				error.textContent = message;
				error.style.display = "block";
				error.style.color = "red";
				error.style.fontWeight = 'bold';
			}
			if (pass != '') //jeżeli hasło nie jest puste
			{
				if (pass.length >= 7 & pass.length <= 20) //jeżeli hasło ma od 7 do 20 znaków
				{
					if (pass == passRepeat) //jeżeli hasła się się zgadzają
					{
						form.submit()
					}
					else
					{
						displayError("Hasła muszą się powtarzać!");
					}
				}
				else
				{
					displayError("Hasło musi posiadać od 7 do 20 znaków!");
				}
			}
			else
			{
				displayError("Należy wypełnić powyższe pola!");
			}
		}
	</script>
</body>
</html>
