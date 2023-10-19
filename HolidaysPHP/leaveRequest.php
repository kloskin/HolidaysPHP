<!--Strona odpowiedzialna za Wnioski o urlop-->

<?php
session_start();
include 'partials/header.php';
include "partials/menu.php";
include "includes/loginCheck.inc.php";
//sprawdzenie sesji
sessionChecker();

//Obsługa errorów przy wypełnianiu formularzy
$user = [
    'dateStart' => '',
    'dateEnd' => '',
    'description' => ''
];

$errors = [
    'dateEnd' => ''
];

//Obsługa formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uid = $_SESSION['userid'];
    $email = $_SESSION['email'];
    $stEvDate = $_POST['dateStart'];
    $endEvDate = $_POST['dateEnd'];
    $description = htmlspecialchars($_POST['description']);;
    $status = "waiting";
    $fullname = $_SESSION['fullname'];

    include "classes/Dbcon.php";
    include "classes/Vacation.php";
    include "classes/Vacation_contr.php";


    $vacation = new VacationContr($uid, $fullname, $email, $stEvDate, $endEvDate, $description, $status);


//   Walidacja danych wpisanych przez użytkownika, a potem dodanie jej do bazy danych
    $vacation->requestVacation($errors);


    $user = [
        'dateStart' => $stEvDate,
        'dateEnd' => $endEvDate,
        'description' => $description
    ];


}


?>
<script>document.title = "Wniosek o urlop";</script>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-body p-4 p-sm-5">
                    <h3 class="card-title text-center mb-5 fw-light fs-10">Wniosek o urlop</h3>
                    <form method="POST" enctype="multipart/form-data" action="">
                        <div class="row">
                            <div class="form-group text-center col-6" id="hidden_date"><label
                                    for="date">Od kiedy</label><input type="date" name="dateStart" id="dateIDmin"
                                                                      class="form-control text-center" value="<?php
                                echo $user['dateStart'] ?>" required>
                            </div>


                            <div class="form-group text-center col-6" id="hidden_date"><label for="date">
                                    Do kiedy
                                </label><input type="date" name="dateEnd" id="dateIDmax"
                                               class="form-control text-center <?php echo
                                               $errors['dateEnd'] ? 'is-invalid' : '' ?>"
                                               value="<?php echo $user['dateEnd'] ?>" required>
                                <div class="invalid-feedback"><?php echo $errors['dateEnd'] ?></div>
                            </div>
                        </div>
                        <!--Ograniczenia podczas wybierania daty-->
                        <script>dateIDmin.min = new Date().toLocaleDateString('fr-ca')</script>
                        <script>dateIDmax.min = new Date().toLocaleDateString('fr-ca')</script>

                        <div class="form-group py-5">
                            <label for="text-area ">Napisz powód urlopu</label>
                            <textarea class="form-control" id="text-area" rows="3" name="description"><?php echo
                                $user['description'] ?></textarea>
                        </div>

                        <div class="d-grid mb-2">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="submit">
                                Złóż wniosek
                            </button>
                        </div>
                        <a class="d-block text-center mt-2 small" href="index.php"> ⮜ Strona główna</a>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include 'partials/footer.php';
?>
