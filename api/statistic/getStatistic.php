<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Statistic.php';

    // Displaying errors
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    // Database instance with connection
    $database = new Database();
    $db = $database->connect();

    // // Statistic object instance
    $statistic = new Statistic($db);

    $result = $statistic->getStatistic();

    // Get row count
    $num = $result->rowCount();

    // Check if anu sstatistic
    if ($num > 0) {
        $statistic_arr = array();
        $statistic_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $statistic_data = array(
                'id' => $id,
                'page_url' => $page_url,
                'user_ip_address' => $user_ip_address,
                'created_at' => $created_at
            );

            // Push data to statistic array
            array_push($statistic_arr['data'], $statistic_data);
        }

        // JSON output
        echo json_encode($statistic_arr);

    } else {
        // If there no statistic
        echo json_encode(
            array(
                'message' => 'No statistic found!'
            )
        );
    }
