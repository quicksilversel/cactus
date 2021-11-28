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
                    <h1 class="fs-3">Plants</h1>
                    <p></p>
				</div>
                <!-- plants table -->
                <section class="table">
				<table class="text-center">
					<tbody>
						<tr>
                            <th style="width: 5%; border-top:none;">#</th>
                            <th style="width: 20%; border-top:none;">Plant</th>
                            <th style="width: 25%; border-top:none;">Optimal Temperature</th>
                            <th style="width: 25%; border-top:none;">Optimal Humidity</th>
                            <th style="width: 25%; border-top:none;">Native Habitat</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Cactus</td>
                            <td>7℃ - 30℃</td>
                            <td>40% - 60%</td>
                            <td>Desert</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Snake Plant</td>
                            <td>15℃ - 30℃</td>
                            <td>40% - 60%</td>
                            <td>Tropical</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Orchid</td>
                            <td>20℃ - 30℃</td>
                            <td>40% - 70%</td>
                            <td>Cosmopolitan</td>
                        </tr>
                    </tbody>
                </table>
                </section>
            </div>
		</div>
	</div>
</body>