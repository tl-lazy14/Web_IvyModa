<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbanhang";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //Change character set to utf8
    mysqli_set_charset($conn, "utf8");
?>