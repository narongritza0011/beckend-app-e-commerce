<?php
$user = $_SESSION['user_login'];
$sql = "SELECT * FROM tb_admin WHERE user = '$user'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);


//จำนวนออเดอร์สินค้าท้้งหมด
$sql_order = "SELECT COUNT(id_orders) as count_order  FROM orders WHERE status in (1,2)  ";
$query_order = mysqli_query($connection, $sql_order);
$result_order = mysqli_fetch_assoc($query_order);

//จำนวนสมาชิกทางร้านท้้งหมด
$sql_user = "SELECT COUNT(id_user) as count_user FROM user";
$query_user = mysqli_query($connection, $sql_user);
$result_user = mysqli_fetch_assoc($query_user);

//จำนวนออเดอร์deliveryท้้งหมด
$sql_order_delivery = "SELECT COUNT(id_orders) as count_order_delivery FROM orders_delivery WHERE status in (1,2)";
$query_order_delivery = mysqli_query($connection, $sql_order_delivery);
$result_order_delivery = mysqli_fetch_assoc($query_order_delivery);


//จำนวนรายได้ท้้งหมด
$sql_detail = "SELECT sum(price) as all_price  FROM order_details    ";
$query_detail = mysqli_query($connection, $sql_detail);
$result_detail = mysqli_fetch_assoc($query_detail);

//print_r(json_encode($result_detail));



//เรียกรายการสินค้าทั้งหมด
$sql_product_sale = "SELECT p.name,od.quantity,p.id_product
FROM product as p
INNER JOIN order_details as od ON p.id_product = od.id_product";
$query_sale_product = mysqli_query($connection, $sql_product_sale);
$label = array();
$data = array();
foreach ($query_sale_product as $key => $value) {
	$label[] = $value['name'];
	$data[] = $value['quantity'];
}
//print_r(json_encode($label, true))







?>


<h1 class="app-page-title">หน้าหลัก</h1>

<hr class="mb-4">
<div class="row g-4  settings-section">

	<div class="col-12 col-md-12">
		<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
			<div class="inner">
				<div class="app-card-body p-3 p-lg-4">
					<h3 class="mb-3">ยินดีต้อนรับ, <?= $result['user'] ?></h3>
					<div class="row gx-5 gy-3">
						<div class="col-12 col-lg-9">

							<div>ระบบจัดการสินค้าเเละร้านค้า</div>
						</div>
						<!--//col-->

						<!--//col-->
					</div>
					<!--//row-->
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<!--//app-card-body-->

			</div>
			<!--//inner-->
		</div>
		<!--//app-card-->
	</div>
	<!--//app-card-body-->

	<div class="row g-4 mb-4">
		<div class="col-6 col-lg-3">
			<div class="app-card app-card-stat shadow h-100">
				<div class="app-card-body p-3 p-lg-4">
					<h4 class="stats-type mb-1 ">คำสั่งซื้อลูกค้า</h4>
					<div class="stats-figure text-success"><?= $result_order['count_order'] ?></div>
					<div class="stats-meta">
						รายการ</div>
				</div>
				<!--//app-card-body-->
				<a class="app-card-link-mask" href="?page=order_user"></a>
			</div>
			<!--//app-card-->
		</div>
		<div class="col-6 col-lg-3">
			<div class="app-card app-card-stat shadow h-100">
				<div class="app-card-body p-3 p-lg-4">
					<h4 class="stats-type mb-1 ">คำสั่งซื้อ Delivery</h4>
					<div class="stats-figure text-success"><?= $result_order_delivery['count_order_delivery'] ?></div>
					<div class="stats-meta">
						รายการ</div>

				</div>
				<!--//app-card-body-->
				<a class="app-card-link-mask" href="?page=order_delivery_user"></a>
			</div>
			<!--//app-card-->
		</div>
		<!--//col-->

		<div class="col-6 col-lg-3">
			<div class="app-card app-card-stat shadow h-100">
				<div class="app-card-body p-3 p-lg-4">
					<h4 class="stats-type mb-1">รายได้ทั้งหมด</h4>
					<div class="stats-figure text-success"><?= $result_detail['all_price'] ?></div>
					<div class="stats-meta text-success">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
						</svg>
					</div>
				</div>
				<!--//app-card-body-->
				<a class="app-card-link-mask" href="#"></a>
			</div>
			<!--//app-card-->
		</div>
		<!--//col-->

		<!--//col-->
		<div class="col-6 col-lg-3">
			<div class="app-card app-card-stat shadow h-100">
				<div class="app-card-body p-3 p-lg-4">
					<h4 class="stats-type mb-1">สมาชิกทั้งหมด</h4>
					<div class="stats-figure text-success"><?= $result_user['count_user'] ?></div>
					<div class="stats-meta">รายการ</div>
				</div>
				<!--//app-card-body-->
				<a class="app-card-link-mask" href="?page=member_user"></a>
			</div>
			<!--//app-card-->
		</div>
		<!--//col-->
	</div>
	<!--//row-->
	<div class="app-card app-card-settings shadow-sm p-4">

		<div class="app-card-body">





			<div class="row g-4 mb-4">
				<div class="col-12 col-lg-6">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">เเสดงรายได้</h4>
								</div>

							</div>
							<!--//row-->
						</div>
						<!--//app-card-header-->
						<div class="app-card-body p-3 p-lg-4">
							<div class="mb-3 d-flex">
								<select id="select_dmy" class="form-select form-select-sm ms-auto d-inline-flex w-auto">
									<option value="1" <?php echo (empty($_GET['dmy']) or $_GET['dmy'] == 1) ? 'selected' : '' ?>>สัปดาห์นี้</option>
									<option value="2" <?php echo (!empty($_GET['dmy']) && $_GET['dmy'] == 2) ? 'selected' : '' ?>>วันนี้</option>
									<option value="3" <?php echo (!empty($_GET['dmy']) && $_GET['dmy'] == 3) ? 'selected' : '' ?>>เดือนนี้</option>
									<option value="4" <?php echo (!empty($_GET['dmy']) && $_GET['dmy'] == 4) ? 'selected' : '' ?>>ปีนี้</option>
								</select>
							</div>
							<div class="chart-container">
								<canvas id="canvas-linechart"></canvas>
							</div>
						</div>
						<!--//app-card-body-->
					</div>
					<!--//app-card-->
				</div>
				<!--//col-->
				<div class="col-12 col-lg-6">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">สินค้าขายดี</h4>
								</div>

							</div>
							<!--//row-->
						</div>
						<!--//app-card-header-->
						<!--
						<div class="app-card-body p-3 p-lg-4">
							<div class="mb-3 d-flex">
								<select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
									<option value="1" selected>สัปดาห์นี้</option>
									<option value="2">วันนี้</option>
									<option value="3">เดือนนี้</option>
									<option value="3">ปีนี้</option>
								</select>
							</div>-->
						<div class="chart-container">
							<canvas id="canvas-barchart"></canvas>
						</div>
					</div>

					<!--//app-card-body-->
				</div>
				<!--//app-card-->
			</div>
			<!--//col-->

		</div>
		<!--//row-->

	</div>
	<!--//app-card-->




