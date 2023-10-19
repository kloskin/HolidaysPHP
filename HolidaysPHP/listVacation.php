<!--Strona odpowiedzialna za wyswietlenie listy urlopów do zatwierdzenia przez kierownika/admina-->

<?php
session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();
bossChecker();


$user = [
    'id' => '',
    'name' => '',
    'username' => '',
    'email' => '',
    'pwd' => '',
    'pwdrepeat' => ''
];

$errors = [
    'name' => "",
    'username' => '',
    'email' => "",
    'pwd' => "",
    'pwdrepeat' => ""

];


echo '<div class="formularze">';
echo '<form action="acceptVacation.php" method="POST" >';


//Wypisuje wszystkie urlopy do zatwierdzenia
$query1 = "SELECT * FROM request_vacation";
$stmt = $connection->prepare($query1);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<script>document.title = "Zatwierdzanie urlopów";</script>
<div class="container listBg">

    <table class="table table-striped">
        <thead class="text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Osoba</th>
            <th scope="col">Email</th>
            <th scope="col">Początek urlopu</th>
            <th scope="col">Koniec urlopu</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="text-center">


        <!--        Wypisuje dane-->
        <?php
        $i = 1;
        foreach ($result as $row) {

            if ($row['request_status'] == "waiting") {
                ?>

                <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td class="align-middle"><?php echo $row['request_users_fullname'] ?></td>
                    <td class="align-middle"><?php echo $row['request_users_email'] ?></td>
                    <td class="align-middle"><?php echo $row['request_start_event_date'] ?></td>
                    <td class="align-middle"><?php echo $row['request_end_event_date'] ?></td>
                    <td class="align-middle">
                        <button type="submit" class="btn btn-outline-primary" name="submit1"
                                value="<?php echo $row['request_id']
                                ?>">Sprawdź
                        </button>
                    </td>
                    </td>
                </tr>

                <?php

            }
            ?>

            <?php
        }
        ?>
        </tbody>
    </table>

</div>

</form>
</div>
<?php


include "partials/footer.php";


?>