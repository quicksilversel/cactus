<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php require_once("includes/status_function.php");?>

<?php 
    // Get the sort order for the column, ascending or descending, default is ascending.
    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 

    if (isset($_GET['column'])){
        $column = $_GET['column'];
        $plants = sortTable($column, $sort_order);
    }
    else if (isset($_GET['search'])){
        $plants = searchPlant();
    }
    else{
        $plants = sortTable('id', 'ASC'); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php");?>
</head>
<body>
	<div class="page-wrapper toggled">
		<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
			<i class="fas fa-bars"></i>
		</a>
		<!-- sidenav -->
		<?php include("includes/sidebar.php");?>
		<!-- content -->
		<div class="page-content">
			<div class="container">
				<div class="header">
                    <h1 class="fs-3">Plants</h1>
                    <p></p>
				</div>
                <!-- search bar -->
                <form method="get" action="plantData.php">
                    <input type="text" name="search" required placeholder="Search Plant" style="height:30px;"/>
                    <input type="submit" value="Search" style="cursor: pointer; height:30px;"/>
                </form>
                <!-- if result is empty -->
                <?php if($plants == false): ?> 
                    <p class="mt-5 text-center">No Results</p>
                <?php else: ?>
                    <!-- status table -->
                    <section class="table mt-3">
                    <table class="text-center">
                        <tbody>
                            <tr>
                                <th style="width: 5%; border-top:none;"><a href="status.php?column=id">#<i class="fas fa-sort px-1"></i></th>
                                <th style="width: 20%; border-top:none;"><a href="status.php?column=plantName&order=<?php echo $asc_or_desc; ?>">Plant
                                <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                                <th style="width: 15%; border-top:none;"><a href="status.php?column=humidity&order=<?php echo $asc_or_desc; ?>">Optimal Humidity
                                <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                                <th style="width: 15%; border-top:none;"><a href="status.php?column=currentHumidity&order=<?php echo $asc_or_desc; ?>">Current Humidity
                                <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                                <th style="width: 12%; border-top:none;"><a href="status.php?column=needsWatering&order=<?php echo $asc_or_desc; ?>">Status
                                <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                                <th style="width: 13%; border-top:none;"><a href="status.php?column=isCritical&order=<?php echo $asc_or_desc; ?>">Warnings
                                <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                                <th style="width: 20%; border-top:none;"><a href="status.php?column=lastWatered&order=<?php echo $asc_or_desc; ?>">Last Watered
                                <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                            </tr>
                            <!-- get data -->
                            <?php foreach ($plants as $plant): ?>
                            <tr>
                                <td></td>
                                <td>
                                    <?php echo $plant['plantName'] ?>
                                </td>
                                <td>
                                    <?php echo $plant['humidity'].'%' ?>
                                </td>
                                <td>
                                    <?php echo $plant['currentHumidity'].'%' ?>
                                </td>
                                <!-- check watering status -->
                                <td>
                                <?php if ($plant['needsWatering'] == true): ?>
                                    <a class="fa fa-check btn text-success"
                                        href="#">
                                    </a>
                                <?php else: ?>
                                    <a class="fa fa-times btn text-danger"
                                        href="#">
                                    </a>
                                <?php endif ?>
                                </td>
                                <!-- check critical status -->
                                <td>
                                <?php if ($plant['isCritical'] == true): ?>
                                    <a class="fa fa-exclamation-triangle btn text-warning"
                                        href="#">
                                    </a>
                                <?php endif ?>
                                </td>
                                <td>
                                    <p><?php echo date('Y-m-d',strtotime($plant['lastWatered'])) ?></p>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </section>
                <?php endif ?>
                <!-- pagination -->
                <div class="page-nav text-center">  
                    <?php 
                        // digg style pagination 
                        if(isset($_GET['page'])){
                            $paging_info = get_paging_info($_GET['page']);
                        }
                        else{
                            $paging_info = get_paging_info(1);
                        }

                        $max = 5; // maximum number of pages to show

                        if($paging_info['curr_page'] < $max)
                            $sp = 1;
                        elseif($paging_info['curr_page'] >= ($paging_info['number_of_page'] - floor($max / 2)) )
                            $sp = $paging_info['number_of_page'] - $max + 1;
                        elseif($paging_info['curr_page'] >= $max)
                            $sp = $paging_info['curr_page']  - floor($max/2);

                        // show first index if current page > 1
                        if(isset($_GET['page']) && $_GET['page'] > 1){
                            if (isset($_GET['search'])){
                                echo '<a href = "status.php?search=' . $_GET['search'] . '">First</a>';  
                            }
                            else if(isset($_GET['habitat'])){
                                echo '<a href = "status.php?habitat=' . $_GET['habitat'] . '">First</a>';  
                            }
                            else{
                                echo '<a href = "status.php"> First </a>';   
                            }  
                        }
                        // if there are not enough pages to divide
                        if($number_of_page < $max){
                            for($page = 1; $page <= $number_of_page; $page++)
                            {
                                if (isset($_GET['search'])){
                                    echo '<a href = "status.php?search=' . $_GET['search'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else if(isset($_GET['habitat'])){
                                    echo '<a href = "status.php?habitat=' . $_GET['habitat'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else{
                                    echo '<a href = "status.php?page=' . $page . '">' . $page . ' </a>';  
                                }  
                            } 
                        }
                        else{
                            // divider ..
                            if($paging_info['curr_page'] >= $max){
                                echo '  ...  ';
                            }
                            for($page = $sp; $page <= ($sp + $max -1); $page++)
                            {
                                if (isset($_GET['search'])){
                                    echo '<a href = "status.php?search=' . $_GET['search'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else if(isset($_GET['habitat'])){
                                    echo '<a href = "status.php?habitat=' . $_GET['habitat'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else{
                                    echo '<a href = "status.php?page=' . $page . '">' . $page . ' </a>';  
                                }  
                            }
                            // divider ".."
                            if($number_of_page > $max && $paging_info['curr_page'] < ($paging_info['number_of_page'] - floor($max / 2))) {
                                echo '  ...  ';
                            } 
                        }                                
                        // show last index
                        if($number_of_page > $max && isset($_GET['page']) && $_GET['page'] < $max - 2){
                            if (isset($_GET['search'])){
                                echo '<a href = "status.php?search=' . $_GET['search'] . '&page=' . $number_of_page . '">' . $number_of_page. '</a>';    
                            }
                            else if(isset($_GET['habitat'])){
                                echo '<a href = "status.php?habitat=' . $_GET['habitat'] . '&page=' . $number_of_page . '">' . $number_of_page. '</a>';  
                            }
                            else{
                                echo '<a href = "status.php?page=' . $number_of_page . '">' . $number_of_page. '</a>';  
                            }  
                        }
                    ?>
                </div>
            </div>
		</div>
	</div>
</body>