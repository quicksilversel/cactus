<?php $plant_complete = countPlant(); ?>
<?php $plant_count = countAllPlant(); ?>

<nav id="sidebar" class="sidebar-wrapper">
	<div class="sidebar-content">
		<!-- sidebar-header  -->
		<div class="sidebar-brand">
			<a href="index.php">navigation</a>
			<div id="close-sidebar">
				<i class="fas fa-times"></i>
			</div>
		</div>
		<div class="sidebar-header">
			<div class="user-info">
				<span class="user-name"><?php echo date("F j, Y")?></span>
				<span class="user-role"><?php echo date('l')?></span>
			</div>
		</div>
		<!-- sidebar-menu  -->
		<div class="sidebar-menu">
			<ul>
				<li class="header-menu">
					<span>My Plants</span>
				</li>
				<li>
					<a href="index.php" class="<?php if ($CURRENT_PAGE == "index") {?>current-page<?php }?>">
						<i class="fa fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="status.php" class="<?php if ($CURRENT_PAGE == "status") {?>current-page<?php }?>">
						<i class="fas fa-tasks"></i>
						<span>Plants Status</span>
						<!-- count number of incomplete plants -->
						<span class="badge badge-pill badge-danger">
							<?php echo ($plant_count - $plant_complete) ?>
						</span>
					</a>
				</li>
				<li>
					<a href="analysis.php" class="<?php if ($CURRENT_PAGE == "analysis") {?>current-page<?php } ?>">
						<i class="fas fa-chart-line"></i>
						<span>Analytics</span>
					</a>
				</li>
				<!-- Misc -->
				<li class="header-menu">
					<span>Misc</span>
				</li>
				<li>
					<a href="plantData.php" class="<?php if ($CURRENT_PAGE == "plantData") {?>current-page<?php } ?>">
						<i class="fas fa-seedling"></i>
						<span>Plants Database</span>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-calendar"></i>
						<span>Calendar</span>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-cog"></i>
						<span>Settings</span>
						<span class="badge badge-pill badge-warning">
							New
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>