<?php
// global variables

$plant_id = 0;
$plantName = '';
$date = '';

// get all plants (default sorting order)
function getPlantsData() {
	// use global $conn object in function
	global $conn, $page, $number_of_page, $number_of_result, $results_per_page;
	
	// pagination
	$sql = "SELECT * FROM plantData";
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
	$sql = "SELECT * FROM plantData";
    $result = mysqli_query($conn, $sql);  
	$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_plants = array();
	foreach ($plants as $plant) {
		array_push($final_plants, $plant);
	}
	return $final_plants;
}

// sort table by column
function sortPlantData($column, $sort_order) {
	global $conn, $asc_or_desc, $page, $number_of_page, $number_of_result, $results_per_page;

	// pagination
	$sql = "SELECT * FROM plantData";
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
	$sql = 'SELECT * FROM plantData ORDER BY ' . $column . ' ' . $sort_order;
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
function searchPlantData(){
	// get search query
	$searchValue = $_GET['search'];

	global $conn, $page, $number_of_result, $number_of_page, $results_per_page;
	$sql = "SELECT * FROM plantData WHERE plantName LIKE '%{$searchValue}%'";
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

		$sql = "SELECT * FROM plantData WHERE plantName LIKE '%{$searchValue}%' LIMIT " . $page_first_result . ',' . $results_per_page;
		$result = mysqli_query($conn, $sql);  
		$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$final_plants = array();
		foreach ($plants as $plant) {
			array_push($final_plants, $plant);
		}
		return $final_plants;
	}		
}

// filter plants by selected option
function filterPlants($column, $target) {
	// get the number of plants first
	
	global $conn, $page, $number_of_result, $number_of_page, $results_per_page;
	$sql = "SELECT * FROM plantData WHERE ".$column." LIKE '{$target}'";
	$result = mysqli_query($conn, $sql);
	$number_of_result = mysqli_num_rows($result);  

	// limiting plant number per page
	$results_per_page = 60;  

	$number_of_page = ceil ($number_of_result / $results_per_page);  

	if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  

	$page_first_result = ($page-1) * $results_per_page; 

	$sql = "SELECT * FROM plantData WHERE ".$column." LIKE '{$target}' LIMIT " . $page_first_result . ',' . $results_per_page;
    $result = mysqli_query($conn, $sql);  
	$plants = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_plants = array();
	foreach ($plants as $plant) {
		array_push($final_plants, $plant);
	}
	return $final_plants;
}

?>