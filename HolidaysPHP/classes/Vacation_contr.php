<?php


//Klasa obsługująca dodawanie i akceptacje urlopów
class VacationContr extends Vacation
{
    private $usersID;
    private $fullname;
    private $email;
    private $stEvDate;
    private $endEvDate;
    private $description;

    private $status;

    public function __construct($usersID, $fullname, $email, $stEvDate, $endEvDate, $description, $status)
    {
        $this->usersID = $usersID;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->stEvDate = $stEvDate;
        $this->endEvDate = $endEvDate;
        $this->description = $description;
        $this->status = $status;
    }


//    Sprawdza czy data startowa jest mniejsza bądź równa  dacie końcowej
    private function validateVacation(&$errors)
    {
        $isValid = true;

        if ($this->stEvDate > $this->endEvDate) {
            $isValid = false;
            $errors['dateEnd'] = 'Wpisz poprawnie datę!!';
        }


        return $isValid;
    }

    /*
           Walidacja danych a następnie przekazanie danych do klasy Vacation gdzie dojdzie do dodania urlopów które będa
     musiały być zaakceptowane do bazy danych */
    public function requestVacation(&$errors)
    {
        if ($this->validateVacation($errors) == true) {

            $this->request($this->usersID, $this->fullname, $this->email, $this->stEvDate, $this->endEvDate,
                $this->description, $this->status);
            header("location: index.php");
        }

    }


    /*
       Walidacja danych a następnie przekazanie danych do klasy Vacation gdzie dojdzie do dodania urlopów już
    zaakceptowanych przez kierownika/admina do bazy danych */
    public function acceptVacation(&$errors)
    {
        if ($this->validateVacation($errors) == true) {

            $this->addVacation($this->usersID, $this->fullname, $this->email, $this->stEvDate, $this->endEvDate,
                $this->description, $this->status);
            header("location: index.php");
        }
    }

}