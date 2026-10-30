<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (empty($name) || empty($email) || empty($phone)) {
die("All fields are required!");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
die("Invalid email format!");
}

if (!is_numeric($phone) || strlen($phone) != 10) {
die("Phone must be 10 digits!");
}


    $sql = "INSERT INTO entries (name, email, phone) VALUES ('$name','$email','$phone')";

    if ($conn->query($sql) === TRUE) {

    header("Location: view.php?success=1");
    exit();

} else {

    echo "Error: " . $sql . "<br>" . $conn->error;

}
    $conn->close();
}

?>
