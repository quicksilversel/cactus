<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php 

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 

if (isset($_GET['column'])){
    $column = $_GET['column'];
    $plants = sortTable($column, $sort_order);
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
                <!-- status table -->
                <section class="table">
				<table class="text-center">
					<tbody>
						<tr>
							<th style="width: 5%; border-top:none;"><a href="status.php?column=id">#<i class="fas fa-sort px-1"></i></th>
							<th style="width: 20%; border-top:none;"><a href="status.php?column=plantName&order=<?php echo $asc_or_desc; ?>">Plant
                            <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
							<th style="width: 25%; border-top:none;"><a href="status.php?column=needsWatering&order=<?php echo $asc_or_desc; ?>">Watered
                            <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
                            <th style="width: 25%; border-top:none;"><a href="status.php?column=isCritical&order=<?php echo $asc_or_desc; ?>">Critical?
                            <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
							<th style="width: 25%; border-top:none;"><a href="status.php?column=lastWatered&order=<?php echo $asc_or_desc; ?>">Last Watered
                            <i class="fas fa-caret-<?php echo $up_or_down ?> px-1"></i></th>
						</tr>
                        <!-- get data -->
                        <?php foreach ($plants as $plant): ?>
                        <tr>
							<td></td>
							<td>
                                <?php echo $plant['plantName'] ?>
                            </td>
                            <!-- check watering status -->
							<td>
                            <?php if ($plant['needsWatering'] == true): ?>
                                <a class="fa fa-check btn text-success"
                                    href="status.php?incomplete=<?php echo $plant['id'] ?>">
                                </a>
                            <?php else: ?>
                                <a class="fa fa-times btn text-danger"
                                    href="status.php?complete=<?php echo $plant['id'] ?>">
                                </a>
                            <?php endif ?>
                            </td>
                            <!-- check critical status -->
                            <td>
                            <?php if ($plant['isCritical'] == true): ?>
                                <a class="fa fa-exclamation-triangle btn text-warning"
                                    href="status.php?incomplete=<?php echo $plant['id'] ?>">
                                </a>
                            <?php endif ?>
                            </td>
							<td>
                                <!-- edit button -->
                                <form method="post" action="<?php echo 'status.php'; ?>" >
                                    <!-- input field -->
                                    <p><?php echo date('Y-m-d',strtotime($plant['lastWatered'])) ?></p>
                                    <!-- update date -->
                                </form>
                            </td>
						</tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                </section>
            </div>
		</div>
	</div>
</body>