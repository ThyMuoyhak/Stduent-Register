<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $note = $_POST['note'];

    // Insert data into the students table
    $sql = "INSERT INTO students (name, gender, dob, province, district, note) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $gender, $dob, $province, $district, $note);

    if ($stmt->execute()) {
        echo "<div class='bg-green-500 text-white p-3 rounded-lg'>Successfully submitted!</div>";
    } else {
        echo "<div class='bg-red-500 text-white p-3 rounded-lg'>Failed to submit.</div>";
    }
    $stmt->close();
}

$conn->close();
?>
