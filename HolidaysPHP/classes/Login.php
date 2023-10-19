<?php

//Logowanie - od strony bazy danych

class Login extends Dbcon
{
    protected function getUser($email, $pwd, &$errors)
    {

//        kontra na SQL injection
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_email = ?;');
        $isValid = true;

        if (!$stmt->execute(array($email))) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($loginData) == 0) {
            $errors['email'] = "Nie ma takiego Emaila";
            $isValid = false;
        } else {
            $checkPwd = password_verify($pwd, $loginData[0]["users_pwd"]);

            if ($checkPwd == false) {
                $errors['pwd'] = "Nieprawidłowe hasło";
                $isValid = false;
            } elseif ($checkPwd == true) {
                $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_email = ? AND users_pwd = ?;');


                if (!$stmt->execute(array($email, $loginData[0]["users_pwd"]))) {
                    $stmt = null;
                    $errors['email'] = "stmtfailed";
                    $isValid = false;
                }

                $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($loginData) == 0) {
                    $stmt = null;
                    $errors['email'] = "Nie ma takiego użytkownika";
                    $isValid = false;
                }


                if ($isValid) {


//                    Start sesji i przypisanie wartości
                    session_start();

                    $_SESSION['logged_in'] = true;
                    $_SESSION["userid"] = $loginData[0]["users_id"];
                    $_SESSION["email"] = $loginData[0]["users_email"];
                    $_SESSION["role"] = $loginData[0]["users_role"];
                    $_SESSION['form_filled'] = false;
                    $_SESSION['form_valid'] = '';
                    $name = $loginData[0]["users_name"];
                    $surename = $loginData[0]["users_surename"];

                    $_SESSION["fullname"] = $name . ' ' . $surename;

                    header("location: index.php");
                }
            }
        }


    }

}