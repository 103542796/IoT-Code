<?php require_once("settings.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <style>
        p{
            text-align: center;
            font-size: large;
            font-size: 150%;
        }

        h1 {
            text-align: center;
            margin-bottom: 5%;
            color: blue;
        }
        
    </style>
    <title>Smart Sensor Dashboard</title>
    <script>
        // Function to update sensor data every 5 seconds
        function updateSensorData() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tempDiv").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "fetch_sensor_data.php", true);
            xhttp.send();
        }

        // Update sensor data every 5 seconds
        setInterval(updateSensorData, 5000);
    </script>
</head>
<body onload="updateSensorData()">
    <h1>Smart Sensor Dashboard</h1>

    <div id="tempDiv">
        <!-- Sensor data will be dynamically updated here -->
    </div>
</body>
</html>
