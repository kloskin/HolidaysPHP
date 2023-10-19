<!--Plik w który służy do akceptacji już wybranego wcześniej urlopu
Wybór pomiędzy zaakceptowaniem a odrzuceniem-->

<?php ob_start(); ?>
<?php
session_start();

include 'partials/header.php';
include "partials/menu.php";
require_once 'classes/Dbcon.php';
include "includes/loginCheck.inc.php";
sessionChecker();


//Obsługa errorów przy wypełnianiu formularzy
$errors = [
    'name' => "",
    'username' => '',
    'email' => "",
    'pwd' => "",
    'pwdrepeat' => ""

];

//Obsługa jeśli kierownik/admin zaakceptował urlop
if (isset($_POST['accept'])) {
    buttonChecker($_POST['accept'], 'listVacation.php');
    $request_id = $_POST['requestID'];
    $uid = $_POST['uid'];
    $email = $_POST['email'];
    $stEvDate = $_POST['dateStart'];
    $endEvDate = $_POST['dateEnd'];
    $fullname = $_POST['fullname'];
    $description = htmlspecialchars($_POST['description']);;
    $status = 'accept';

    include "classes/Vacation.php";
    include "classes/Vacation_contr.php";

//Nowy obiekt urlopu
    $vacation = new VacationContr($uid, $fullname, $email, $stEvDate, $endEvDate, $description, $status);


//Zaakceptowanie urlopu i wrzucenie go do bazy danych
    $vacation->acceptVacation($errors);


    if ($vacation) {
        $query2 = "UPDATE request_vacation SET request_status=? WHERE request_id=?";
        $stmt = $connection->prepare($query2);
        $stmt->execute(array($status, $request_id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    header("location: listVacation.php");

//Obsługa jeśli kierownik/admin odrzucił urlop
} elseif (isset($_POST['reject'])) {
    buttonChecker($_POST['reject'], 'listVacation.php');
    $request_id = $_POST['requestID'];


    $query2 = "UPDATE request_vacation SET request_status='reject' WHERE request_id=?";
    $stmt = $connection->prepare($query2);
    $stmt->execute(array($request_id));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header("location: listVacation.php");


//Wyświetla Formularz w którym można wybrać czy sie akceptuje czy odrzuca urlop
} else {
    buttonChecker($_POST['submit1'], 'listVacation.php');
    $request_id = $_POST['submit1'];


    $query = "SELECT * FROM request_vacation WHERE request_id='$request_id'";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($result as $row) {
        echo '<input type="hidden" name="uid" value="' . $request_id . '" />';
        $user = [
            'request_id' => $request_id,
            'users_id' => $row['request_users_id'],
            'fullname' => $row['request_users_fullname'],
            'email' => $row['request_users_email'],
            'dateStart' => $row['request_start_event_date'],
            'dateEnd' => $row['request_end_event_date'],
            'description' => $row['request_description']
        ];
    }
}


?>

<div class="container">
    <div class="row">
        <div class="card shadow rounded-3 overflow-hidden">
            <div class="card-body">
                <h3 class="card-title text-center py-3 pb-5 fw-light fs-10">
                    Zatwierdzanie urlopu: <b><?php echo $user['fullname'] ?></b>
                </h3>
                <div class=" p-3 rounded border border-black vacationBg">
                    <div class="container">
                        <div class="row text-center align-items-center ">
                            <div class="col-6 borderRight">
                                <h5 class="card-title text-center ">Powód urlopu</h5>
                                <p class="card-text text-center">
                                    <?php echo $user['description']; ?>
                                </p>
                            </div>
                            <div class="col-6 ">
                                <div class="container">
                                    <div class="row align-center">
                                        <div class="col-6">
                                            <h4> Początek:</h4>
                                            <h5><?php echo $user['dateStart'] ?></h5>
                                        </div>
                                        <div class="col-6">
                                            <h4>Koniec:</h4>
                                            <h5><?php echo $user['dateEnd'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <form action="" method="post">

                    <input type="hidden" name="requestID" value="<?php echo $request_id ?>">
                    <input type="hidden" name="uid" value="<?php echo $user['users_id'] ?>">
                    <input type="hidden" name="email" value="<?php echo $user['email'] ?>">
                    <input type="hidden" name="dateStart" value="<?php echo $user['dateStart'] ?>">
                    <input type="hidden" name="dateEnd" value="<?php echo $user['dateEnd'] ?>">
                    <input type="hidden" name="fullname" value="<?php echo $user['fullname'] ?>">
                    <input type="hidden" name="description" value="<?php echo $user['description'] ?>">
                    <section class="vacationForm">
                        <div class="container mt-4 mb-4">
                            <div class="row text-center">
                                <div class="col-12 col-md-6">

                                    <input type="submit" name="accept" value="Zatwierdź urlop"
                                           class="btn btn-success btn-lg  btn-login fw-bold text-uppercase">

                                </div>
                                <div class="col-12 p-5 p-md-0 col-md-6">

                                    <input type="submit" name="reject" value="Odrzuć urlop"
                                           class="btn btn-danger btn-lg  btn-login fw-bold text-uppercase">

                                </div>
                            </div>
                        </div>
                    </section>


                </form>
                <a class="d-block text-center mt-2 small" href="listVacation.php"> ⮜ Cofnij</a>
            </div>
        </div>
    </div>
</div>


<?php
include 'partials/footer.php';
?>
