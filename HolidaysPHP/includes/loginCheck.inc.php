<?php

//Plik odpowiedzialny za sprawdzanie sessji, sprawdzanie uprawnień
function buttonChecker($button, $url)
{
    if (!isset($button)) {
        header("Location: $url");
        exit;
    }
}

function sessionChecker()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Użytkownik nie jest zalogowany, przekieruj na stronę logowania lub wyświetl komunikat
        header("Location: login.php");
        exit;
    }


}

function adminChecker()
{
    if ($_SESSION['role'] !== 'admin') {
        // Użytkownik nie ma odpowiednich uprawnień, przekieruj lub wyświetl komunikat
        header("Location: index.php");
        exit;
    }
}

function bossChecker()
{
    if ($_SESSION['role'] == 'kierownik' || $_SESSION['role'] == 'admin') {
    } else {
        header("Location: index.php");
        exit;
    }
}

