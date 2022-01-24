<?php
// global variables

$plant_id = 0;
$plantName = '';
$date = '';

// get all plants (default sorting order)
function getPlants() {
	// use global $conn object in function
	global $conn, $page, $number_of_page, $number_of_result, $results_per_page;
	
	// pagination
	$sql = "SELECT * FROM plant";
	$result = mysqli_query($conn, $sql);
	$number_of_result = mysqli_num_rows($result);  

	$results_per_page = 30;  

	$number_of_page = ceil ($number_of_result / $results_per_page);  

	if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  

	$page_first_result = ($page-1) * $results_per_page; 

	// get plants
	$sql = "SELECT * FROM plant";
    $result = mysqli_query($conn, $sql);  
	$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_plants = array();
	foreach ($plants as $plant) {
		array_push($final_plants, $plant);
	}
	return $final_plants;
}

// return number of watered plants 
function countNeedsWatering() {
	global $conn;
	$query = "SELECT COUNT(
		CASE WHEN needsWatering = 0 THEN 1 END
	) AS 'count' FROM plant";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];

	return $count;
}

// return number of critical plants
function countCriticalPlant() {
	global $conn;
	$query = "SELECT COUNT(
		CASE WHEN isCritical = 1 THEN 1 END
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

// sort table by column
function sortTable($column, $sort_order) {
	global $conn, $asc_or_desc, $page, $number_of_page, $number_of_result, $results_per_page;

	// pagination
	$sql = "SELECT * FROM plant";
	$result = mysqli_query($conn, $sql);
	$number_of_result = mysqli_num_rows($result);  

	$results_per_page = 30;  
	$number_of_page = ceil ($number_of_result / $results_per_page);  

	if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  

	$page_first_result = ($page-1) * $results_per_page; 

	// get plants
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

// search for plant
function searchPlant(){
	// get search query
	$searchValue = $_GET['search'];

	global $conn, $page, $number_of_result, $number_of_page, $results_per_page;
	$sql = "SELECT * FROM plant WHERE plantName LIKE '%{$searchValue}%'";
	$result = mysqli_query($conn, $sql);

	// if no result
	if(mysqli_num_rows($result) == 0){
		return false;
	}
	else {
		// pagination
		$number_of_result = mysqli_num_rows($result);  
		$results_per_page = 30;  

		$number_of_page = ceil ($number_of_result / $results_per_page);  

		if (!isset ($_GET['page']) ) {  
			$page = 1;  
		} 
		else {  
			$page = $_GET['page'];  
		}  

		$page_first_result = ($page-1) * $results_per_page; 

		$sql = "SELECT * FROM plant WHERE plantName LIKE '%{$searchValue}%' LIMIT " . $page_first_result . ',' . $results_per_page;
		$result = mysqli_query($conn, $sql);  
		$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$final_plants = array();
		foreach ($plants as $plant) {
			array_push($final_plants, $plant);
		}
		return $final_plants;
	}		
}

/* actions : for manual data manipulation */

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

?>