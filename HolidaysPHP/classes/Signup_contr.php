<?php


//Klasa obsługująca rejestracje i walidacje wartości wpisywanych przez użytkownika
class SignupContr extends Signup
{
    private $uid;
    private $name;
    private $surename;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $role;
    private $pesel;


    public function __construct($uid, $name, $surename, $pwd, $pwdRepeat, $email, $role, $pesel)
    {
        $this->uid = $uid;
        $this->name = $name;
        $this->surename = $surename;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->role = $role;
        $this->pesel = $pesel;
    }


//    Walidacja danych wpisywanych przez użytkownika
    private function validateUser(&$errors, $updateValid = false)
    {
        $isValid = true;

        if (!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $errors['email'] = 'To musi być prawidłowy email';
        }
        if (empty($this->name)) {
            $errors['name'] = "Nie może być puste!";
            $isValid = false;
        }
        if (empty($this->surename)) {
            $errors['surename'] = "Nie może być puste!";
            $isValid = false;
        }

        if (!$this->checkUser($this->email) && !$updateValid) {
            $isValid = false;
            $errors['email'] = 'Email jest zajęty';
        }
        if (!$this->pwd || strlen($this->pwd) < 4) {
            $isValid = false;
            $errors['pwd'] = 'Hasło musi być dłuższe niż 3 znaki';
        }
        if ($this->pwdRepeat !== $this->pwd) {
            $isValid = false;
            $errors['pwdrepeat'] = 'Hasła muszą być takie same';
        }
        if (!preg_match('/^[0-9]{11}$/', $this->pesel)) {
            $isValid = false;
            $errors['pesel'] = 'Pesel musi mieć 11 cyfr';
        }
        if ($this->pesel == '00000000000') {
            $isValid = false;
            $errors['pesel'] = 'Nie może być taki pesel';
        }


        return $isValid;
    }


//    Przekazanie danych do klasy Signup gdzie dojdzie do dodania do bazy danych
    public function signupUser(&$errors)
    {

        if ($this->validateUser($errors) == true) {
            $this->setUser($this->name, $this->surename, $this->pwd, $this->email, $this->role, $this->pesel);
            header("location: index.php");
        }

    }

//    Przekazanie danych do klasy Signup gdzie dojdzie do aktualizacji użytkownika w bazie
    public function updateUser(&$errors, $updateValid)
    {
        if ($this->validateUser($errors, $updateValid) == true) {
            $this->editUser($this->uid, $this->name, $this->surename, $this->email, $this->pesel, $this->role);
            header("location: listUser.php");
        }

    }

}