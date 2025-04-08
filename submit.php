<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$college = $data->college;
$email = $data->email;
$phone = $data->phone;
$team = $data->team;
$idea = $data->idea;

$conn = new mysqli("localhost", "root", "", "hackathon_db");

if ($conn->connect_error) {
    die(json_encode(["message" => "Database connection failed."]));
}

$sql = "INSERT INTO entries (name, college, email, phone, team, idea)
        VALUES ('$name', '$college', '$email', '$phone', '$team', '$idea')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Hackathon entry submitted successfully!"]);
} else {
    echo json_encode(["message" => "Error: " . $conn->error]);
}

$conn->close();
?>
