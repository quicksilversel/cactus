<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>

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
                    <h1 class="fs-3">Monthly Analysis</h1>
                    <p></p>
				</div>
                <div class="mt-5">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
		</div>
	</div>
</body>