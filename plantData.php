<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php require_once("includes/plantData_function.php");?>

<?php
    if (isset($_GET['column'])){
        $column = $_GET['column'];
        $plants = sortPlantData($column, $sort_order);
    }
    else if (isset($_GET['search'])){
        $plants = searchPlantData();
    }
    else if (isset($_GET['habitat'])){
        $plants = filterPlants('habitat', $_GET['habitat']);
    }
    else{
        $plants = sortPlantData('id', 'ASC'); 
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
                <div class="itemFilters" style="display: flex;">
                    <!-- search bar -->
                    <form method="get" action="plantData.php">
                        <input type="text" name="search" required placeholder="Search Plant" style="height:30px;"/>
                        <input type="submit" value="Search" style="cursor: pointer; height:30px;"/>
                    </form>
                    <!-- dropdown menu for habitat -->
                    <form method="get" action="plantData.php" class="ml-2">
                        <select name="habitat" onchange="this.form.submit()" style="height:30px;">
                            <option value="" selected disabled>
                                <?php 
                                    if (isset($_GET['habitat'])) { 
                                        echo $_GET['habitat']; 
                                    }
                                    else { 
                                        echo 'habitat'; 
                                    }
                                ?>
                            </option>
                            <option value="tropical">tropical</option>
                            <option value="desert">desert</option>
                            <option value="cosmopolitan">cosmopolitan</option>
                        </select>
                    </form>
                </div>
                <!-- if result is empty -->
                <?php if($plants == false): ?> 
                    <p class="mt-5 text-center">No Results</p>
                <?php else: ?>
                    <!-- plants table -->
                    <section class="table mt-3">
                    <table class="text-center">
                        <tbody>
                            <tr>
                                <th style="width: 5%; border-top:none;">#</th>
                                <th style="width: 20%; border-top:none;">Plant</th>
                                <th style="width: 25%; border-top:none;">Optimal Temperature</th>
                                <th style="width: 25%; border-top:none;">Optimal Humidity</th>
                                <th style="width: 25%; border-top:none;">Native Habitat</th>
                            </tr>
                            <?php foreach ($plants as $plant): ?>
                            <tr>
                                <td></td>
                                <td>
                                    <?php echo $plant['plantName'] ?>
                                </td>
                                <td>
                                    <?php echo $plant['minTemp'].'℃ - ' ?>
                                    <?php echo $plant['maxTemp'].'℃'?>
                                </td>
                                <td>
                                    <?php echo $plant['minHumidity'].'% - ' ?>
                                    <?php echo $plant['maxHumidity'].'%'?>
                                </td>
                                <td>
                                    <p><?php echo $plant['habitat'] ?></p>
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
                                echo '<a href = "plantData.php?search=' . $_GET['search'] . '">First</a>';  
                            }
                            else if(isset($_GET['habitat'])){
                                echo '<a href = "plantData.php?habitat=' . $_GET['habitat'] . '">First</a>';  
                            }
                            else{
                                echo '<a href = "plantData.php"> First </a>';   
                            }  
                        }
                        // if there are not enough pages to divide
                        if($number_of_page < $max){
                            for($page = 1; $page <= $number_of_page; $page++)
                            {
                                if (isset($_GET['search'])){
                                    echo '<a href = "plantData.php?search=' . $_GET['search'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else if(isset($_GET['habitat'])){
                                    echo '<a href = "plantData.php?habitat=' . $_GET['habitat'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else{
                                    echo '<a href = "plantData.php?page=' . $page . '">' . $page . ' </a>';  
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
                                    echo '<a href = "plantData.php?search=' . $_GET['search'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else if(isset($_GET['habitat'])){
                                    echo '<a href = "plantData.php?habitat=' . $_GET['habitat'] . '&page=' . $page . '">' . $page . ' </a>';  
                                }
                                else{
                                    echo '<a href = "plantData.php?page=' . $page . '">' . $page . ' </a>';  
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
                                echo '<a href = "plantData.php?search=' . $_GET['search'] . '&page=' . $number_of_page . '">' . $number_of_page. '</a>';    
                            }
                            else if(isset($_GET['habitat'])){
                                echo '<a href = "plantData.php?habitat=' . $_GET['habitat'] . '&page=' . $number_of_page . '">' . $number_of_page. '</a>';  
                            }
                            else{
                                echo '<a href = "plantData.php?page=' . $number_of_page . '">' . $number_of_page. '</a>';  
                            }  
                        }
                    ?>
                </div>
            </div>
		</div>
	</div>
</body>