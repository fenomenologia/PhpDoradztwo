<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();
if (!isset($_SESSION['id_admina']))
{
	header("Location: index.php");
	exit();
}
?>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
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
						<a class="nav-link btn btn-primary active text-white me-3 fw-bold" href="admin_doradcy.php">DORADCY</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="admin_doradztwa.php">DORADZTWA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="admin_pytania.php">PYTANIA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="admin_cechy.php">CECHY</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-danger text-white me-3 fw-bold" href="logout.php">WYLOGUJ SIĘ</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

    <main class="container-fluid text-center bg-image bg-primary flex-fill">
        <h2 class="capital fw-bold mt-5">Dodawanie Doradcy</h2>
        <form method="POST" class="container-fluid w-25 text-black form-floating">
			<div class="form-floating mt-3">
				<input type="text" placeholder="imie" name="imie" id="imie" class="form-control" required>
				<label for="imie">Imię</label>
			</div>
            <div class="form-floating mt-3">
				<input type="text" placeholder="nazwisko" name="nazwisko" id="nazwisko" class="form-control" required>
				<label for="nazwisko">Nazwisko</label>
			</div>
			<div class="form-floating mt-3">
				<input type="email" placeholder="email" name="email" id="email" class="form-control" required>
				<label for="email">Email</label>
			</div>
            <input type="submit" value="Dodaj" name="dod_dor" class="btn btn-primary capital fw-bold mt-3">
        </form>
        <?php
            $data = date("Y-m-d");
            if(isset($_POST['dod_dor']))
            {
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $email = $_POST['email'];
                $haslo = '$2a$12$bK40cV4FIaBo.Y.pGTY2NuXg3FklAPTcgnV/BOArWHkQUsG3PmpfG';
                $sql = "INSERT INTO doradca(email, haslo, czy_aktywny, data_utworzenia, czy_admin, imie, nazwisko) VALUES ('$email', '$haslo', '1', '$data', '0', '$imie', '$nazwisko')";
                mysqli_query($conn, $sql);
                header("Location: admin_doradcy.php");
				exit();
            }

        $sql = "SELECT * FROM doradca; ";
        $result = mysqli_query($conn, $sql);
		?>
		<table class='table table-dark table-stripped table-hover table-bordered mt-5 container-fluid w-auto'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">IMIĘ</th>
					<th scope="col">NAZWISKO</th>
					<th scope="col">EMAIL</th>
					<th scope="col">DATA UTWORZENIA</th>
					<th scope="col">CZY AKTYWNY</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_assoc($result))
			{
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['imie'] . "</td><td>" . $row['nazwisko'] . "</td><td>" . $row['email'] . "</td><td>" . $row['data_utworzenia'] . "</td><td>";
				if ($row['czy_aktywny'] == 0)
				{
					$akt = 'nie';
				}
				else
				{
					$akt = 'tak';
				}
				echo mb_strtoupper($akt) . "</td>" . "</tr>";
			}
			?>
			</tbody>
		</table>
        <h2 class="capital fw-bold mt-5">Blokowanie/Odblokowywanie Doradcy</h2>
        <form method="POST" class="form-floating container-fluid text-black w-25">
			<div class="form-floating mt-3">
				<input type="number" placeholder="Wpisz ID" name="id_dor" id="id_dor" class="form-control" required>
				<label for="id_dor">Wpisz ID doradcy</label>
			</div>
            <input type="submit" value="Zablokuj/Odblokuj Doradcę" name="zablokuj" class="btn btn-primary mt-3 capital fw-bold">
        </form>
        <?php
        if (isset($_POST['zablokuj'])) {
            $idd = $_POST['id_dor'];
            $ssql = "SELECT * FROM doradca WHERE id='$idd'; ";
            $result = mysqli_query($conn, $ssql);
            $row = mysqli_fetch_assoc($result);
            if($row['czy_aktywny'] == 1)
            {
            $sssql = "UPDATE doradca SET czy_aktywny = 0 WHERE id = '$idd';";
            }
            else
            {
            $sssql = "UPDATE doradca SET czy_aktywny = 1 WHERE id = '$idd';";
            }
            mysqli_query($conn, $sssql);
            header("Location: admin_doradcy.php");
			exit();
        }
        ?>
    </main>
	<?php
	require "footer.php";
	?>
</body>
</html>