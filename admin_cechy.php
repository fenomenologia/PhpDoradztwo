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
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="admin_doradcy.php">DORADCY</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="admin_doradztwa.php">DORADZTWA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="admin_pytania.php">PYTANIA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-primary active text-white me-3 fw-bold" href="admin_cechy.php">CECHY</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-danger text-white me-3 fw-bold" href="logout.php">WYLOGUJ SIĘ</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <main class="container-fluid text-center bg-image bg-primary flex-fill">
        <h2 class="fw-bold">CECHY</h2>
        <?php
        $sql = "SELECT * FROM cecha";
        $result = mysqli_query($conn, $sql);
		?>

        <table class='table table-dark table-stripped table-hover table-bordered mt-5'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">NAZWA</th>
					<th scope="col">OPIS</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['nazwa'] . "</td><td>" . $row['opis'] . "</td></tr>";
			}
			?>
			</tbody>
		</table>

        <h2 class="capital fw-bold mt-3 mb-3">Dodawanie/Modyfikacja Cech</h2>
        <form method="POST" class="form-floating container-fluid w-50 text-black">
			<div class="form-floating mt-3">
				<input type="text" placeholder="nazwa" class="form-control" name="nazwa" id='nazwa' required>
				<label for="nazwa">Nazwa cechy</label>
			</div>
			<div class="form-floating mt-3">
				<textarea class="form-control" name="opis" id="opis" placeholder="opis" required></textarea>
				<label for="opis">Opis</label>
			</div>
            <input type="submit" value="DODAJ/ZMIEŃ" name="dod_c" class="capital fw-bold btn btn-primary mt-3">
        </form>
        <?php
        if (isset($_POST['dod_c'])) {
            $nazwa = $_POST['nazwa'];
            $opis = $_POST['opis'];
            $is = false;
            $ressult = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($ressult))
            {
                if($row['nazwa'] == $nazwa)
                {
                    $is = true;
                }
            }
            if($is == true)
            {
                $ssql = "UPDATE cecha SET opis = '$opis' WHERE nazwa = '$nazwa'; ";
            } else {
                $ssql = "INSERT INTO cecha(nazwa, opis) VALUES ('$nazwa', '$opis'); ";
            }
            mysqli_query($conn, $ssql);
            header("Location: admin_cechy.php");
			exit();
        }
        ?>
        <h2 class="fw-bold capital mt-5">Style Uczenia</h2>
        <?php
        $sqll = "SELECT * FROM style_uczenia";
        $result = mysqli_query($conn, $sqll);
		?>
		<table class='table table-dark table-stripped table-hover table-bordered mt-5'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">NAZWA</th>
					<th scope="col">OPIS</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['nazwa'] . "</td><td>" . $row['tresc'] . "</td></tr>";
			}
			?>
			</tbody>
		</table>
        <h2 class="capital fw-bold mt-3 mb-3">Dodawanie/Modyfikacja Stylów</h2>
        <form method="POST" class="form-floating container-fluid w-50 text-black">
			<div class="form-floating mt-3">
				<input type="text" placeholder="nazwa" name="nazwaa" class="form-control" id="nazwa2" required>
				<label for="nazwa2">Nazwa</label>
			</div>
			<div class="form-floating mt-3">
				<textarea placeholder="opis" name="opisa" id="opis2" class="form-control" required></textarea>
				<label for="opis2">Opis</label>
			</div>
            <input type="submit" value="Dodaj/Zmień" name="dod_ca" class="btn btn-primary capital fw-bold mt-3">
        </form>
        <?php
        if (isset($_POST['dod_ca'])) {
            $nazwa = $_POST['nazwaa'];
            $opis = $_POST['opisa'];
            $is = false;
            $ressult = mysqli_query($conn, $sqll);
            while ($row = mysqli_fetch_assoc($ressult)) {
                if ($row['nazwa'] == $nazwa) {
                    $is = true;
                }
            }
            if ($is == true) {
                $ssql = "UPDATE style_uczenia SET tresc = '$opis' WHERE nazwa = '$nazwa'; ";
            } else {
                $ssql = "INSERT INTO style_uczenia(nazwa, tresc) VALUES ('$nazwa', '$opis'); ";
            }
            mysqli_query($conn, $ssql);
            header("Location: admin_cechy.php");
			exit();
        }
        ?>
    </main>
	<?php
	require "footer.php";
	?>
</body>
</html>