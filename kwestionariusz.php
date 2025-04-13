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
        if (isset($_POST['rozpocznij_doradztwo']) && $_SESSION['id_statusu'] == 1) //zmienienie statusu na 'w trakcie'
        {
            mysqli_query($conn, "UPDATE doradztwo SET id_status = 2 WHERE id_klienta = ".$_SESSION['id_klienta']);
        }
        //jeżeli zmienne nie są ustawione to je ustawia
        if (!isset($_SESSION['odpowiedzi'])) 
        {
            $_SESSION['odpowiedzi'] = [];
        }

        if (!isset($_SESSION['nr_pytania']))
        {
            $_SESSION['nr_pytania'] = 1;
        }
        $nr_pytania = $_SESSION['nr_pytania'];
        
    ?>
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <p class="h2">Pytanie nr. <?php echo $nr_pytania?></p>
    </div>
    <div class="container-fluid mt-5 text-center p-5">
        <?php
            $sql = "SELECT pytania FROM pytania WHERE nr_pytania = '$nr_pytania'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {
                $pytanie = mysqli_fetch_assoc($result);
            }
            else
            {
                header("Location: wynik.php"); //jeśli nie ma już pytań przekierowuje do strony z wynikiem
                exit();
            }

            echo "<p class='h3 mt-3 mb-3'>".$pytanie['pytania']."</p>";
        ?>
        <form method="post">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                    <label for="odpowiedz_tak">Tak</label>
                    <input type="radio" name="odpowiedz" id="odpowiedz_tak" required value="1">
                </div>
                <div class="col-sm-2">
                    <label for="odpowiedz_nie">Nie</label>
                    <input type="radio" name="odpowiedz" id="odpowiedz_nie" required value="0">
                </div>
                <div class="col-sm-4"></div>
            </div>
            <button type="submit" name="nastepne_pytanie" class="btn btn-primary mt-3">Następne pytanie</button>
        </form>
    </div>
    <?php
        if (isset($_POST['nastepne_pytanie']) && isset($_POST['odpowiedz'])) //jeżeli udzielono odpowiedzi
        {
            $odp = $_POST['odpowiedz'] == "1" ? 1 : 0; //jeżeli odpowiedz to tak to ustawia 1, jeżeli nie to ustawia 0
            $_SESSION['odpowiedzi'][] = [$nr_pytania, $odp];; //zapisuje do tablicy nr pytania i odp na tak/nie
            $_SESSION['nr_pytania'] = $nr_pytania + 1; //zapisuje do sesji nr pytania
            unset($nr_pytania, $odp);
            header('Location: kwestionariusz.php');
            exit();
        }
    ?>
</body>
</html>