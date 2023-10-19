<?php

//Klasa obsługująca logowanie
class LoginContr extends Login
{
    private $email;
    private $pwd;


    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser(&$errors)
    {
        $isValid = true;
        if (empty($this->email)) {
            $errors['email'] = "Nie może być puste!";
            $isValid = false;
        } elseif (empty($this->pwd)) {
            $errors['pwd'] = "Nie może być puste!";
            $isValid = false;
        }

        if ($isValid) {
            $this->getUser($this->email, $this->pwd, $errors);
        }

    }


}