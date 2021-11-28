<?php

// function to update current humidity
function updateCurrentHumidity($plant_id, $humidity) {
	global $conn;
	$query = "UPDATE plant SET currentHumidity = $humidity WHERE id = $plant_id";
	if(mysqli_query($conn, $query)) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit(0);
	}
	else{
		header('location: index.php');
		echo mysqli_error($conn);
	}
    // call functions to update critical & watering status
    updateCriticalStatus();
    updateWateringStatus();

    // if the change in humidity is large enough, update last watered date
    $sql = "SELECT * FROM plant WHERE id=$plant_id";
	$plants = mysqli_query($conn, $sql);
    $final_plants = array();
	foreach ($plants as $plant] {
		array_push($final_plants, $plant);
	}
    $previous_humidity = $final_plants[0]['id'];

    $humidityChange = abs($previous_humidity - $humidity);
    if($humidityChange > 20){
        updateWateringDate($plant_id);
    }
}

// function to change critical status
function updateCriticalStatus() {
	global $conn;

    $sql = "SELECT * FROM plant";
	$plants = mysqli_query($conn, $sql);
	$number_of_result = mysqli_num_rows($result);  

    foreach ($plants as $plant) {

        // calculate difference between optimal humidity and current humidity
        $humidityDiff = abs($plant['currentHumidity'] - $plant['humidity']);
        
		if(($humidityDiff > 20 ) && ($plant['isCritical'] == 0)){
            $query = "UPDATE plant SET isCritical = 1 WHERE id = $plant['id']";
        }
        else if(($humidityDiff < 20 ) && ($plant['isCritical'] == 1)){
            $query = "UPDATE plant SET isCritical = 0 WHERE id = $plant['id']";
        }

        // execute query
        if(mysqli_query($conn, $query)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit(0);
        }
        else{
            header('location: index.php');
            echo mysqli_error($conn);
        }
	}
}

// function to change watering status
function updateWateringStatus() {
	global $conn;

    $sql = "SELECT * FROM plant";
	$plants = mysqli_query($conn, $sql);
	$number_of_result = mysqli_num_rows($result);  

    foreach ($plants as $plant) {

        // calculate difference between optimal humidity and current humidity
        $humidityDiff = abs($plant['currentHumidity'] - $plant['humidity']);
        
		if(($humidityDiff > 10 ) && ($plant['needsWatering'] == 0)){
            $query = "UPDATE plant SET needsWatering = 1 WHERE id = $plant['id']";
        }
        else if(($humidityDiff < 10 ) && ($plant['needsWatering'] == 1)){
            $query = "UPDATE plant SET needsWatering = 0 WHERE id = $plant['id']";
        }

        // execute query
        if(mysqli_query($conn, $query)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit(0);
        }
        else{
            header('location: index.php');
            echo mysqli_error($conn);
        }
	}
}

// function to update watering date
function updateWateringDate($plant_id) {
	global $conn;
	$query = "UPDATE plant SET lastWatered = now() WHERE id = $plant_id";
	if(mysqli_query($conn, $query)) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit(0);
	}
	else{
		header('location: index.php');
		echo mysqli_error($conn);
	}
}

?>
