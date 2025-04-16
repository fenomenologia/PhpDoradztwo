<!DOCTYPE html>
<?php
require_once "conn.php";
session_start();
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
            <button class="btn btn-primary" type="submit" onclick="Walidacja(event)">Zmień hasło</button>
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
                    var isValid = false;
                }
                else if (NewPass.length > maxLength)
                {
                    document.getElementById('ValidationError').innerText = 'Hasło musi zawierać mniej niż ' + maxLength + ' znaków!';
                    document.getElementById('ValidationError').style.display = 'block';
                    var isValid = false;
                }
                else if (NewPass != NewPassRepeat)
                {
                    document.getElementById('ValidationError').innerText = 'Hasła się nie zgadzają';
                    document.getElementById('ValidationError').style.display = 'block';
                    var isValid = false;
                }

                if (isValid == true)
                {
                    document.getElementById('ValidationError').style.display = 'none';
                    document.getElementById('ZmianaHasla').submit();
                }
            }
        </script>
    </div>
</body>
</html>