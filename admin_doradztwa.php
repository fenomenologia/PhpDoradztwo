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
<body class="text-center bg-primary d-flex">
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
						<a class="nav-link btn btn-primary active text-white me-3 fw-bold" href="admin_doradztwa.php">DORADZTWA</a>
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
	<?php
    $sql = "SELECT * FROM doradztwo WHERE id_status = '5'; ";
    $result = mysqli_query($conn, $sql);
	?>
	<main class="container-fluid text-center bg-image bg-primary flex-fill">
		<table class='table table-dark table-stripped table-hover table-bordered mt-5 container-fluid w-auto'>
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">ID KLIENTA</th>
					<th scope="col">ID DORADCY</th>
					<th scope="col">DATA</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($row = mysqli_fetch_assoc($result))
				{
					echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['id_klienta'] . "</td><td>" . $row['id_doradcy'] . "</td><td>" . $row['data'] . "</tr>";
				}
				?>
			</tbody>
		</table>
	</main>
	<?php
	require "footer.php";
	?>
</body>
</html>