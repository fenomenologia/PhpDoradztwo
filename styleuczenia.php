<!DOCTYPE html>
<?php
require_once 'conn.php';
session_start();
?>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Styl uczenia się</title>
    <style>
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button 
    {
        opacity: 1 !important;
    }
</style>
</head>
<body>

    <div class="container-fluid bg-primary text-white text-center p-5">
        <p class="h2">Style uczenia się</p>
    </div>
    <div class="container-fluid text-center p-5">
    <?php
    if (isset($_SESSION['nr_pytania_style']))
    {
        if ($_SESSION['nr_pytania_style'] == 0)
        {
            echo '  <p class="display-5">Oceń każdą z możliwości odpowiedzi, przydzielając 1, 2 lub 3 punkty. Następnie kliknij przycisk "Następne pytanie".</p><br />
                    <form method="post" action="styleuczenia.php">
                        <button type="submit" name="rozpocznij" class="btn btn-primary btn-lg display-5">Rozpocznij</button>
                    </form>
                </div>';
        }
        else
        {
            $sql = 'SELECT tresc FROM pytania_style WHERE nr_pytania = ' . $_SESSION['nr_pytania_style'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo "<p class='h3 mb-5'>" . $row['tresc'] . "</p>";
            echo "<div class='row'>";
            echo "<div class='col'></div>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<div class='col'><p class='lead'>".$row['tresc']."</p></div>";
            }
            echo "<div class='col'></div>";
            echo "</div>";
            echo "<form method='POST'><div class='row'>";
            echo "<div class='col'></div>";
            echo "<div class='col'><input type='number' max=3 min=1 value=0 required></div>";
            echo "<div class='col'><input type='number' max=3 min=1 value=0 required></div>";
            echo "<div class='col'><input type='number' max=3 min=1 value=0 required></div>";
            echo "<div class='col'></div>";
            echo "</div></form>";
        }
    }
    else
    {
        $_SESSION['nr_pytania_style'] = 0;
        echo '<div class="container-fluid text-center p-5">
                    <p class="display-5">Oceń każdą z możliwości odpowiedzi, przydzielając 1, 2 lub 3 punkty. Następnie kliknij przycisk "Następne pytanie".</p><br />
                    <form method="post" action="styleuczenia.php">
                        <button type="submit" class="btn btn-primary btn-lg display-5">Rozpocznij</button>
                    </form>
                </div>';
    }

    if (isset($_POST['rozpocznij']))
    {
        $_SESSION['nr_pytania_style'] = 1;
        header("Location: styleuczenia.php");
        exit();
    }
    ?>
    </div>
</body>
</html>