<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("adminindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("adminindirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("adminindirect/_parts/sidebar.php") ?>

	<section class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="header">
				<div class="row">
					<form action="<?php echo site_url('adminindirect/sharereguler/fetchmarket') ?>" method="post">
						<div class="col-md-5">
							<div class="form-group form-float">
								<div class="form-line" id="bs_datepicker_container">
									<input class="form-control" type="text" name="start" required/>
									<label class="form-label" for="start">Periode Awal*</label>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group form-float">
								<div class="form-line" id="bs_datepicker_container">
									<input class="form-control" type="text" name="end" required/>
									<label class="form-label" for="end">Periode Akhir*</label>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<button name="xls" class="btn btn-success waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
							<span>Export Excel</span></button>
							<button name="pdf" class="btn btn-danger waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
							<span>Export PDF</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
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

			<div class="col-md-6">
				<!-- DataTables -->
				<div class="card">
					<div class="header">
						<h2>Marketshare Reguler</h2>				
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
									<tr>
										<th rowspan='2'>NAMA TDC</th>
										<th rowspan='2'>TANGGAL</th>
										<th rowspan='2'>KABUPATEN</th>
										<th rowspan='2'>KECAMATAN</th>
										<th colspan='3'>TELKOMSEL</th>
										<th colspan='2'>INDOSAT</th>
										<th rowspan='2'>XL</th>
										<th rowspan='2'>TRI</th>
										<th rowspan='2'>SMARTFREND</th>
										<!-- <th>Aksi</th> -->
									</tr>
									<tr>
										<th>SIMPATI</th>
										<th>AS</th>
										<th>LOOP</th>
										<th>INDOSAT</th>
										<th>IM3</th>
										<!-- <th>Aksi</th> -->
									</tr>
								</thead>
								<tbody>
									<?php foreach ($sharereguler as $reg): ?>
									<tr>
										<td><?php echo $reg->nama_tdc ?></td>
										<td><?php echo $reg->tanggal ?></td>
										<td><?php echo $reg->kabupaten ?></td>
										<td><?php echo $reg->kecamatan ?></td>
										<td><?php echo $reg->qty_simpati_marketshare ?></td>
										<td><?php echo $reg->qty_as_marketshare ?></td>
										<td><?php echo $reg->qty_loop_marketshare ?></td>
										<td><?php echo $reg->qty_mentari_marketshare ?></td>
										<td><?php echo $reg->qty_im3_marketshare ?></td>
										<td><?php echo $reg->qty_xl_marketshare ?></td>
										<td><?php echo $reg->qty_tri_marketshare ?></td>
										<td><?php echo $reg->qty_smartfrend_marketshare ?></td>
										<!-- <td width='180'>
											<a href="<?php echo site_url('adminindirect/sharereguler/detail/'.$reg->id_market) ?>"><i class="material-icons">description</i></a>
										</td> -->
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Detail Marketshare Cluster</h2></div>
					</div>
					<div class="body">
						<canvas id="kabupaten" width="500" height="500"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Detail Marketshare Kabupaten <?php echo str_replace("%20"," ", $this->uri->segment(4)) ?></h2></div>
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

	<?php $this->load->view("adminindirect/_parts/modal.php") ?>

	<?php $this->load->view("adminindirect/_parts/js.php") ?>

	<script>
		var cluster = JSON.parse(<?php echo "'" . json_encode($regular) . "'" ?>);

		var field = Object.keys(cluster[0]);
		var values = Object.values(cluster[0]);
		const totalCluster = values.reduce(((tot, num) => tot + Math.round(num)), 0);

		var canvas = document.getElementById("cluster"); 
		var ctx = document.getElementById("cluster").getContext('2d');
		var midX = canvas.width / 2;
		var midY = canvas.height / 2;

        var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: field,
				datasets: [{
					label: '# of Votes',
					data: values,
					backgroundColor:[
						'rgba(250, 60, 50, 0.9)',
						'rgba(230, 250, 20, 0.9)',
						'rgba(50, 50, 250, 0.9)',
						'rgba(50, 50, 50, 0.9)',
						'rgba(150, 150, 150, 0.9)',
					],
					borderColor: [
						'rgb(220, 70, 50)',
						'rgb(200, 250, 20)',
						'rgb(40, 40, 230)',
						'rgb(30, 30, 30)',
						'rgb(120, 120, 120)',
					],
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					datalabels: {
						color: '#000',
						display: true,
						align: 'center',
						anchor: 'center',
                        formatter: val => Math.round(val/totalCluster*100) + '%'
					}
				}
			},
		});
		
		var kabupaten = JSON.parse(<?php echo "'" . json_encode($kabupaten) . "'" ?>);
		// delete kabupaten[0].kabupaten;
		
		var total = [];
		kabupaten.forEach(function(e, i, arr) {
			var tot = parseInt( e.Telkomsel) + parseInt(e.Indosat) + parseInt(e.XL) + parseInt(e.Tri) + parseInt(e.Smartfrend);
			total.push(tot);
		})
		
		var kab_field = kabupaten.map(k =>k.kabupaten);
		// var Telkomsel = kabupaten.map(k =>k.Telkomsel);
		var Telkomsel = [];
		var Indosat = [];
		var XL = [];
		var Tri = [];
		var Smartfrend = [];
		kabupaten.forEach(function(e, i, arr) {
			Telkomsel.push(Math.trunc(parseInt(e.Telkomsel)/total[i]*100));
		});
		kabupaten.forEach(function(e, i, arr) {
			Indosat.push(Math.trunc(parseInt(e.Indosat)/total[i]*100));
		});
		kabupaten.forEach(function(e, i, arr) {
			XL.push(Math.trunc(parseInt(e.XL)/total[i]*100));
		});
		kabupaten.forEach(function(e, i, arr) {
			Tri.push(Math.trunc(parseInt(e.Tri)/total[i]*100));
		});
		kabupaten.forEach(function(e, i, arr) {
			Smartfrend.push(Math.trunc(parseInt(e.Smartfrend)/total[i]*100));
		});

		var ctx = document.getElementById("kabupaten").getContext('2d');
		ctx.width = 500;
		ctx.height = 500;
        var horbar = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: kab_field,
				datasets: [
				{
					label: 'Telkomsel',
					data: Telkomsel,
					backgroundColor:'rgba(250, 60, 50, 0.9)',
					borderColor:'rgb(220, 70, 50)',
					borderWidth: 1
				},
				{
					label: 'Indosat',
					data: Indosat,
					backgroundColor:'rgba(230, 250, 20, 0.9)',
					borderColor: 'rgb(200, 250, 20)',
					borderWidth: 1
				},
				{
					label: 'XL',
					data: XL,
					backgroundColor:'rgba(50, 50, 250, 0.9)',
					borderColor:'rgb(40, 40, 230)',
					borderWidth: 1
				},
				{
					label: 'Tri',
					data: Tri,
					backgroundColor:'rgba(50, 50, 50, 0.9)',
					borderColor: 'rgb(30, 30, 30)',
					borderWidth: 1
				},
				{
					label: 'Smartfrend',
					data: Smartfrend,
					backgroundColor:'rgba(150, 150, 150, 0.9)',
					borderColor:'rgb(120, 120, 120)',
					borderWidth: 1
				}
			]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					xAxes: [{
						stacked: true,
					}],
					yAxes: [{
						stacked: true
					}]
				},
				plugins: {
					datalabels: {
						color: '#000',
						display: true,
						align: 'center',
						anchor: 'center',
                        formatter: val => Math.round(val) + '%'
					}
				}
			}
		});

		document.getElementById("kabupaten").onclick = function(evt){
            var activePoints = horbar.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = horbar.data.labels[firstPoint._index];
            // var value = kpi_col.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            console.log(label);
            window.location.href = "<?php echo site_url('adminindirect/sharereguler/marketshare/') ?>" + label;
        };

        var kecamatan = JSON.parse(<?php echo "'" . json_encode(isset($kecamatan) ? $kecamatan : "") . "'" ?>);

        console.log(kecamatan);

        var total = [];
		kecamatan.forEach(function(e, i, arr) {
			var tot = parseInt( e.Telkomsel) + parseInt(e.Indosat) + parseInt(e.XL) + parseInt(e.Tri) + parseInt(e.Smartfrend);
			total.push(tot);
		})
		
		var kab_field = kecamatan.map(k =>k.kecamatan);
		// var Telkomsel = kecamatan.map(k =>k.Telkomsel);
		var Telkomsel = [];
		var Indosat = [];
		var XL = [];
		var Tri = [];
		var Smartfrend = [];
		kecamatan.forEach(function(e, i, arr) {
			Telkomsel.push(Math.trunc(parseInt(e.Telkomsel)/total[i]*100));
		});
		kecamatan.forEach(function(e, i, arr) {
			Indosat.push(Math.trunc(parseInt(e.Indosat)/total[i]*100));
		});
		kecamatan.forEach(function(e, i, arr) {
			XL.push(Math.trunc(parseInt(e.XL)/total[i]*100));
		});
		kecamatan.forEach(function(e, i, arr) {
			Tri.push(Math.trunc(parseInt(e.Tri)/total[i]*100));
		});
		kecamatan.forEach(function(e, i, arr) {
			Smartfrend.push(Math.trunc(parseInt(e.Smartfrend)/total[i]*100));
		});

		var ctx = document.getElementById("kecamatan").getContext('2d');
		ctx.width = 500;
		ctx.height = 500;
        var horbar2 = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: kab_field,
				datasets: [
				{
					label: 'Telkomsel',
					data: Telkomsel,
					backgroundColor:'rgba(250, 60, 50, 0.9)',
					borderColor:'rgb(220, 70, 50)',
					borderWidth: 1
				},
				{
					label: 'Indosat',
					data: Indosat,
					backgroundColor:'rgba(230, 250, 20, 0.9)',
					borderColor: 'rgb(200, 250, 20)',
					borderWidth: 1
				},
				{
					label: 'XL',
					data: XL,
					backgroundColor:'rgba(50, 50, 250, 0.9)',
					borderColor:'rgb(40, 40, 230)',
					borderWidth: 1
				},
				{
					label: 'Tri',
					data: Tri,
					backgroundColor:'rgba(50, 50, 50, 0.9)',
					borderColor: 'rgb(30, 30, 30)',
					borderWidth: 1
				},
				{
					label: 'Smartfrend',
					data: Smartfrend,
					backgroundColor:'rgba(150, 150, 150, 0.9)',
					borderColor:'rgb(120, 120, 120)',
					borderWidth: 1
				}
			]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					xAxes: [{
						stacked: true,
					}],
					yAxes: [{
						stacked: true
					}]
				},
				plugins: {
					datalabels: {
						color: '#000',
						display: true,
						align: 'center',
						anchor: 'center',
                        formatter: val => Math.round(val) + '%'
					}
				}
			}
		});		
	</script>

</body>

</html>
