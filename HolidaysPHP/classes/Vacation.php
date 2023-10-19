<?php

//rejestracja i aktualizacja urlopów- od strony bazy danych
class Vacation extends Dbcon
{

    //   Wysyłanie prósby o urlop przez użytkownika
    protected function request($usersID, $fullname, $email, $stEvDate, $endEvDate, $description, $status)
    {

//        SQL injection
        $stmt = $this->connect()->prepare('INSERT INTO request_vacation (request_users_fullname, request_start_event_date, request_end_event_date, request_description, request_users_id, request_users_email, request_status) VALUES (?, ?, ?, ?, ?, ?, ?)');


        if (!$stmt->execute(array($fullname, $stEvDate, $endEvDate, $description, $usersID, $email, $status))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }


//    Dodawanie zaakceptowanych przez kierownika albo admina urlopów
    protected function addVacation($usersID, $fullname, $email, $stEvDate, $endEvDate, $description, $status)
    {
        //        SQL injection
        $stmt = $this->connect()->prepare('INSERT INTO accepted_vacation (accepted_start_event_date, accepted_end_event_date, accepted_description, accepted_users_id, accepted_users_email, accepted_users_fullname) VALUES (?, ?, ?, ?, ?, ?)');


//        Kalendarz źle wyświetla date więc trzeba dodać 1 dzień
        $endEvDate = date('Y-m-d', strtotime($endEvDate . '+ 1 days'));


        if (!$stmt->execute(array($stEvDate, $endEvDate, $description, $usersID, $email, $fullname))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;


    }
}