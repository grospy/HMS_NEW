<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "openemr";

$conn = new mysqli($servername, $username, $password, $dbname); // Create connection
if ($conn->connect_error) {     // Check connection
    die("Connection failed: " . $conn->connect_error);
} 

$linkToVideo = mysqli_real_escape_string($conn, $_POST['linkToVideo']);

if (strlen($times) > 200000) {  $times = "";    }

$sql = "UPDATE patient_data SET linkToVideoMessage = '$linkToVideo' WHERE `fname` = 'Imran' AND `lname` = 'Baghirov'";

if ($conn->query($sql) === TRUE) {
    echo "Page saved!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>