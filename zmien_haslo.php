<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();

if (!isset($_SESSION['id_doradcy']))
{
	header("Location: index.php");
	exit();
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zmiana hasła</title>
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
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="dodaj_klienta.php">DODAJ NOWEGO KLIENTA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-primary text-white me-3 fw-bold" href="zmien_haslo.php">ZMIEŃ HASŁO</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-danger text-white me-3 fw-bold" href="logout.php">WYLOGUJ SIĘ</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <main class="container-fluid text-center bg-image bg-primary flex-fill">
        <p class="h2 capital fw-bold">Zmień hasło</p>
        <form method="post" class="container-fluid w-25 text-black" id="ZmianaHasla">
            <div class="form-floating mt-3 mb-3">
                <input type="password" name="newPass" id="newPass" class="form-control" required placeholder="Nowe hasło" />
                <label for="newPass" class="form-label">Nowe hasło</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="newPassRepeat" id="newPassRepeat" class="form-control" required placeholder="Powtórz hasło" />
                <label for="newPassRepeat" class="form-label">Powtórz hasło</label>
                <div id="ValidationError" class="text-danger fw-bold" style="display:none"></div>
            </div>
            <button class="btn btn-primary mt-3 mb-3 capital fw-bold" type="submit" onclick="Walidacja(event)">Zmień hasło</button>
        </form>
        <script>
            function Walidacja(event)
            {
                event.preventDefault();

                var isValid = true;
                var minLength = 5;
                var maxLength = 20;
                var NewPass = document.getElementById('newPass').value;
                var NewPassRepeat = document.getElementById('newPassRepeat').value;

                if (NewPass.length < minLength)
                {
                    document.getElementById('ValidationError').innerText = 'Hasło musi zawierać co najmniej ' + minLength + ' znaków!';
                    document.getElementById('ValidationError').style.display = 'block';
                    isValid = false;
                }
                else if (NewPass.length > maxLength)
                {
                    document.getElementById('ValidationError').innerText = 'Hasło musi zawierać mniej niż ' + maxLength + ' znaków!';
                    document.getElementById('ValidationError').style.display = 'block';
                    isValid = false;
                }
                else if (NewPass != NewPassRepeat)
                {
                    document.getElementById('ValidationError').innerText = 'Hasła się nie zgadzają';
                    document.getElementById('ValidationError').style.display = 'block';
                    isValid = false;
                }

                if (isValid == true)
                {
                    document.getElementById('ValidationError').style.display = 'none';
                    document.getElementById('ZmianaHasla').submit();
                }
            }
        </script>
        <?php
        if  (isset($_POST['newPass']))
        {
            $id_doradcy = $_SESSION['id_doradcy'];
            $newPass = password_hash($_POST['newPass'], PASSWORD_BCRYPT);
            $sql = "UPDATE doradca SET haslo = '$newPass' WHERE id = '$id_doradcy'";
            if (mysqli_query($conn, $sql))
            {
                echo "<div class='alert alert-success fw-bold capital'>Pomyślnie zmieniono hasło<div>";
            }
            else
            {
                echo "<div class='alert alert-danger fw-bold capital'>Wystąpił błąd<div>";
            }
        }
        ?>

    </main>
	<?php
	require "footer.php";
	?>
</body>
</html>