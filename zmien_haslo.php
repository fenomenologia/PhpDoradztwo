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
                <div id="PasswordsNotSame" style="display:none">Hasła się nie zgadzają</div>
            </div>
            <button class="btn btn-primary" type="submit" onclick="CzyTakieSame(event)">Zmień hasło</button>
        </form>
        <script>
            function CzyTakieSame(event)
            {
                event.preventDefault();
                var NewPass = document.getElementById('newPass').value;
                var NewPassRepeat = document.getElementById('newPassRepeat').value;

                if (NewPass == NewPassRepeat)
                {
                    document.getElementById('PasswordsNotSame').style.display = 'none';
                    document.getElementById('ZmianaHasla').submit();
                }
                else
                {
                    document.getElementById('PasswordsNotSame').style.display = 'block';
                }
            }
        </script>
    </div>
</body>
</html>