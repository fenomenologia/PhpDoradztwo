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
						<a class="nav-link btn btn-primary text-white active me-3 fw-bold" href="admin_pytania.php">PYTANIA</a>
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
    <main class="container-fluid text-center text-white bg-image bg-primary">
        <h3 class="capital fw-bold">Kwestionariusz zainteresowań zawodowych:</h3>
		<?php
        if (isset($_POST['dodaj_a'])) {
            $pytanie = $_POST['pytanie'];
            $nr = $_POST['nr_pyt'];
            $is = false;
            $sqll = "SELECT * FROM pytania; ";
            $resullt = mysqli_query($conn, $sqll);
            while ($row = mysqli_fetch_assoc($resullt)) {
                if ($row['nr_pytania'] == $nr) {
                    $is = true;
                }
            }
            if ($is == true) {
                $ssql = "UPDATE pytania SET pytania = '$pytanie' WHERE nr_pytania = '$nr'; ";
            } else {
                $ssql = "INSERT INTO pytania(pytania, nr_pytania) VALUES ('$pytanie', '$nr'); ";
            }
            mysqli_query($conn, $ssql);
        }

        $sql = "SELECT * FROM pytania; ";
        $result = mysqli_query($conn, $sql);
		?>
		<table class='table table-dark table-stripped table-hover table-bordered mt-5 w-auto container-fluid'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">NR. PYTANIA</th>
					<th scope="col">TREŚĆ</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['nr_pytania'] . "</td><td>" . $row['pytania'] . "</td></tr>";
			}
			?>
			</tbody>
		</table>
        <h3 class="capital fw-bold mt-3">Dodawanie/Zmiana pytań:</h3>
        <form method="POST" action="admin_pytania.php" class="form-floating container-fluid w-50 text-black">
			<div class="mt-3 form-floating">
				<textarea class="form-control" id="pytanie" name="pytanie" placeholder="Wpisz treść pytania" required></textarea>
				<label for="pytanie">Wpisz treść pytania</label>
			</div>
			<div class="mt-3 form-floating">
				<input type="number" name="nr_pyt" id="nr_pyt" class="form-control" placeholder="Wpisz numer pytania" required>
				<label for="nr_pyt">Wpisz numer pytania</label>
			</div>
            <input type="submit" name="dodaj_a" class="btn btn-primary mt-3 capital fw-bold" value="Dodaj/zamień pytanie">
        </form>
        <h3 class="capital fw-bold mt-5">Kwestionariusz motywacji:</h3>
		<?php
        if (isset($_POST['dodaj_b'])) {
            $pytanie = $_POST['pytanie_b'];
            $nr = $_POST['nr_pyt_b'];
            $iss = false;
            $sqlll = "SELECT * FROM pytania_motywacje;";
            $resullt = mysqli_query($conn, $sqlll);
            while ($row = mysqli_fetch_assoc($resullt)) {
                if ($row['nr_pytania'] == $nr) {
                    $iss = true;
                }
            }
            if ($iss == true) {
                $ssqll = "UPDATE pytania_motywacje SET tresc = '$pytanie' WHERE nr_pytania = '$nr'; ";
            } else {
                $ssqll = "INSERT INTO pytania_motywacje(tresc, nr_pytania) VALUES ('$pytanie', '$nr'); ";
            }
            mysqli_query($conn, $ssqll);
        }

        $sqql = "SELECT * FROM pytania_motywacje; ";
        $result = mysqli_query($conn, $sqql);
		?>
		<table class='table table-dark table-stripped table-hover table-bordered mt-5 container-fluid w-auto'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">NR. PYTANIA</th>
					<th scope="col">TREŚĆ</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['nr_pytania'] . "</td><td>" . $row['tresc'] . "</td></tr>";
			}
			?>
			</tbody>
		</table>

        <h3 class="capital fw-bold">Dodawanie/Zmiana pytań:</h3>
        <form method="POST" action="admin_pytania.php" class="form-floating container-fluid w-50 text-black">
			<div class="form-floating mt-3">
				<textarea name="pytanie_b" id="pytanie_b" class="form-control" placeholder="Wpisz treść pytania" required></textarea>
				<label for="pytanie_b">Wpisz treść pytania</label>
			</div>
			<div class="form-floating mt-3">
				<input type="number" name="nr_pyt_b" id="nr_pyt_b" class="form-control" placeholder="Wpisz numer pytania" required>
				<label for="nr_pyt_b">Wpisz numer pytania</label>
			</div>
            <input type="submit" name="dodaj_b" class="btn btn-primary mt-3 capital fw-bold" value="Dodaj/zamień pytanie">
        </form>

        <h3 class="capital fw-bold mt-5">Kwestionariusz osobowości:</h3>
		<?php
        if (isset($_POST['dodaj_c'])) {
            $pytanie = $_POST['pytanie_c'];
            $rodz = $_POST['select'];
            $ssqll = "INSERT INTO pytania_osobowosc(tresc, rodzaj) VALUES ('$pytanie', '$rodz'); ";
            mysqli_query($conn, $ssqll);
        }

        $sqqll = "SELECT * FROM pytania_osobowosc; ";
        $result = mysqli_query($conn, $sqqll);
		?>
		<table class='table table-dark table-stripped table-hover table-bordered mt-5 container-fluid w-auto'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">RODZAJ</th>
					<th scope="col">TREŚĆ</th>
				</tr>
			</thead>
			<tbody>

			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['rodzaj'] . "</td><td>" . $row['tresc'] . "</td></tr>";
			}
			?>
			</tbody>
		</table>

        <h3 class="mt-3 capital fw-bold">Dodawanie pytań:</h3>
        <form method="POST" action="admin_pytania.php" class="form-floating container-fluid w-50 text-black">
			<div class="form-floating mt-3">
				<input type="text" name="pytanie_c" id="pytanie_c" class="form-control" placeholder="Wpisz nazwe cechy" required>
				<label for="pytanie_c">Wpisz nazwę cechy</label>
			</div>
            <select name="select" class="form-select mt-3" required>
				<option value="none" selected disabled hidden>Wybierz typ cechy</option>
                <option value="mocne">Mocne</option>
                <option value="slabe">Słabe</option>
            </select>
            <input type="submit" name="dodaj_c" class="btn btn-primary capital fw-bold mt-3" value="Dodaj ceche">
        </form>

        <h3 class="capital fw-bold mt-3">Zmiana pytań:</h3>
        <form method="POST" class="form-floating container-fluid w-50 text-black">
			<div class="form-floating mt-3">
				<input type="number" name="id" id="id_a" class="form-control" placeholder="wpisz id pytania" required>
				<label for="id_a">Wpisz ID pytania</label>
			</div>
			<div class="form-floating mt-3">
				<input type="text" name="pytanie_ca" id="pytanie_ca" class="form-control" placeholder="Wpisz nazwe cechy" required>
				<label for="pytanie_ca">Wpisz nazwę cechy</label>
			</div>
            
            <select name="select_a" class="form-select mt-3">
				<option value="none" selected disabled hidden>Wybierz typ cechy</option>
                <option value="mocne">mocne</option>
                <option value="slabe">słabe</option>
            </select>
            <input type="submit" name="dodaj_ca" class="btn btn-primary mt-3 capital" value="Zmień ceche">
        </form>
        <?php
        if (isset($_POST['dodaj_ca'])) {
            $pytanie = $_POST['pytanie_ca'];
            $rodz = $_POST['select_a'];
            $id = $_POST['id'];
            $ssqll = "UPDATE pytania_osobowosc SET tresc='$pytanie', rodzaj='$rodz' WHERE id='$id'";
            mysqli_query($conn, $ssqll);
            header("Location: admin_pytania.php");
			exit();
        }
        ?>
                <br><br><br>
        <h3 class="capital fw-bold">Kwestionariusz styli uczenia:</h3>
        <?php
        $sqql = "SELECT * FROM pytania_style; ";
        $result = mysqli_query($conn, $sqql);
		?>
		<table class='table table-dark table-stripped table-hover table-bordered mt-5 container-fluid w-auto'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">NR. PYTANIA</th>
					<th scope="col">TREŚĆ</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['nr_pytania'] . "</td><td>" . $row['tresc'] . "</td></tr>";
			}
			?>
			</tbody>
		</table>
        <h3 class="mt-3 capital fw-bold">Dodawanie/Zmiana pytań:</h3>
        <form method="POST" class="form-floating container-fluid text-black w-50">
			<div class="form-floating mt-3">
				<textarea name="pytanie_da" id="pytanie_da" class="form-control" placeholder="Wpisz treść pytania" required></textarea>
				<label for="pytanie_da">Wpisz treść pytania</label>
			</div>
            <div class="form-floating mt-3">
				<textarea name="pytanie_db" id="pytanie_db" class="form-control" placeholder="opcja dla wzrokowca" required></textarea>
				<label for="pytanie_db">Opcja dla wzrokowca</label>
			</div>
            <div class="form-floating mt-3">
				<textarea name="pytanie_dc" id="pytanie_dc" class="form-control" placeholder="opcja dla słuchowca" required></textarea>
				<label for="pytanie_dc">Opcja dla słuchowca</label>
			</div>
			<div class="form-floating mt-3">
				<textarea name="pytanie_dd" id="pytanie_dd" class="form-control" placeholder="opcja dla ruchowca" required></textarea>
				<label for="pytanie_dd">Opcja dla słuchowca</label>
			</div>
			<div class="form-floating mt-3">
				<input type="number" name="nr_pyt_d" id="nr_pyt_d" class="form-control" placeholder="Wpisz numer pytania" required>
				<label for="nr_pyt_d">Wpisz numer pytania</label>
			</div>
            <input type="submit" name="dodaj_d" class="capital fw-bold btn btn-primary mt-3" value="Dodaj/zamień pytanie">
        </form>
        <?php
        if (isset($_POST['dodaj_d'])) {
            $pytanie = $_POST['pytanie_da'];
            $wzrok = $_POST['pytanie_db'];
            $sluch = $_POST['pytanie_dc'];
            $ruch = $_POST['pytanie_dd']; 
            $nr = $_POST['nr_pyt_d'];
            $iss = false;
            $sqlll = "SELECT * FROM pytania_style;";
            $resullt = mysqli_query($conn, $sqlll);
            while ($row = mysqli_fetch_assoc($resullt)) {
                if ($row['nr_pytania'] == $nr) {
                    $iss = true;
                    $ide = $row['id'];
                }
            }
            if ($iss == true) {
                $id1 = $ide - 3;
                $id2 = $ide - 2;
                $id3 = $ide - 1;
                $id4 = $ide;

                $ssqll = "UPDATE pytania_style SET tresc = '$pytanie' WHERE nr_pytania = '$nr' AND id = $id1;";
                $ssqll2 = "UPDATE pytania_style SET tresc = '$wzrok' WHERE nr_pytania = '$nr' AND id = $id2;";
                $ssqll3 = "UPDATE pytania_style SET tresc = '$sluch' WHERE nr_pytania = '$nr' AND id = $id3;";
                $ssqll4 = "UPDATE pytania_style SET tresc = '$ruch' WHERE nr_pytania = '$nr' AND id = $id4;";
            } else {
                $ssqll = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$pytanie', '$nr'); ";
                $ssqll2 = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$wzrok', '$nr'); ";
                $ssqll3 = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$sluch', '$nr'); ";
                $ssqll4 = "INSERT INTO pytania_style(tresc, nr_pytania) VALUES ('$ruch', '$nr'); ";
            }
            mysqli_query($conn, $ssqll);
            mysqli_query($conn, $ssqll2);
            mysqli_query($conn, $ssqll3);
            mysqli_query($conn, $ssqll4);
            header("Location: admin_pytania.php");
			exit();
        }
        ?>
    </main>
	<?php
	require "footer.php";
	?>
</body>
</html>