</div>
</div>
<!--//row-->

<script>
	$('#select_dmy').on('change', function() {
		window.location.href = window.location.origin + '/backend-app-e-commerce/?dmy=' + $(this).val();
	})



	'use strict';

	/* Chart.js docs: https://www.chartjs.org/ */

	window.chartColors = {
		green: '#75c181',
		gray: '#a9b5c9',
		text: '#252930',
		border: '#e7e9ed'
	};

	/* Random number generator for demo purpose */
	var randomDataPoint = function() {
		return Math.round(Math.random() * 10000)
	};


	//Chart.js Line Chart Example 

	var lineChartConfig = {
		type: 'line',

		data: {
			labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],

			datasets: [{
				label: 'Current week',
				fill: false,
				backgroundColor: window.chartColors.green,
				borderColor: window.chartColors.green,
				data: [
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint()
				],
			}, {
				label: 'Previous week',
				borderDash: [3, 5],
				backgroundColor: window.chartColors.gray,
				borderColor: window.chartColors.gray,

				data: [
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint(),
					randomDataPoint()
				],
				fill: false,
			}]
		},
		options: {
			responsive: true,
			aspectRatio: 1.5,

			legend: {
				display: true,
				position: 'bottom',
				align: 'end',
			},

			title: {
				display: true,
				text: 'Line Chart ',

			},
			tooltips: {
				mode: 'index',
				intersect: false,
				titleMarginBottom: 10,
				bodySpacing: 10,
				xPadding: 16,
				yPadding: 16,
				borderColor: window.chartColors.border,
				borderWidth: 1,
				backgroundColor: '#fff',
				bodyFontColor: window.chartColors.text,
				titleFontColor: window.chartColors.text,

				callbacks: {
					//Ref: https://stackoverflow.com/questions/38800226/chart-js-add-commas-to-tooltip-and-y-axis
					label: function(tooltipItem, data) {
						if (parseInt(tooltipItem.value) >= 1000) {
							return "฿" + tooltipItem.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						} else {
							return '฿' + tooltipItem.value;
						}
					}
				},

			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.border,
					},
					scaleLabel: {
						display: false,

					}
				}],
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.border,
					},
					scaleLabel: {
						display: false,
					},
					ticks: {
						beginAtZero: true,
						userCallback: function(value, index, values) {
							return '฿' + value.toLocaleString(); //Ref: https://stackoverflow.com/questions/38800226/chart-js-add-commas-to-tooltip-and-y-axis
						}
					},
				}]
			}
		}
	};



	// Chart.js Bar Chart Example 

	var barChartConfig = {
		type: 'bar',

		data: {
			labels: <?php echo json_encode($label) ?>,
			datasets: [{
				label: 'รายการ',
				backgroundColor: window.chartColors.green,
				borderColor: window.chartColors.green,
				borderWidth: 1,
				maxBarThickness: 16,

				data: <?php echo json_encode($data) ?>
			}]
		},
		options: {
			responsive: true,
			aspectRatio: 1.5,
			legend: {
				position: 'bottom',
				align: 'end',
			},
			title: {
				display: true,
				text: 'Bar Chart '
			},
			tooltips: {
				mode: 'index',
				intersect: false,
				titleMarginBottom: 10,
				bodySpacing: 10,
				xPadding: 16,
				yPadding: 16,
				borderColor: window.chartColors.border,
				borderWidth: 1,
				backgroundColor: '#fff',
				bodyFontColor: window.chartColors.text,
				titleFontColor: window.chartColors.text,

			},
			scales: {
				xAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.border,
					},

				}],
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.borders,
					},


				}]
			}

		}
	}







	// Generate charts on load
	window.addEventListener('load', function() {

		var lineChart = document.getElementById('canvas-linechart').getContext('2d');
		window.myLine = new Chart(lineChart, lineChartConfig);

		var barChart = document.getElementById('canvas-barchart').getContext('2d');
		window.myBar = new Chart(barChart, barChartConfig);


	});
</script>