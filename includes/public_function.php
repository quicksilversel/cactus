<?php 

// global variables

$plant_id = 0;
$plantName = '';
$date = '';

// returns all plants 
function getPlants() {
	// use global $conn object in function
	global $conn;
	$sql = "SELECT * FROM plant";
	$result = mysqli_query($conn, $sql);
	$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_plants = array();
	foreach ($plants as $plant) {
		array_push($final_plants, $plant);
	}
	return $final_plants;
}

// sort table by column
function sortTable($column, $sort_order) {
	global $conn, $asc_or_desc;
	$sql = 'SELECT * FROM plant ORDER BY ' . $column . ' ' . $sort_order;
	if(mysqli_query($conn, $sql)){
		$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
		$result = mysqli_query($conn, $sql);
		$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$final_plants = array();
		foreach ($plants as $plant) {
			array_push($final_plants, $plant);
		}
		return $final_plants;
	}
	else{
		echo mysqli_error($conn);
	}
}

/* actions */

// mark incomplete
if (isset($_GET['incomplete'])) {
	$plant_id = $_GET['incomplete'];
	unapplyplant($plant_id);
}
// mark complete
if (isset($_GET['complete'])) {
	$plant_id = $_GET['complete'];
	applyplant($plant_id);
}

// edit date
if (isset($_GET['edit-date'])) {
	$plant_id = $_GET['edit-date'];
	editDate($plant_id);
}

// update date
if (isset($_POST['update-date'])) {
	updateDate($_POST);
}

// apply
function applyPlant($plant_id) {
	global $conn, $plant_id;
	$query = "UPDATE plant SET plantStatus = 1 WHERE id = $plant_id";
	if(mysqli_query($conn, $query)) {
		header('location: status.php');
		exit(0);
	}
}

// unapply
function unapplyPlant($plant_id) {
	global $conn, $plant_id;
	$query = "UPDATE plant SET plantStatus = 0 WHERE id = $plant_id";
	if(mysqli_query($conn, $query)) {
		header('location: status.php');
		exit(0);
	}
}

// edit date 
function editDate($plant_id) {
	global $conn, $plant_id, $plantName, $date;
	$query = "SELECT * FROM plant WHERE id = $plant_id LIMIT 1";
        $result = mysqli_query($conn, $query);
        $plant = mysqli_fetch_assoc($result);

        // set form values on the form to be updated
        $plantName = $plant['plantName'];
        $date = $plant['plantDue'];
}

// update date 
function updateDate($request_values) {
	global $conn, $plant_id, $date;
	$plant_id = $request_values['id'];
	$date = $request_values['date'];
	$newDate = date("Y-m-d", strtotime($date));
	$query = "UPDATE plant SET plantDue = '$newDate' WHERE id = $plant_id";
	if(mysqli_query($conn, $query)) {
		header('location: status.php');
		exit(0);
	}
	else{
		echo mysqli_error($conn);
	}
}

// return number of watered plants 
function countPlant() {
	global $conn;
	$query = "SELECT COUNT(
		CASE WHEN needsWatering = 0 THEN 1 END
	) AS 'count' FROM plant";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];

	return $count;
}

// return number of all plants
function countAllPlant() {
	global $conn;
	$query = "SELECT COUNT(*) AS 'count' FROM plant";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];

	return $count;
}

?>