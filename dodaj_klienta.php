<!DOCTYPE html>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel doradcy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="icon" type="image/x-icon" href="zdjecia/favicon.png" />
</head>
<body>
    <div class="container-fluid text-center w-25 mt-5">
        <form method="post">
            <p class="h2">Dodaj nowego klienta</p>
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="imie_klienta" id="imie_klienta" class="form-control" required placeholder="Podaj imie">
                <label for="imie_klienta" class="form-label">Imię</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="nazwisko_klienta" id="nazwisko_klienta" class="form-control" required placeholder="Podaj nazwisko">
                <label for="nazwisko_klienta" class="form-label">Nazwisko</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="email" name="email_klienta" id="email_klienta" class="form-control" required placeholder="Podaj email">
                <label for="email_klienta" class="form-label">E-mail</label>
            </div>
            <button type="submit" name="dodaj_klienta" class="btn btn-primary w-50 mt-3">Dodaj klienta</button>
        </form>
        <?php
        function randomPassword($length)
        {
            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $generated_pass = '';
            for ($i = 0; $i<$length; $i++)
            {
                $index = random_int(0, strlen($characters) -1);
                $generated_pass .= $characters[$index];
            }
            return $generated_pass;
        }
        if (isset($_POST['dodaj_klienta']))
        {
            $imie = $_POST['imie_klienta'];
            $nazwisko = $_POST['nazwisko_klienta'];
            $email = $_POST['email_klienta'];
            $haslo = randomPassword(7);
            $hasloHash = password_hash($haslo, PASSWORD_BCRYPT);
            $data = date("Y-m-d");
            $sql = "INSERT INTO klient (email, haslo, status, data_utworzenia, imie, nazwisko) VALUES ('$email','$hasloHash', 1,'$data','$imie','$nazwisko')";
            $check = "SELECT * FROM klient WHERE email = '$email'";
            if (mysqli_num_rows(mysqli_query($conn, $check)) == 0)
            {
                if (mysqli_query($conn, $sql)) 
                {
                    $id_doradcy = $_SESSION['id_doradcy'];
                    $id_klienta = mysqli_insert_id($conn);
                    $sql = "INSERT INTO doradztwo (id_klienta, id_doradcy, id_status) VALUES ('$id_klienta','$id_doradcy', 1)";
                    if (mysqli_query($conn, $sql))
                    {
                        echo "<div class='alert alert-success alert-dismissible mt-5'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>Pomyślnie dodano użytkownika!</strong></div>";
                        echo $haslo;
                    }
                    else
                    {
                        echo "<div class='alert alert-danger alert-dismissible mt-5'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>Wystąpił błąd!</strong></div>";
                    }
                }              
                else
                {
                    echo "<div class='alert alert-danger alert-dismissible mt-5'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>Wystąpił błąd!</strong></div>";
                }
            }
            else
            {
                echo "<div class='alert alert-danger alert-dismissible mt-5'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>Ten użytkownik już istnieje!</strong></div>";
            }

        }
        ?>
        <a href="doradca.php" class="btn btn-secondary mt-3">Wróć do panelu doradcy</a>
    </div>
</body>
</html>