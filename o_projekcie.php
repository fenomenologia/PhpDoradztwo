<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O projekcie</title>
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
			  <a class="nav-link  btn btn-secondary text-white me-3 fw-bold" href="index.php">STRONA GŁÓWNA</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link active btn btn-primary text-white me-3 fw-bold" href="o_projekcie.php">O PROJEKCIE</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="kontakt.php">KONTAKT</a>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	<main class="container-fluid p5 text-white bg-image bg-primary mt-5 flex-fill">
		<div class="p-5 d-flex flex-row justify-content-evenly align-items-center">
			<span class="text-start display-6">
				<b>PHP Kwestionariusz Zainteresowań Zawodowych</b> to aplikacja internetowa wspierająca pracę doradców zawodowych.
				Umożliwia ona przeprowadzanie testów, zapisywanie wyników i wspiera doradcę podczas tworzenia Indywidualnych Planów Działania.
				System ma trzy panele: dla uczestnika, doradcy i administratora. Jest prosty w obsłudze i dostępny z różnych urządzeń. 
				Dzięki cyfrowej formie ułatwia i przyspiesza cały proces doradztwa zawodowego.
			</span>
			<img src="zdjecia/globe.png" class="text-end" style="width:250px; height: auto"/>
		</div>
	</main>
	<?php
	require "footer.php";
	?>
</body>
</html>
