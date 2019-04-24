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
			<div class="row">
				<div class="card">
					<div class="header">
					
						<div class="row">
							<form action="<?php echo site_url('adminindirect/sharebroadband/fetchperiode') ?>" method="post">
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
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="header">
							<div class="text-center"><h2>Broadband Cluster Lampung</h2></div>
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
							<div class="row">
								<h2>Marketshare Broadband</h2>
							</div>					
						</div>
						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>NAMA TDC</th>
											<th>TANGGAL</th>
											<th>KABUPATEN</th>
											<th>KECAMATAN</th>
											<th>TELKOMSEL MARKETSHARE</th>
											<th>INDOSAT MARKETSHARE</th>
											<th>XL MARKETSHARE</th>
											<th>TRI MARKETSHARE</th>
											<th>SMARTFREND MARKETSHARE</th>
											<!-- <th>AKSI</th> -->
										</tr>
									</thead>
									<tbody>
										<?php foreach ($sharebroadband as $broad): ?>
										<tr>
											<td> <?php echo $broad->nama_tdc ?> </td>
											<td> <?php echo $broad->tanggal ?> </td>
											<td> <?php echo $broad->kabupaten ?> </td>
											<td> <?php echo $broad->kecamatan ?> </td>
											<td style="text-align:right"> <?php echo $broad->qty_telkomsel_marketshare ?> </td>
											<td style="text-align:right"> <?php echo $broad->qty_indosat_marketshare ?> </td>
											<td style="text-align:right"> <?php echo $broad->qty_xl_marketshare ?> </td>
											<td style="text-align:right"> <?php echo $broad->qty_tri_marketshare ?> </td>
											<td style="text-align:right"> <?php echo $broad->qty_smartfrend_marketshare ?> </td>
											<!-- <td width='180'>
												<a href="<?php echo site_url('adminindirect/sharebroadband/detail/'.$broadband->id_market) ?>"><i class="material-icons">description</i></a>
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
							<div class="text-center"><h2>Detail Broadband Cluster</h2></div>
						</div>
						<div class="body">
							<canvas id="kabupaten" width="500" height="500"></canvas>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="card">
						<div class="header">
							<div class="text-center"><h2>Detail Broadband Kabupaten <?php echo str_replace("%20"," ", $this->uri->segment(4)) ?></h2></div>
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
		var cluster = JSON.parse(<?php echo "'" . json_encode($broadband) . "'" ?>);

		var field = Object.keys(cluster[0]);
		var values = Object.values(cluster[0]);
		console.log(cluster);
		// var backgroundColor = [];
		// var borderColor = [];
		// var i = 0;
		// while(i < field.length) {
		// 	var randR = Math.floor((Math.random()* 130) + 100);
		// 	var randG = Math.floor((Math.random()* 130) + 100);
		// 	var randB = Math.floor((Math.random()* 130) + 100);
		// 	var graphColor = "rgb("+ randR +","+ randG +","+ randB +")";
		// 	backgroundColor.push(graphColor);
		// 	var outlineColor = "rgb("+ (randR - 80) +","+ (randG - 80) +","+ (randB - 80) +")";
		// 	borderColor.push(outlineColor);
		// 	i++;
		// }

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
				animation: {
				    duration: 500,
				    easing: "easeOutQuart",
				    onComplete: function () {
				      var ctx = this.chart.ctx;
				      ctx.font = "22px Verdana";
				      // ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
				      ctx.textAlign = 'center';
				      ctx.textBaseline = 'bottom';

				      this.data.datasets.forEach(function (dataset) {

				        for (var i = 0; i < dataset.data.length; i++) {
				          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
				              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
				              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
				              start_angle = model.startAngle,
				              end_angle = model.endAngle,
				              mid_angle = start_angle + (end_angle - start_angle)/2;

				          var x = mid_radius * Math.cos(mid_angle);
				          var y = mid_radius * Math.sin(mid_angle);

				          ctx.fillStyle = '#000';
				          if (i == 3){ // Darker text color for lighter background
				            ctx.fillStyle = '#000';
				          }
				          var percent = String(Math.round(dataset.data[i]/total*100)) + "%";      
				          //Don't Display If Legend is hide or value is 0
				          if(dataset.data[i] != 0 && dataset._meta[0].data[i].hidden != true) {
				            // ctx.fillText(dataset.data[i], model.x + x, model.y + y);
				            // Display percent in another line, line break doesn't work for fillText
				            ctx.fillText(percent, model.x + x, model.y + y + 15);
				          }
				        }
				      });               
				    }
				  }				
			},
		});
		

		var kabupaten = JSON.parse(<?php echo "'" . json_encode($kabupaten) . "'" ?>);
		// delete kabupaten[0].kabupaten;
		console.log(kabupaten);
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
				}
			}
		});

		document.getElementById("kabupaten").onclick = function(evt){
            var activePoints = horbar.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = horbar.data.labels[firstPoint._index];
            // var value = kpi_col.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            console.log(label);
            window.location.href = "<?php echo site_url('adminindirect/sharebroadband/index/') ?>" + label;
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
				}
			}
		});

		
	</script>

</body>

</html>
