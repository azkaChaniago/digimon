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
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Marketshare per Kabupaten</h2></div>
					</div>
					<div class="body">
						<canvas id="kabupaten" width="500" height="500"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Marketshare Cluster Lampung</h2></div>
					</div>
					<div class="body">
						<canvas id="cluster" width="500" height="500"></canvas>
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
		var ctx = document.getElementById("kabupaten").getContext('2d');
		ctx.width = 500;
		ctx.height = 500;
        var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: [
					<?php foreach ($regular as $kab)
					{
						echo "'$kab->kabupaten',";
					} 
					?>
					// "BANDAR LAMPUNG", "LAMPUNG SELATAN", "LAMPUNG TIMUR", "PESAWARAN"
				],
				datasets: [{
					label: '# of Votes',
					data: [
						<?php foreach ($regular as $kab)
						{
							echo "'$kab->total_market_share',";
						} 
						?>
					],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false
			}
		});

		document.getElementById("kabupaten").onclick = function(evt){
            var activePoints = myChart.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = myChart.data.labels[firstPoint._index];
            // var value = kpi_col.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            window.location.href = "<?php echo site_url('indirect/marketchart/getkecamatan/') ?>" + label;
        };

		var ctx_cluster = document.getElementById("cluster").getContext('2d');
		ctx_cluster.width = 500;
		ctx_cluster.height = 500;
        var clusterChart = new Chart(ctx_cluster, {
			type: 'pie',
			data: {
				labels: [<?php foreach($cluster[0] as $cls => $c) { echo "'$cls',"; } ?>],
				datasets: [{
					label: '# of Votes',
					data: [<?php foreach($cluster[0] as $cls => $c) : echo "'$c',"; endforeach; ?>],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false
			}
		});

		document.getElementById("cluster").onclick = function(evt){
            var activePoints = clusterChart.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = clusterChart.data.labels[firstPoint._index];
            // var value = kpi_col.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            window.location.href = "<?php echo site_url('indirect/marketchart/getkecamatan/') ?>" + label;
        };



	</script>

</body>

</html>