<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();

if (!isset($_SESSION['id_doradcy']))
{
	header("Location: index.php");
	exit();
}

if (isset($_SESSION['dodano']))
{
	if ($_SESSION['dodano'] == true)
	{
		$msg = "<div class='alert alert-success alert-dismissible mt-5 container-fluid w-50'>
			<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
			<strong>Pomyślnie dodano użytkownika!</strong></div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger alert-dismissible mt-5 container-fluid w-50'>
			<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
			<strong>Wystąpił błąd podczas wysyłania e-maila: {$_SESSION['mailError']}</strong></div>";
	}
	unset($_SESSION['dodano']);
	unset($_SESSION['mailError']);
}
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
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
                        <a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="doradca.php">STRONA GŁÓWNA</a> 
                    </li>
					<li class="nav-item">
						<a class="nav-link btn btn-primary text-white me-3 fw-bold" href="dodaj_klienta.php">DODAJ NOWEGO KLIENTA</a>
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
    <main class="container-fluid text-center mt-5 bg-image bg-primary flex-fill">
		<p class="h2 capital fw-bold">Dodaj nowego klienta</p>
        <form method="post" id="form" class="container-fluid w-25 text-black">
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="imie_klienta" id="imie_klienta" class="form-control" required placeholder="Podaj imie">
                <label for="imie_klienta" class="form-label">Imię</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="nazwisko_klienta" id="nazwisko_klienta" class="form-control" required placeholder="Podaj nazwisko">
                <label for="nazwisko_klienta" class="form-label">Nazwisko</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="email" name="email_klienta" id="email_klienta" class="form-control" required placeholder="Podaj email">
                <label for="email_klienta" class="form-label">E-mail</label>
            </div>
			<p class="fw-bold capital mt-3" id="errorMessage" style="color: red"> </p>
            <button type="submit" name="dodaj_klienta" class="btn btn-primary w-50 mt-3 fw-bold capital">Dodaj klienta</button>
        </form>
		<span><?php 
			  if (isset($msg))
				echo $msg;?>
		</span>
        <?php
        function randomPassword($length)
        {
            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $generated_pass = '';
            for ($i = 0; $i<$length; $i++)
            {
                $index = random_int(0, strlen($characters) -1);
                $generated_pass .= $characters[$index];
            }
            return $generated_pass;
        }
        if (isset($_POST['dodaj_klienta']))
        {
            $imie = $_POST['imie_klienta'];
            $nazwisko = $_POST['nazwisko_klienta'];
            $email = $_POST['email_klienta'];
            $haslo = randomPassword(7);
            $hasloHash = password_hash($haslo, PASSWORD_BCRYPT);
            $data = date("Y-m-d");
            $sql = "INSERT INTO klient (email, haslo, status, data_utworzenia, imie, nazwisko) VALUES ('$email','$hasloHash', 1,'$data','$imie','$nazwisko')";
            $check = "SELECT * FROM klient WHERE email = '$email'";
            if (mysqli_num_rows(mysqli_query($conn, $check)) == 0)
            {
                if (mysqli_query($conn, $sql)) 
                {
					$_SESSION['new_email'] = $email;
					$_SESSION['new_pass'] = $haslo;
					$_SESSION['kogo_dodac'] = 'klient';
                    $id_doradcy = $_SESSION['id_doradcy'];
                    $id_klienta = mysqli_insert_id($conn);
                    $sql = "INSERT INTO doradztwo (id_klienta, id_doradcy, id_status) VALUES ('$id_klienta','$id_doradcy', 1)";
					mysqli_query($conn, $sql);
					header("Location: mail.php");
					exit();
                }              
                else
                {
                    echo "<div class='alert alert-danger alert-dismissible mt-5'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>Wystąpił błąd!</strong></div>";
                }
            }
            else
            {
                echo "<div class='alert alert-danger alert-dismissible mt-5'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>Ten użytkownik już istnieje!</strong></div>";
            }
        }
        ?>
        <a href="doradca.php" class="btn btn-secondary mt-3 fw-bold capital">Wróć do panelu doradcy</a>
    </main>
	<?php
	require "footer.php";
	?>
</body>
</html>