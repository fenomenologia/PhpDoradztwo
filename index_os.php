<!DOCTYPE html>
<?php
    require_once 'conn.php';
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
    <div class="container-fluid p-5 text-center bg-primary text-white">
        <p class="h1">Kwestionariusz osobowości</p>
    </div>
    <div class="container-fluid p5 mt-5 text-center w-25">
    <p class="h2">Zaloguj się</p>
        <form method="post">
            <div class="form-floating mt-5 mb-3">
                <input type="text" name="login" id="login" required class="form-control" placeholder="Podaj login lub email">
                <label for="login" class="form-label">Login lub email</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="password" name="pass" id="pass" class="form-control" required placeholder="Podaj hasło">
                <label for="pass" class="form-label">Hasło:</label>
            </div>
            <input type="submit" value="Zaloguj się" name="zaloguj" class="btn btn-primary">
        </form>
        <?php
            if (isset($_POST['zaloguj']))
            {
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $sql1 = "SELECT id, email, haslo FROM klient WHERE email = '$login' AND status = 1";
                $sql2 = "SELECT id, email, haslo FROM doradca WHERE email = '$login' AND czy_aktywny = 1";
                $resultKlient = mysqli_query($conn, $sql1);
                $resultDoradca = mysqli_query($conn, $sql2);

                if (mysqli_num_rows($resultKlient) != 0) //jeżeli email klienta jest w bazie
                {
                    $row = mysqli_fetch_array($resultKlient);
                    if (password_verify($pass, $row['haslo'])) //jeżeli hasło jest poprawne
                    {
                        //przejdź do strony z kwestionariuszem i zapisz id klienta
                        session_start();
                        $_SESSION['id_klienta'] = $row['id'];
                        header("Location: main_site_os.php");
                    }
                    else //jeżeli hasło jest złe
                    {
                        //złe hasło
                    }
                }
                else if (mysqli_num_rows($resultDoradca) != 0) // jeżeli email doradcy jest w bazie
                {
                    $row = mysqli_fetch_array($resultDoradca);
                    if (password_verify($pass, $row['haslo'])) //jeżeli hasło jest poprawne
                    {
                        //przejdź do strony doradcy i zapisz id doradcy
                        session_start();
                        $_SESSION['id_doradcy'] = $row['id'];
                        header("Location: doradca.php");
                    } else //jeżeli hasło jest złe
                    {
                        //złe hasło
                    }
                }
                else //jeżeli emaila nie ma w bazie
                {
                    //zły login
                }
            }
        ?>
    </div>
</body>
</html>
