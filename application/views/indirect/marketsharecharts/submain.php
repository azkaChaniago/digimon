<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("indirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("indirect/_parts/sidebar.php") ?>

	<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- <div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Marketshare per Kabupaten</h2></div>
					</div>
					<div class="body">
						<canvas id="kabupaten" width="500" height="500"></canvas>
					</div>
				</div>
			</div> -->
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Marketshare per Kecamatan</h2></div>
					</div>
					<div class="body">
						<canvas id="kecamatan" width="500" height="500"></canvas>
					</div>
				</div>
			</div>
		</div>		
	</div>
	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("indirect/_parts/modal.php") ?>

	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>

		var ctx = document.getElementById("kecamatan").getContext('2d');
		ctx.width = 500;
		ctx.height = 500;
		var data = [<?php foreach ($kecamatan as $kec){	echo "'$kec->total_market_share',"; }?>];
		var backgroundColor = [];
		var borderColor = [];
		var i = 0;
		while(i < data.length) {
			var randR = Math.floor((Math.random()* 130) + 100);
			var randG = Math.floor((Math.random()* 130) + 100);
			var randB = Math.floor((Math.random()* 130) + 100);
			var graphColor = "rgb("+ randR +","+ randG +","+ randB +")";
			backgroundColor.push(graphColor);
			var outlineColor = "rgb("+ (randR - 80) +","+ (randG - 80) +","+ (randB - 80) +")";
			borderColor.push(outlineColor);
			i++;
		}
        var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: [<?php foreach ($kecamatan as $kec)	{ echo "'$kec->kecamatan',"; } ?>],
				datasets: [{
					label: '# of Votes',
					data: [<?php foreach ($kecamatan as $kec) {	echo "'$kec->total_market_share',";	} ?>],
					backgroundColor: backgroundColor,
					borderColor: borderColor,
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					position: 'right'
				}
			}
		});
		
	</script>

</body>

</html>
