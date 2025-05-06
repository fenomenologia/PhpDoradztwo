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
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Witaj w kwestionariuszu zainteresowań zawodowych</h1>
</div>
  
<div class="container mt-5 text-center">
  
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
            echo "<p class='h2'>Nie rozpoczęto doradztwa</p>";
            echo "<a href='kwestionariusz.php' class='btn btn-primary w-50 mt-3'>Rozpocznij kwestionariusz zainteresowań zawodowych</a>";
            break;
        case 2:
            echo "<p class='h2'>Ukończono 1/4 kwestionariusze</p>";
            echo "<a href='motywacja.php' class='btn btn-primary w-50 mt-3'>Rozpocznij kwestionariusz motywacji</a>";
            break;
        case 3:
            echo "<p class='h2'>Ukończono 2/4 kwestionariusze</p>";
            echo "<a href='styleuczenia.php' class='btn btn-primary w-50 mt-3'>Rozpocznij kwestionariusz styli uczenia się</a>";
			break;
		case 4:
			echo "<p class='h2'>Ukończono 3/4 kwestionariusze</p>";
			echo "<a href='osobowosc.php' class='btn btn-primary w-50 mt-3'>Rozpocznij kwestionariusz osobowości</a>";
			break;
		case 5:
			echo "<p class='h2'>Ukończono doradztwo zawodowe</p>";
			break;
    }
?>
<div class="mt-3 mb-3">
    <br>
    <form method="POST"> 
        <button type='submit' name='zmiana' class='btn btn-primary'>Zmień Hasło</button>
    </form>
    <br>
    <?php
        if (isset($_POST['zmien'])) {
            $nowehaslo = $_POST['nowe_haslo'];
            $hasz = password_hash($nowehaslo, PASSWORD_BCRYPT);
            $ssql = "UPDATE klient SET haslo = '$hasz' WHERE id='$id_klienta'";
            mysqli_query($conn, $ssql);
        }
        if(isset($_POST['zmiana']))
        {
            echo "<form method='POST'>
                    <input type='text' name='nowe_haslo' placeholder='wpisz nowe hasło' required>
                    <input type='submit' name='zmien' value='Potwierdź'>
                </form>";
        }
    ?>
    <a href="logout.php" class="btn btn-secondary mt-3">Wyloguj się</a>
</div>
 
</div>
</body>
</html>
