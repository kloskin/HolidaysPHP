<!--Strona pokazująca status urlopów zalogowanego użytkownika-->

<?php
session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();

$uid = $_SESSION['userid'];

?>
<div class="formularze">
    <form action="acceptVacation.php" method="POST">
        <?php
        //        Wypisanie wszystkich próśb o urlop
        $query1 = "SELECT * FROM request_vacation WHERE request_users_id=?";
        $stmt = $connection->prepare($query1);
        $stmt->execute(array($uid));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <script>document.title = "Status urlopu";</script>
        <script src="https://kit.fontawesome.com/48e0418fca.js" crossorigin="anonymous"></script>
        <div class="container listBg">

            <table class="table table-striped">
                <thead class="text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Email</th>
                    <th scope="col">Początek urlopu</th>
                    <th scope="col">Koniec urlopu</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody class="text-center">


                <?php
                $i = 1;
                foreach ($result as $row) {

                    ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td class="align-middle"><?php echo $row['request_users_fullname'] ?></td>
                        <td class="align-middle"><?php echo $row['request_users_email'] ?></td>
                        <td class="align-middle"><?php echo $row['request_start_event_date'] ?></td>
                        <td class="align-middle"><?php echo $row['request_end_event_date'] ?></td>
                        <td class="align-middle ">
                            <?php
                            if ($row['request_status'] == "waiting" || $row['request_status'] == "") { ?>
                                <i class="fa-regular fa-hourglass-half" style="color: #ffc107;"></i>
                            <?php } elseif ($row['request_status'] == "reject") {
                                ?>
                                <i class="fa-solid fa-xmark" style="color: #dc3545;"></i>
                                <?php
                            } else {
                                ?>
                                <i class="fa-solid fa-check" style="color: #28a745;"></i>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
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