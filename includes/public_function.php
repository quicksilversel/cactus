<?php 

// pagination function : returns data for pagination
function get_paging_info($curr_page)
{
	// get global variables
	global $number_of_result, $number_of_page, $results_per_page;

	$data = array();
	// starting index
	$data['starting_index'] = ($curr_page * $results_per_page) - $results_per_page; 
	$data['number_of_page'] = $number_of_page; 
	$data['curr_page'] = $curr_page;        

	return $data;
}

?>