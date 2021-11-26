$(document).ready(function() {

	// sidebar
	$(".sidebar-dropdown > a").click(function() {
		$(".sidebar-submenu").slideUp(200);
		if ($(this).parent().hasClass("active")) {
			$(".sidebar-dropdown").removeClass("active");
			$(this).parent().removeClass("active");
		} 
		else {
			$(".sidebar-dropdown").removeClass("active");
			$(this).next(".sidebar-submenu").slideDown(200);
			$(this).parent().addClass("active");
		}
	});
	
	$("#close-sidebar").click(function() {
		$(".page-wrapper").removeClass("toggled");
	});
	$("#show-sidebar").click(function() {
		$(".page-wrapper").addClass("toggled");
	});

	// progress bar 
	$('#bar .progress-bar').each(function() {
		$(this).css("width",
		function() {
			return $(this).attr("aria-valuenow") + "%";
		})
	});

	// bar chart 
	var myChart = new Chart(document.getElementById('myChart'), {
		type: 'bar',
		data: {
			labels: ["January", "February", "March", "April", 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			datasets: [{
				label: "Watering",
				yAxisID: 'Watering',
				data: [10, 9, 10, 8, 7, 7, 5, 4, 6, 8, 5, 0],
				backgroundColor: "#0d6efd",
				borderColor: 'transparent',
				borderWidth: 2.5,
				barPercentage: 0.4,
			}, {
				label: "Average Humidity",
				yAxisID: 'Humidity',
				startAngle: 2,
				data: [56, 54, 54, 54, 59, 65, 76, 73, 66, 61, 60, 57, 61], // based on average humidity in South Korea
				backgroundColor: "#5cb85c",
				borderColor: 'transparent',
				borderWidth: 2.5,
				barPercentage: 0.4,
			}]
		},
		options: {
			scales: {
				Watering: {
					gridLines: {},
					position: 'left',
					ticks: {
						min: 0,
						max: 15
					},
				},
				Humidity: {
					gridlines: {},
					position: 'right',
					labelString: 'Percentage',
					ticks: {
						min: 0,
						max: 100,
						callback: function (value) {
							return value + '%'; // convert it to percentage
						},
					},
				},
				xAxes: {
					gridLines: {
						display: false,
					}
				}
			}
		}
	})
});