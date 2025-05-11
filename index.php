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
</head>
<body class="d-flex flex-column bg-primary p-5">
	<header>
		<div class="row">
			<div class="col-sm-3"><img src="zdjecia/logo ibcu.png" alt="Logo" style="height: 100px; width: auto" /></div>
			<div class="col-sm-9 text-center text-white d-flex align-items-center"><p class="h1 fw-bold">KWESTIONARIUSZ ZAINTERESOWAŃ ZAWODOWYCH</p></div>
		</div>
	</header>
	<main class="container-fluid p5 text-white bg-image bg-primary mt-5 flex-fill">
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
				<input type="submit" value="ZALOGUJ SIĘ" name="zaloguj" class="btn btn-primary fw-bold">
			</form>
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
						//złe hasło
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
							session_start();
							$_SESSION['id_doradcy'] = $row['id'];
							header("Location: admin.php");
						}
					}
					else //jeżeli hasło jest złe
					{
						//złe hasło
					}
				}
				else //jeżeli emaila nie ma w bazie
				{
					//zły login
				}
			}
			?>
		</div>
	</main>
	<?php
	require "footer.php";
	?>
</body>
</html>
