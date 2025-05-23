﻿<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();

if (!isset($_SESSION['id_doradcy']))
{
	header("Location: index.php");
	exit();
}
?>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły</title>
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
						<a class="nav-link btn btn-secondary text-white me-3 fw-bold" href="zmien_haslo.php">ZMIEŃ HASŁO</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-danger text-white me-3 fw-bold" href="logout.php">WYLOGUJ SIĘ</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <main class="container-fluid text-center bg-image bg-primary flex-fill">
        <?php
        if (isset($_POST['id']))
        {
            $id_klienta = $_POST['id'];
            $_SESSION['id_wysw'] = $id_klienta;
        }
        else
        {
            $id_klienta =  $_SESSION['id_wysw'];
        }

        $sql = "SELECT klient.imie, klient.nazwisko, doradztwo.data, doradztwo.id, cecha.nazwa, wynik.punkty
        FROM klient JOIN doradztwo ON doradztwo.id_klienta = klient.id 
        JOIN wynik ON wynik.id_doradztwa = doradztwo.id 
        JOIN cecha ON cecha.id = wynik.id_cechy 
        WHERE klient.id = " . $id_klienta;
        if ($result = mysqli_query($conn, $sql))
        {
            if (mysqli_num_rows($result) > 0)
            {
                echo "<p class='h2 capital fw-bold mt-5'>motywacje zawodowe klienta</p>";
                $ilosc_doradztw = mysqli_num_rows($result) / 5;
                echo "<table class='table table-dark table-stripped table-bordered mt-5 w-auto container-fluid'>
                    <thead>
                        <tr>
                            <th scope='col'>Data doradztwa</th>
                            <th scope='col'>Cecha</th>
                            <th scope='col'>Ilość zdobytych punktów</th>
                        </tr>
                    </thead>
                    <tbody>";
                for ($j = 0; $j < $ilosc_doradztw * 5; $j++)
                {
                    $row = mysqli_fetch_assoc($result);
                    if ($j % 5 == 0)
                    {
                        echo "<tr>
                            <td rowspan=5 class='align-middle'>" . $row['data'] . "</td>
                            <td>" . $row['nazwa'] . "</td>
                            <td>" . $row['punkty'] . "</td>
                           </tr>";
                    }
                    else
                    {
                        echo "<tr><td>" . $row['nazwa'] . "</td><td>" . $row['punkty'] . "</td></tr>";
                    }
                }
                echo "</tbody></table>";
            }
            else
            {
                echo "<p class='h2 fw-bold capital'>Ten klient nie ma żadnych doradztw</p>";
            }
        }
        else
        {
            echo "<div class='fw-bold capital alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Błąd!</strong> Wystąpił błąd.
                </div>";
        }
        $sql_motyw = "
        SELECT doradztwo.data,pytania_motywacje.tresc, wynik_motywacje.punkty
        FROM klient
        JOIN doradztwo ON doradztwo.id_klienta = klient.id
        JOIN wynik_motywacje ON wynik_motywacje.id_doradztwa = doradztwo.id
		JOIN pytania_motywacje ON pytania_motywacje.id = wynik_motywacje.id_pytania
        WHERE klient.id = $id_klienta";

        $result_motyw = mysqli_query($conn, $sql_motyw);

        if ($result_motyw && mysqli_num_rows($result_motyw) > 0) 
        {
            echo "<p class='h2 mt-5 capital fw-bold'>Wyniki motywacji klienta</p>";
            echo "<table class='table table-dark table-stripped table-bordered mt-5 w-auto container-fluid'>
            <thead>
                <tr>
                    <th>Data doradztwa</th>
                    <th>Pytanie</th>
                    <th>Punkty</th>
                </tr>
            </thead>
            <tbody>";

            $rows = mysqli_fetch_all($result_motyw, MYSQLI_ASSOC);
            $total = count($rows);

            for ($i = 0; $i < $total; $i++) 
            {
                $row = $rows[$i];
                if ($i % 5 == 0) 
                {
                    echo "<tr>
                    <td rowspan='5' class='align-middle'>{$row['data']}</td>
                    <td>{$row['tresc']}</td>
                    <td>{$row['punkty']}</td>
                  </tr>";
                } else 
                {
                    echo "<tr>
                    <td>{$row['tresc']}</td>
                    <td>{$row['punkty']}</td>
                  </tr>";
                }
            }

            echo "</tbody></table>";
        } 
        else 
        {
            echo "<p class='h4 mt-4'>Brak wyników motywacji dla tego klienta.</p>";
        }

        $sql_osobowosc = "
        SELECT  doradztwo.data, wynik_osobowosc.mocne_strony, wynik_osobowosc.slabe_strony
        FROM klient
        JOIN doradztwo ON doradztwo.id_klienta = klient.id
        JOIN wynik_osobowosc ON wynik_osobowosc.id_doradztwa = doradztwo.id
        WHERE klient.id = " . $id_klienta . "";

        $result_osobowosc = mysqli_query($conn, $sql_osobowosc);

        if ($result_osobowosc && mysqli_num_rows($result_osobowosc) > 0) 
        {
            echo "<p class='h2 mt-5 capital fw-bold'>Wyniki osobowości klienta</p>";
            echo "<table class='table table-dark table-stripped table-bordered mt-5 w-auto container-fluid'>
            <thead>
                <tr>
                    <th scope='col'>Data doradztwa</th>
                    <th scope='col'>Mocne strony</th>
                    <th scope='col'>Słabe strony</th>
                </tr>
            </thead>
            <tbody>";

            $rows = mysqli_fetch_all($result_osobowosc, MYSQLI_ASSOC);
            $total = count($rows);

            for ($i = 0; $i < $total; $i++) 
            {
                $row = $rows[$i];
                if ($i % 5 == 0) 
                {
                    echo "<tr>
                    <td class='align-middle'>{$row['data']}</td>
                    <td class='text-break'>{$row['mocne_strony']}</td>
                    <td class='text-break'>{$row['slabe_strony']}</td>
                  </tr>";
                } else 
                {
                    echo "<tr>
                    <td class='text-break'>{$row['mocne_strony']}</td>
                    <tdclass='text-break'>{$row['slabe_strony']}</td>
                  </tr>";
                }
            }

            echo "</tbody></table>";
        } 
        else 
        {
            echo "<p class='h4 mt-4'>Brak wyników osobowości dla tego klienta.</p>";
        }

        $sql_style = "
        SELECT doradztwo.data, style_uczenia.nazwa, style_uczenia.tresc, wynik_style_uczenia.punkty
        FROM klient
        JOIN doradztwo ON doradztwo.id_klienta = klient.id
        JOIN wynik_style_uczenia ON wynik_style_uczenia.id_doradztwa = doradztwo.id
        JOIN style_uczenia ON style_uczenia.id = wynik_style_uczenia.id_stylu
        WHERE klient.id = " . $id_klienta . "";

        $result_style = mysqli_query($conn, $sql_style);

        if ($result_style && mysqli_num_rows($result_style) > 0) 
        {
            echo "<p class='h2 mt-5 capital fw-bold'>Wyniki stylów uczenia klienta</p>";
            echo "<table class='table table-dark table-stripped table-bordered mt-5 mw-100 container-fluid'>
            <thead>
                <tr>
                    <th>Data doradztwa</th>
                    <th>Nazwa stylu</th>
                    <th>Treść stylu</th>
                    <th>Punkty</th>
                </tr>
            </thead>
            <tbody>";

            $rows = mysqli_fetch_all($result_style, MYSQLI_ASSOC);
            $total = count($rows);

            for ($i = 0; $i < $total; $i++) 
            {
                $row = $rows[$i];
                if ($i % 5 == 0) 
                {
                    echo "<tr>
                    <td rowspan='3' class='align-middle'>{$row['data']}</td>
                    <td>{$row['nazwa']}</td>
                    <td>{$row['tresc']}</td>
                    <td>{$row['punkty']}</td>
                  </tr>";
                } else 
                {
                    echo "<tr>
                    <td>{$row['nazwa']}</td>
                    <td>{$row['tresc']}</td>
                    <td>{$row['punkty']}</td>
                  </tr>";
                }
            }

            echo "</tbody></table>";
        } 
        else 
        {
            echo "<p class='h4 mt-4'>Brak wyników stylów uczenia dla tego klienta.</p>";
        }

        if (isset($_POST['usun']))
        {
            $sql = 'SELECT doradztwo.id FROM doradztwo WHERE id_klienta =' . $id_klienta;
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
                $sql = "DELETE FROM wynik WHERE wynik.id_doradztwa =" . $row[0];
                mysqli_query($conn, $sql);
                $sql = "DELETE FROM doradztwo WHERE doradztwo.id =" . $row[0];
                mysqli_query($conn, $sql);
            }
            $sql = "DELETE FROM klient WHERE id =" . $id_klienta;
            if (mysqli_query($conn, $sql))
            {
                header("Location: doradca.php");
            }
            else
            {
                echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Wystąpił nieoczekiwany błąd!</strong></div>';
            }
        }
        ?>
        <button class="btn btn-danger capital fw-bold" onclick="naPewno()">Usuń tego klienta</button>
    </main>
    <?php
    require "footer.php";
    ?>
    <form id="usunForm" method="post" style="display: none">
        <input type="hidden" name="usun" value="1" />
    </form>
    <script>
        function naPewno()
        {
            let odp = confirm("Czy na pewno chcesz usunąć tego klienta?");
            if (odp == true)
            {
                document.getElementById("usunForm").submit();
            }
        }
    </script>
</body>
</html>