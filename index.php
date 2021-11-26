<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php $plant_complete = countPlant(); ?>
<?php $plant_count = countAllPlant(); ?>
<?php $plants = getPlants(); ?>

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
        <!-- content  -->
        <div class="page-content">
          	<div class="container">
			  	<div class="header">
					<h1 class="fs-3">Dashboard</h1>
					<p></p>
				</div>
				<div class="row mt-4">
					<!-- first column -->
					<div class="col-lg-8">
						<!-- progress bars -->
						<div class="row">
							<div class="col-lg-6">
								<div class="p-3 progress-wrapper">
									<i class="fas fa-2x fa-tint p-2 text-primary"></i>
									<h5 class="mt-2 p-1">Watered Plants</h5>
									<div id="bar">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="<?php echo floor(( 5/7 ) * 100) ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="mt-1 mb-1" style="float:right;"><?php echo floor(( 5/7 ) * 100) ?>%</p>
									<p class="text-center mt-4"><?php echo 5 /* $plant_complete */ ?> out of <?php echo 7 /* $plant_count */ ?> plants watered</p>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="p-3 progress-wrapper">
									<i class="fas fa-2x fa-exclamation-triangle p-2" style="color: #dc3545;"></i>
									<h5 class="mt-2 p-1">Urgent Watering Needed</h5>
									<div id="bar">
										<div class="progress-bar" style="background-color: #dc3545;" role="progressbar" aria-valuenow="<?php echo floor(( 1/7 ) * 100) ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="mt-1 mb-1" style="float:right;"><?php echo floor(( 1/7 ) * 100) ?>%</p>
									<p class="text-center mt-4">1 out of 7 plants in critical condition</p>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="p-3 progress-wrapper mt-4">
								<h3 class="fs-6 mb-3">Overview</h3>
									<canvas id="myChart"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!-- second column -->
					<div class="col-lg-4">
						<div class="p-3 progress-wrapper-long">
							<h5 class="mt-2 p-1">
								<i class="fas fa-history p-1 text-success"></i>
							Watering History
							</h5>
							<?php foreach ($plants as $plant): ?>
								<div class="message-box">
									<div class="message-content">
										<p class="message-name"><?php echo $plant['plantName'] ?></p>
										<p class="message-line time">Last Watered : <?php echo $plant['lastWatered'] ?></p>
									</div>
								</div>
							<?php endforeach ?>
							
						</div>
					</div>
				</div>
          	</div>	
		</div>
    </div>
</body>