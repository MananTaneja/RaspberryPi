<?php

    // Making the Connection
    $servername = "localhost";
    $username = "order_product";
    $password = "password";
    $dbName = "fusion";
    $conn = mysqli_connect($servername, $username, $password, $dbName);
    if($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // The SQL Command to be executed on the database
    $query = "SELECT * FROM top_odi_wicket_takers";
    // Storing the result in variable result 
    $result  = $conn->query($query);

    // Converting the data given for fusion chart - converted to an associative array 

    $jsonArray = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $jsonArrayItem = array();
            $jsonArrayItem['label'] = $row['player'];
            $jsonArrayItem['value'] = $row['wickets'];

            array_push($jsonArray, $jsonArrayItem);
        }
    }

    $conn->close();

    header('Content-type: application/json');
    echo json_encode($jsonArray);
?>