<?php
session_start();
include "includes/loginCheck.inc.php";
include "classes/Dbcon.php";
sessionChecker();
?>

<?php

//Strona odpowiedzialna za Kalendarz głównie wzięta ze strony package FullCalendar


//Obsługa danych żeby wyświetlały się w kalendarzu
$sql = "SELECT CONCAT(accepted_users_fullname,' od ', DATE_FORMAT(accepted_start_event_date, '%d.%m'),' do ', DATE_FORMAT(accepted_end_event_date-1, '%d.%m'))  as title, accepted_start_event_date as start, accepted_end_event_date as end FROM accepted_vacation";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$myArray = array();
if (count($result) > 0) {
// output data of each row
    foreach ($result as $row) {
        $myArray[] = $row;
    }
} else {
    echo "0 results";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset='utf-8'/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src='fullcalendar-6.1.8/dist/index.global.js'></script>
    <script src='fullcalendar-6.1.8/packages/core/locales/pl.global.js'></script>
    <style>
        <?php include "css/style.css"; ?>
    </style>
    <title>Kalendarz</title>
    <link rel="icon" type="image/x-icon" href="calendar.png">
    <script>


        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,multiMonthYear',
                },

                locale: 'pl',
                navLinks: true,
                initialView: 'dayGridMonth',
                editable: true,
                selectable: true,
                dayMaxEvents: true,
                events: <?php echo json_encode($myArray); ?>
            });

            calendar.render();

        });

    </script>

    <style>
        /*Style dla kalendarza*/
        body {
            margin: 40px 0px;
            padding: 0;
            font-size: 14px;
        }


        .navbar {
            font-size: 16px;
            top: 0;
            z-index: 100;
            position: fixed;
            width: 100%;
        }

    </style>
</head>
<body>


<?php include "partials/menu.php" ?>
<div class="container">
    <div class="calendar-top">
        <div id='calendar'></div>
    </div>
</div>


</body>
</html>
