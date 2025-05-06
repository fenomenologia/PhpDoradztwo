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
    if (isset($_POST['rozpocznij']))
    {
        $_SESSION['nr_pytania_style'] = 1;
        session_write_close();
        header("Location: styleuczenia.php");
        exit();
    }
    if (!isset($_SESSION['nr_pytania_style']))
    {
        $_SESSION['nr_pytania_style'] = 0;
    }

    if (isset($_SESSION['nr_pytania_style']) && $_SESSION['nr_pytania_style'] == 0)
    {
        echo '<p class="display-5">Oceń każdą z możliwości odpowiedzi, przydzielając 1, 2 lub 3 punkty. Następnie kliknij przycisk "Następne pytanie".</p><br />
                <form method="post" action="styleuczenia.php">
                 <button type="submit" class="btn btn-primary btn-lg display-5" name="rozpocznij" >Rozpocznij</button>
                </form>';
    }
    else
    {
        $sql = 'SELECT tresc FROM pytania_style WHERE nr_pytania = ' . $_SESSION['nr_pytania_style'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0)
        {
            header("Location: przejscie.php");
            exit();
        }
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
        echo "<form method='POST' name='formOdpowiedzi' id='formOdpowiedzi'><div class='row'>";
        echo "<div class='col'></div>";
        echo "<div class='col'><input type='number' max=3 min=1 value='' id='liczba1' name='liczba1'></div>";
        echo "<div class='col'><input type='number' max=3 min=1 value='' id='liczba2' name='liczba2'></div>";
        echo "<div class='col'><input type='number' max=3 min=1 value='' id='liczba3' name='liczba3'></div>";
        echo "<div class='col'></div>";
        echo "</div>";
        echo "<p id='errorMessage' class='mt-3'></p>";
        echo "<button type='button' onclick='SprawdzLiczby()' class='btn btn-primary mt-3'>Następne pytanie</button>";
        if ($_SESSION['nr_pytania_style'] > 1)
        {
            echo "<button type='button' onclick='PoprzedniePytanie()' class='btn btn-secondary mt-3 ms-2'>Poprzednie pytanie</button>";
        }
        echo "</form>";
        if ($_SESSION['nr_pytania_style'] > 1)
        {
            echo "<form method='post' id='cofnijPytanie' style='display: none'><input type='hidden' name='cofnijPytanieInput' value='1'></form>";
        }
    }

    if (isset($_POST['liczba1']))
    {
        $liczba1 = (int)$_POST['liczba1'];
        $liczba2 = (int)$_POST['liczba2'];
        $liczba3 = (int)$_POST['liczba3'];
        $nr_pytania = $_SESSION['nr_pytania_style'];
        $_SESSION['odpowiedzi_style'][] = [$nr_pytania, $liczba1, $liczba2, $liczba3];
        $_SESSION['nr_pytania_style'] += 1;
        header("Location: styleuczenia.php");
        exit();
    }
    if (!isset($_SESSION['odpowiedzi_style']))
    {
        $_SESSION['odpowiedzi_style'] = [];
    }
    if (isset($_POST['cofnijPytanieInput']))
    {
        $_SESSION['nr_pytania_style'] -= 1;
        array_pop($_SESSION['odpowiedzi_style']);
        header("Location: styleuczenia.php");
        exit();
    }
    ?>
    </div>
    <script>
        function SprawdzLiczby()
        {
            const formOdpowiedzi = document.getElementById('formOdpowiedzi');
            const errorMessage = document.getElementById('errorMessage');
            const opcje = [1, 2, 3];
            let liczba1 = parseInt(document.getElementById('liczba1').value);
            let liczba2 = parseInt(document.getElementById('liczba2').value);
            let liczba3 = parseInt(document.getElementById('liczba3').value);

            if (opcje.includes(liczba1) && opcje.includes(liczba2) && opcje.includes(liczba3))
            {
                if (liczba1 != liczba2 && liczba1 != liczba3 && liczba2 != liczba3)
                {
                    errorMessage.textContent = '';
                    formOdpowiedzi.submit();
                }
                else
                {
                    errorMessage.textContent = "Cyfry muszą się od siebie róźnić!";
                    errorMessage.style.color = 'red';
                    errorMessage.style.fontWeight = 'bold';
                }
            }
            else
            {
                errorMessage.textContent = "Cyfry muszą być w zakresie od 1 do 3!";
                errorMessage.style.color = 'red';
                errorMessage.style.fontWeight = 'bold';
            }

        }
        function PoprzedniePytanie()
        {
            document.getElementById('cofnijPytanie').submit();
        }
    </script>
</body>
</html>