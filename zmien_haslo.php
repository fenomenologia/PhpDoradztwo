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
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zmiana hasła</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid text-center w-50">
        <p class="h2">Zmień hasło</p>
        <form method="post" class="was-validated" id="ZmianaHasla">
            <div class="form-floating mt-3 mb-3">
                <input type="password" name="newPass" id="newPass" class="form-control" required placeholder="Nowe hasło" />
                <label for="newPass" class="form-label">Nowe hasło</label>
                <div class="invalid-feedback">Należy wypełnić to pole</div>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="newPassRepeat" id="newPassRepeat" class="form-control" required placeholder="Powtórz hasło" />
                <label for="newPassRepeat" class="form-label">Powtórz hasło</label>
                <div class="invalid-feedback">Należy wypełnić to pole</div>
                <div id="ValidationError" class="text-danger" style="display:none"></div>
            </div>
            <button class="btn btn-primary mt-3 mb-3" type="submit" onclick="Walidacja(event)">Zmień hasło</button>
            <a href="doradca.php" class="btn btn-secondary mt-3 mb-3">Wróć do strony głównej</a> 
        </form>
        <script>
            function Walidacja(event)
            {
                event.preventDefault();

                var isValid = true;
                var minLength = 5;
                var maxLength = 20;
                var NewPass = document.getElementById('newPass').value;
                var NewPassRepeat = document.getElementById('newPassRepeat').value;

                if (NewPass.length < minLength)
                {
                    document.getElementById('ValidationError').innerText = 'Hasło musi zawierać co najmniej ' + minLength + ' znaków!';
                    document.getElementById('ValidationError').style.display = 'block';
                    isValid = false;
                }
                else if (NewPass.length > maxLength)
                {
                    document.getElementById('ValidationError').innerText = 'Hasło musi zawierać mniej niż ' + maxLength + ' znaków!';
                    document.getElementById('ValidationError').style.display = 'block';
                    isValid = false;
                }
                else if (NewPass != NewPassRepeat)
                {
                    document.getElementById('ValidationError').innerText = 'Hasła się nie zgadzają';
                    document.getElementById('ValidationError').style.display = 'block';
                    isValid = false;
                }

                if (isValid == true)
                {
                    document.getElementById('ValidationError').style.display = 'none';
                    document.getElementById('ZmianaHasla').submit();
                }
            }
        </script>
        <?php
        if  (isset($_POST['newPass']))
        {
            $id_doradcy = $_SESSION['id_doradcy'];
            $newPass = password_hash($_POST['newPass'], PASSWORD_BCRYPT);
            $sql = "UPDATE doradca SET haslo = '$newPass' WHERE id = '$id_doradcy'";
            if (mysqli_query($conn, $sql))
            {
                echo "<div class='alert alert-success'>Pomyślnie zmieniono hasło<div>";
            }
            else
            {
                echo "<div class='alert alert-danger'>Wystąpił błąd<div>";
            }
        }
        ?>

    </div>
</body>
</html>