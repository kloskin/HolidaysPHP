<?php

//Klasa odpowiedzialna za łączenie bazy danych

class Dbcon
{
    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $dbcon = new PDO('mysql:host=localhost;dbname=DbHolidays', $username, $password);
            return $dbcon;
        } catch (PDOException $e) {
            print "Eroor!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getConnection()
    {
        return $this->connect();
    }

}

$dbcon = new Dbcon(); // Tworzenie instancji klasy Dbcon
$connection = $dbcon->getConnection(); // Nawiązywanie połączenia z bazą danych
