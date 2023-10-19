<?php
session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();
adminChecker();


//Pozwala na zapamiętanie wpisanych danych, i wypisanie danych do modyfikacji
$user = [
    'id' => '',
    'name' => '',
    'surename' => '',
    'email' => '',
    'pwd' => '',
    'pesel' => '',
    'pwdrepeat' => ''
];
//Obsługa błędów
$errors = [
    'name' => "",
    'username' => '',
    'email' => "",
    'pesel' => '',
    'pwd' => "",
    'pwdrepeat' => ""

];

?>


    <div class="formularze">
        <form action="updateUser.php" method="POST">

            
            <!--Select pozwalający wypisać użytkowników-->
            <?php
            $query1 = "SELECT * FROM users";
            $stmt = $connection->prepare($query1);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="container listBg">

                <table class="table table-striped">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imie</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                    </thead>
                    <tbody class="text-center">

                    <!--Wypisanie listy użytkowników-->
                    <?php
                    $i = 1;
                    foreach ($result as $row) {

                        ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td class="align-middle"><?php echo $row['users_name'] ?></td>
                            <td class="align-middle"><?php echo $row['users_surename'] ?></td>
                            <td class="align-middle"><?php echo $row['users_email'] ?></td>
                            <td class="align-middle">
                                <button type="submit" class="btn btn-outline-primary" name="modify"
                                        value="<?php echo $row['users_id']
                                        ?>">Modyfikuj
                                </button>
                                <button type="submit" class="btn btn-outline-info" name="passw"
                                        value="<?php echo $row['users_id']
                                        ?>">Reset Hasła
                                </button>

                            </td>
                            <td class="align-middle">
                                <button type="submit" class="btn btn-danger" name="delete"
                                        value="<?php echo $row['users_id']
                                        ?>">Usuń Konto
                                </button>
                            </td>
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