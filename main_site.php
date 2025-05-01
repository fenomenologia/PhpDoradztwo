<!DOCTYPE html>
<?php
    require_once 'conn.php';
    session_start();
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
  <div class="row">
        <?php
            $id_klienta = $_SESSION['id_klienta'];
            $sql = "SELECT id_status FROM doradztwo WHERE id_klienta = '$id_klienta' AND id_status IS NOT NULL";
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));
            $id_statusu = $result['id_status'];
            $_SESSION['id_statusu'] = $id_statusu;
            $czy_zakonczono = false;
            $button_text;
            switch ($id_statusu)
            {
                case 1:
                    echo "<p class='h2'>Nie rozpocząłeś jeszcze doradztwa</p>";
                    $button_text = "Rozpocznij doradztwo";
                    break;
                case 2:
                    echo "<p class='h2'>Jesteś w trakcie doradztwa</p>";
                    $button_text = "Kontynuuj doradztwo";
                    break;
                case 3:
                    echo "<p class='h2'>Zakończyłeś już doradztwo</p>";
                    $czy_zakonczono = true;
                    break;
                default:
                    echo "<p class='h2'>Nie masz żadnych aktywnych doradztw</p>";
                    break;
            }
        ?>
        <div class="mt-3 mb-3">
            <form action="kwestionariusz.php" method="post">
                <?php
                    if ($czy_zakonczono == false && $id_statusu != null)
                    {
                        echo "<button type='submit' name='rozpocznij_doradztwo' class='btn btn-primary'>".$button_text."</button>";
                    }
                ?>
            </form>
            <a href="logout.php" class="btn btn-primary">Wyloguj się</a>
        </div>
  </div>
</div>

</body>
</html>