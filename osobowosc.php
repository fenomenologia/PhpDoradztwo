<!DOCTYPE html>
<?php
require_once 'conn.php';
session_start();
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwestionariusz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
    if (!isset($_SESSION['odp_os'])) {
        $_SESSION['odp_os'] = [];
    }

    if (!isset($_SESSION['nr_pyt_os'])) {
        $_SESSION['nr_pyt_os'] = 1;
    }
    $nr_pytania = $_SESSION['nr_pyt_os'];

    ?>
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <p class="h2">Czy ta cecha do ciebie pasuje?</p>
    </div>
    <div class="container-fluid mt-5 text-center p-5">
        <?php
        $sql = "SELECT tresc FROM pytania_osobowosc WHERE id = '$nr_pytania'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $pytanie = mysqli_fetch_assoc($result);
        } else {
            $mocne = [];
            $slabe = [];

            foreach ($_SESSION['odp_os'] as $odpowiedz) {
                list($id_pytania, $wartosc) = $odpowiedz;
                if ($wartosc == 1) {
                    $query = "SELECT tresc FROM pytania_osobowosc WHERE id = $id_pytania";
                    $res = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($res)) {
                        $tresc = $row['tresc'];
                        if ($id_pytania >= 1 && $id_pytania <= 54) {
                            $mocne[] = $tresc;
                        } elseif ($id_pytania > 54) {
                            $slabe[] = $tresc;
                        }
                    }
                }
            }

            $mocne_str = implode(", ", $mocne);
            $slabe_str = implode(", ", $slabe);

			unset($_SESSION['odp_os']);
			unset($_SESSION['nr_pyt_os']);

			$_SESSION['odpowiedzi_osobowosc'] = [$mocne_str, $slabe_str];
            exit();
        }

        echo "<p class='h3 mt-3 mb-3'>" . $pytanie['tresc'] . "</p>";
        ?>
        <form method="post">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                    <label for="odpowiedz_tak">Tak</label>
                    <input type="radio" name="odp_os" id="odpowiedz_tak" required value="1">
                </div>
                <div class="col-sm-2">
                    <label for="odpowiedz_nie">Nie</label>
                    <input type="radio" name="odp_os" id="odpowiedz_nie" required value="0">
                </div>
                <div class="col-sm-4"></div>
            </div>
            <button type="submit" name="nastepne_pytanie" class="btn btn-primary mt-3">Następne pytanie</button>
        </form>
        <?php if ($_SESSION['nr_pyt_os'] > 1): ?>
            <form method="post">
                <button type="submit" name="cofnij" class="btn btn-secondary mt-3">Cofnij</button>
            </form>
        <?php endif; ?>
    </div>
    <?php
    if (isset($_POST['nastepne_pytanie']) && isset($_POST['odp_os'])) //jeżeli udzielono odpowiedzi
    {
        $odp = $_POST['odp_os'] == "1" ? 1 : 0; //jeżeli odpowiedz to tak to ustawia 1, jeżeli nie to ustawia 0
        $_SESSION['odp_os'][] = [$nr_pytania, $odp];
        ; //zapisuje do tablicy nr pytania i odp na tak/nie
        $_SESSION['nr_pyt_os'] = $nr_pytania + 1; //zapisuje do sesji nr pytania
        unset($nr_pytania, $odp);
        header('Location: kwestionariusz_os.php');
        exit();
    }
    if (isset($_POST['cofnij'])) {

        if ($_SESSION['nr_pytania'] > 1) {
            $_SESSION['nr_pytania'] = $nr_pytania - 1;
        }//Zmniejsza numer pytania tylko jak jest większy niż 1
    
        array_pop($_SESSION['odpowiedzi']); //Usuwa ostatnią odpowiedź
    
        unset($nr_pytania, $odp);
        header('Location: kwestionariusz_os.php');
        exit();
    }
    ?>
</body>
</html>
