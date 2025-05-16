<!DOCTYPE html>
<?php
require_once 'conn.php';
session_start();

if (!isset($_SESSION['id_klienta']))
{
	header("Location: index.php");
	exit();
}
$sql = "SELECT id_status FROM doradztwo WHERE id_klienta = " . $_SESSION['id_klienta'];
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['id_status'];
if ($result != 3)
{
	header("Location: main_site.php");
	exit();
}
if (isset($_POST['rozpocznij']))
{
	$_SESSION['nr_pytania_style'] = 1;
	session_write_close();
	header("Location: styleuczenia.php");
	exit();
}
if (!isset($_SESSION['nr_pytania_style']))
{
	$_SESSION['nr_pytania_style'] = 0;
}
?>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Styl uczenia się</title>
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
	<link href="style.css" rel="stylesheet" />
    <style>
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button 
    {
        opacity: 1 !important;
    }
</style>
</head>
<body class="bg-primary text-center text-white">
	<header class="bg-white">
		<img src="zdjecia/header_image.jpg" alt="Header" style="height: 80px; width: auto" />
	</header>
	<nav class="navbar navbar-expand-sm">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<a href="#" class="navbar-brand"><img style="height: 100px" src="zdjecia/logo ibcu.png" alt="Logo"/></a>
			<div class="collapse navbar-collapse justify-content-center text-white">
				<span class="navbar-text text-white fw-bold h2">
					<?php
					if ($_SESSION['nr_pytania_style'] != 0)
						echo "Pytanie nr. " . $_SESSION['nr_pytania_style'];
					?>
				</span>
			</div>
		</div>
	</nav>
    <main class="container-fluid text-center bg-image bg-primary">
    <?php

	if (isset($_SESSION['nr_pytania_style']) && $_SESSION['nr_pytania_style'] == 0):

		?>
		<p class="display-5 capital fw-bold ms-3 me-3">
			Przeczytaj uważnie każdą z trzech proponowanych odpowiedzi i przydziel każdej z nich unikalną wartość: 1, 2 lub 3 punkty.
			<ul class="display-5 w-75 container-fluid">
				<li>1 punkt – odpowiedź najmniej do Ciebie pasuje</li>
				<li>2 punkty – odpowiedź pasuje umiarkowanie</li>
				<li>3 punkty – odpowiedź najlepiej Cię opisuje</li>
			</ul>
		</p>
		<p class="display-5 capital fw-bold">
			Każdą z wartości (1, 2, 3) możesz wykorzystać tylko raz — każda odpowiedź musi mieć inną liczbę punktów.
			Następnie kliknij przycisk "Następne pytanie", aby kontynuować.
		</p>
        <form method="post" action="styleuczenia.php">
            <button type="submit" class="btn btn-primary btn-lg display-5 capital fw-bold" name="rozpocznij" >Rozpocznij</button>
        </form>
	<?php
	else:
		{
			$sql = 'SELECT tresc FROM pytania_style WHERE nr_pytania = ' . $_SESSION['nr_pytania_style'];
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 0)
			{
				$_SESSION['wstaw'] = true;
				header("Location: przejscie.php");
			}
			$row = mysqli_fetch_assoc($result);
			echo "<p class='h3 mb-5 capital fw-bold'>" . $row['tresc'] . "</p>";
			echo "<div class='row'>";
			echo "<div class='col'></div>";
			while ($row = mysqli_fetch_assoc($result))
			{
				echo "<div class='col'><p class='lead capital fw-bold'>" . mb_strtoupper($row['tresc']) . "</p></div>";
			}
			echo "<div class='col'></div>";
			echo "</div>";
			echo "<form method='POST' name='formOdpowiedzi' id='formOdpowiedzi'><div class='row'>";
			echo "<div class='col'></div>";
			//echo "<div class='col'><input type='number' max=3 min=1 value='' id='liczba1' name='liczba1'></div>";
			//echo "<div class='col'><input type='number' max=3 min=1 value='' id='liczba2' name='liczba2'></div>";
			//echo "<div class='col'><input type='number' max=3 min=1 value='' id='liczba3' name='liczba3'></div>";
			for ($i =1; $i <= 3; $i++)
			{
				echo "<div class='col'>";
				for ($j = 1; $j <= 3; $j++)
				{
					echo "<input type='radio' class='btn-check' value='$j' id='liczba$i$j' name='liczba$i' required autocomplete='off'>";
					echo "<label for='liczba$i$j' class='btn btn-outline-primary fw-bold capital ms-2'>$j</label>";
				}
				echo "</div>";
			}
			echo "<div class='col'></div>";
			echo "</div>";
			echo "<p id='errorMessage' class='mt-3 fw-bold capital'></p>";
			echo "<button type='button' onclick='SprawdzLiczby()' class='btn btn-primary mt-3 capital fw-bold'>Następne pytanie</button>";
			if ($_SESSION['nr_pytania_style'] > 1)
			{
				echo "<button type='button' onclick='PoprzedniePytanie()' class='btn btn-secondary mt-3 ms-2 capital fw-bold'>Poprzednie pytanie</button>";
			}
			echo "</form>";
			if ($_SESSION['nr_pytania_style'] > 1)
			{
				echo "<form method='post' id='cofnijPytanie' style='display: none'><input type='hidden' name='cofnijPytanieInput' value='1'></form>";
			}
		}
	endif;

    if (isset($_POST['liczba1']))
    {
        $liczba1 = (int)$_POST['liczba1'];
        $liczba2 = (int)$_POST['liczba2'];
        $liczba3 = (int)$_POST['liczba3'];
        $nr_pytania = $_SESSION['nr_pytania_style'];
        $_SESSION['odpowiedzi_style'][] = [$nr_pytania, $liczba1, $liczba2, $liczba3];
        $_SESSION['nr_pytania_style'] += 1;
        header("Location: styleuczenia.php");
    }
    if (!isset($_SESSION['odpowiedzi_style']))
    {
        $_SESSION['odpowiedzi_style'] = [];
    }
    if (isset($_POST['cofnijPytanieInput']))
    {
        $_SESSION['nr_pytania_style'] -= 1;
        array_pop($_SESSION['odpowiedzi_style']);
        header("Location: styleuczenia.php");
    }
    ?>
    </main>
	<script>
    function SprawdzLiczby()
    {
        const formOdpowiedzi = document.getElementById('formOdpowiedzi');
        const errorDisplay = document.getElementById('errorMessage');
        const opcje = [1, 2, 3];
		let errorMessage = '';
        let liczba1 = document.querySelector('input[name="liczba1"]:checked');
        let liczba2 = document.querySelector('input[name="liczba2"]:checked');
        let liczba3 = document.querySelector('input[name="liczba3"]:checked');

		//walidacja
		//jezeli liczby sa puste
		if (!liczba1 || !liczba2 || !liczba3)
		{
			errorMessage = "Zaznacz jedną odpowiedź w każdym wierszu!";
		}
		else
		{
			liczba1 = parseInt(liczba1.value);
			liczba2 = parseInt(liczba2.value);
			liczba3 = parseInt(liczba3.value);

			//jezeli liczby nie sa w zakresie od 1 do 3 -- uzyte tylko jesli uzytkownik zmieni value za pomoca przegladarki
			if (!opcje.includes(liczba1) || !opcje.includes(liczba2) || !opcje.includes(liczba3))
			{
				errorMessage = "Cyfry muszą być w zakresie od 1 do 3!";
			}
			//jezeli liczby nie roznia sie od siebie
			if (liczba1 == liczba2 || liczba1 == liczba3 || liczba2 == liczba3)
			{
				errorMessage = "Cyfry muszą się od siebie róźnić!";
			}
		}
			

		//jezeli walidacja sie powiodla
		if (errorMessage == '')
		{
			errorDisplay.textContent = '';
			formOdpowiedzi.submit();
		}
		//jezeli walidacja sie nie powiodla
		else
		{
			errorDisplay.textContent = errorMessage;
			errorDisplay.style.color = 'red';
			errorDisplay.style.fontWeight = 'bold';
		}
	}
	function PoprzedniePytanie()
	{
		document.getElementById('cofnijPytanie').submit();
	}
	</script>

	<?php
	require "footer.php";
	?>
</body>
</html>