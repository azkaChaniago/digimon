<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("admindirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("admindirect/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">

			<div class="card">
				<div class="header">
					<div class="row">
						<form action="<?php echo site_url('admindirect/marketsharesekolah/fetchperiode') ?>" method="post">
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
								<span>Excel</span></button>							
								<button name="pdf" class="btn btn-danger waves-effect" target="blank" formtarget="_blank"><i class="material-icons">save_alt</i>
								<span>PDF</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="text-center"><h2>Chart Marketshare Sekolah</h2></div>
					</div>
					<div class="body">
						<canvas id="cluster" width="500" height="500"></canvas>
					</div>
				</div>
			</div>
			<!-- DataTables -->
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<div class="row">
							<div class="col-md-6">
								<h2>Marketshare Sekolah</h2>
								<div class="clearfix"></div>
							</div>
							<div class="col-md-6" style='text-align: right'>							
								<!-- <h2><a href="<?php echo site_url('admindirect/marketsharesekolah/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
								<span>Tambah</span></a></h2> -->
							</div> 						
						</div>
					</div>

					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
									<tr>
										<th>Nama TDC</th>
										<th>Nama Sekolah</th>
										<th>Tanggal Marketshare</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($marketshare as $ms): ?>
									<tr>
										<td>
											<?php echo $ms->nama_tdc ?>
										</td>
										<td>
											<?php echo $ms->nama_sekolah ?>	
										</td>
										<td class="small">
											<?php echo $ms->tgl_marketshare ?>
										</td>
										<td width='180' class="text-center" >
											<!-- <a href="<?php echo site_url('admindirect/marketsharesekolah/edit/'.$ms->id_market) ?>"><i class="material-icons">edit</i></a>
											<a onclick="deleteConfirm('<?php echo site_url('admindirect/marketsharesekolah/remove/'.$ms->id_market) ?>')" href="#!"><i class="material-icons">delete</i></a> -->
											<a href="<?php echo site_url('admindirect/marketsharesekolah/detail/'.$ms->id_market) ?>"><i class="material-icons">description</i></a>	
										</td>
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
							<div class="text-center"><h2>Detail Marketshare Sekolah</h2></div>
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

	<?php $this->load->view("admindirect/_parts/modal.php") ?>

	<?php $this->load->view("admindirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}

		const cluster = JSON.parse('<?= json_encode($chartSekolah) ?>');

		const field = Object.keys(cluster[0]);
		const values = Object.values(cluster[0]);

		const canvas = document.getElementById("cluster"); 
		const ctx = document.getElementById("cluster").getContext('2d');
		const midX = canvas.width / 2;
		const midY = canvas.height / 2;

		const myChart = new Chart(ctx, {
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

		const kabupaten = JSON.parse('<?= json_encode($chartKabupaten) ?>');
		// delete kabupaten[0].kabupaten;
		
		const total = [];
		kabupaten.forEach((e, i, arr) => {
			let tot = parseInt( e.Telkomsel) + parseInt(e.Indosat) + parseInt(e.XL) + parseInt(e.Tri) + parseInt(e.Smartfrend);
			total.push(tot);
		})
		
		let kab_field = kabupaten.map(k => k.kabupaten);
		console.log(kabupaten)
		let Telkomsel = kabupaten.map((e, i, arr) => {
			return Math.trunc(parseInt(e.Telkomsel)/total[i]*100);
		});
		let Indosat = kabupaten.map((e, i, arr) => {
			return Math.trunc(parseInt(e.Indosat)/total[i]*100);
		});
		let XL = kabupaten.map((e, i, arr) => {
			return Math.trunc(parseInt(e.XL)/total[i]*100);
		});
		let Tri = kabupaten.map((e, i, arr) => {
			return Math.trunc(parseInt(e.Tri)/total[i]*100);
		});
		let Smartfrend = kabupaten.map((e, i, arr) => {
			return Math.trunc(parseInt(e.Smartfrend)/total[i]*100);
		});

		var ctxKab = document.getElementById("kabupaten").getContext('2d');
		ctxKab.width = 500;
		ctxKab.height = 500;
        var horbar = new Chart(ctxKab, {
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
            window.location.href = "<?php echo site_url('admindirect/marketsharesekolah/index/') ?>" + label;
        };

		const kecamatan = JSON.parse('<?= json_encode(isset($chartKecamatan) ? $chartKecamatan : "") ?>');

        console.log(kecamatan);

        const summarize = [];
		kecamatan.forEach(function(e, i, arr) {
			let tot = parseInt( e.Telkomsel) + parseInt(e.Indosat) + parseInt(e.XL) + parseInt(e.Tri) + parseInt(e.Smartfrend);
			summarize.push(tot);
		})
		
		const kec_field = kecamatan.map(k =>k.kecamatan);
		// var Telkomsel = kecamatan.map(k =>k.Telkomsel);
		
		let tel = kecamatan.map(function(e, i, arr) {
			return Math.trunc(parseInt(e.Telkomsel)/summarize[i]*100);
		});
		let ind = kecamatan.map(function(e, i, arr) {
			return Math.trunc(parseInt(e.Indosat)/summarize[i]*100);
		});
		let eksel = kecamatan.map(function(e, i, arr) {
			return Math.trunc(parseInt(e.XL)/summarize[i]*100);
		});
		let teri = kecamatan.map(function(e, i, arr) {
			return Math.trunc(parseInt(e.Tri)/summarize[i]*100);
		});
		let smart = kecamatan.map(function(e, i, arr) {
			return Math.trunc(parseInt(e.Smartfrend)/summarize[i]*100);
		});

		var ctxKec = document.getElementById("kecamatan").getContext('2d');
		ctxKec.width = 500;
		ctxKec.height = 500;
        var horbar2 = new Chart(ctxKec, {
			type: 'horizontalBar',
			data: {
				labels: kec_field,
				datasets: [
				{
					label: 'Telkomsel',
					data: tel,
					backgroundColor:'rgba(250, 60, 50, 0.9)',
					borderColor:'rgb(220, 70, 50)',
					borderWidth: 1
				},
				{
					label: 'Indosat',
					data: ind,
					backgroundColor:'rgba(230, 250, 20, 0.9)',
					borderColor: 'rgb(200, 250, 20)',
					borderWidth: 1
				},
				{
					label: 'XL',
					data: eksel,
					backgroundColor:'rgba(50, 50, 250, 0.9)',
					borderColor:'rgb(40, 40, 230)',
					borderWidth: 1
				},
				{
					label: 'Tri',
					data: teri,
					backgroundColor:'rgba(50, 50, 50, 0.9)',
					borderColor: 'rgb(30, 30, 30)',
					borderWidth: 1
				},
				{
					label: 'Smartfrend',
					data: smart,
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
