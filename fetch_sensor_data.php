<?php require_once("settings.php"); ?>

<?php 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest temperature data
$query_temp = "SELECT Celcius, Fahrenheit FROM temperature ORDER BY temp_id DESC LIMIT 1";
$result_temp = $conn->query($query_temp);
$row_temp = $result_temp->fetch_assoc();

// Fetch latest humidity data
$query_humid = "SELECT degree FROM humidity ORDER BY humid_id DESC LIMIT 1";
$result_humid = $conn->query($query_humid);
$row_humid = $result_humid->fetch_assoc();

// Fetch latest light data
$query_light = "SELECT lumen FROM light ORDER BY light_id DESC LIMIT 1";
$result_light = $conn->query($query_light);
$row_light = $result_light->fetch_assoc();

// Fetch Max temp data
$query_max_temp = "SELECT MAX(Celcius) AS max_temp FROM temperature LIMIT 1";
$result_max_temp = $conn->query($query_max_temp);
$row_max_temp = $result_max_temp->fetch_assoc();

// Fetch Min temp data
$query_min_temp = "SELECT MIN(Celcius) AS min_temp FROM temperature LIMIT 1";
$result_min_temp = $conn->query($query_min_temp);
$row_min_temp = $result_min_temp->fetch_assoc();

// Fetch Average temperature data
$query_temp_avg = "SELECT AVG(Celcius) AS avg_temp FROM temperature LIMIT 1";
$result_temp_avg = $conn->query($query_temp_avg);
$row_temp_avg = $result_temp_avg->fetch_assoc();

// Fetch Average humidity data
$query_humid_avg = "SELECT AVG(degree) AS avg_humid FROM humidity LIMIT 1";
$result_humid_avg = $conn->query($query_humid_avg);
$row_humid_avg = $result_humid_avg->fetch_assoc();

// Close database connection
$conn->close();

// Output sensor data as HTML
echo "<p>Temperature in Celcius: " . $row_temp["Celcius"] . "</p>";
echo "<p>Temperature in Fahrenheit: " . $row_temp["Fahrenheit"] . "</p>";
echo "<p>Humidity: " . $row_humid["degree"] . "</p>";
echo "<p>Lumen: " . $row_light["lumen"] . "</p>";
echo "<p>Highest Temperature: " . $row_max_temp["max_temp"] . "</p>";
echo "<p>Lowest Temperature: " . $row_min_temp["min_temp"] . "</p>";
echo "<p>Average Temperature: " . $row_temp_avg["avg_temp"] . "</p>";
echo "<p>Average Humidity: " . $row_humid_avg["avg_humid"] . "</p>";

?>
