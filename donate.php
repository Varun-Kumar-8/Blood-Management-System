<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['amount'])) {
        $name = $_POST['name'];
        $amount = $_POST['amount'];

        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "apollo_hospital";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to insert the record
        $stmt = $conn->prepare("INSERT INTO donations (name, amount) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $amount); // 's' for string, 'i' for integer

        if ($stmt->execute()) {
            echo "<script>alert('You have filled the donation form successfully'); window.location.href = 'home.html';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Name and Amount fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
