<?php
// Настройки за свързване към базата данни
$servername = "localhost"; // Локалният хост
$username = "root"; // Твоето потребителско име за MySQL
$password = ""; // Твоето парола за MySQL
$dbname = "hotel_reservation"; // Името на базата данни

// Свързване към базата данни
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка за грешки при свързването
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Вземане на данни от формата
$hotel = $_POST['hotel'];
$room = $_POST['room'];
$date = $_POST['date'];

// Проверка за празни полета
if (empty($hotel) || empty($room) || empty($date)) {
    echo "Моля, попълнете всички полета!";
    exit;
}

// Подготвяне на заявка за вмъкване на данните
$sql = "INSERT INTO reservations (hotel, room, date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $hotel, $room, $date);

// Изпълнение на заявката
if ($stmt->execute()) {
    echo "Резервацията е успешно записана!";
} else {
    echo "Грешка: " . $stmt->error;
}

// Затваряне на връзката
$stmt->close();
$conn->close();
?>
