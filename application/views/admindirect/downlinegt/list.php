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
						<form action="<?php echo site_url('admindirect/downlinegt/fetchperiode') ?>" method="post">
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
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="header">
							<h2>Downline Chart</h2>
						</div>
						<div class="body">
							<canvas id="canvasser" width="100%" height="30"></canvas>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<!-- DataTables -->
					<div class="card">
						<div class="header">
							<div class="row">
								<div class="col-md-6">
									<h2>Downline GT</h2>
									<div class="clearfix"></div>
								</div>
								<div class="col-md-6" style='text-align: right'>							
									<h2><a href="<?php echo site_url('admindirect/downlinegt/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
									<span>Tambah</span></a></h2>
								</div> 						
							</div>
						</div>				
						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>Nama TDC</th>
											<th>Divisi</th>
											<th>Tanggal</th>
											<th>Nama Canvasser</th>
											<th>Nama Downline</th>
											<th>Alamat</th>
											<th>Nomor GT</th>
											<th>Deposit</th>
											<!-- <th>Aksi</th> -->
										</tr>
									</thead>
									<tbody>
										<?php foreach ($downlinegt as $gt): ?>
										<tr>
											<td>
												<?php echo $gt->nama_tdc ?>
											</td>
											<td>
												<?php echo $gt->divisi ?>	
											</td>
											<td class="small">
												<?php echo $gt->tanggal ?>
											</td>
											<td class="small">
												<?php echo $gt->nama_marketing ?>
											</td>
											<td class="small">
												<?php echo $gt->nama_downline ?>
											</td>
											<td class="small">
												<?php echo $gt->alamat ?>
											</td>
											<td class="small">
												<?php echo $gt->nomor_gt ?>
											</td>
											<td class="small">
												<?php echo $gt->deposit ?>
											</td>
											<!-- <td width='180' class="text-center" >
												<a href="<?php echo site_url('admindirect/downlinegt/edit/'.$gt->id_downline_gt) ?>"><i class="material-icons">edit</i></a>
												<a onclick="deleteConfirm('<?php echo site_url('admindirect/downlinegt/remove/'.$gt->id_downline_gt) ?>')" href="#!"><i class="material-icons">delete</i></a>
												<a href="<?php echo site_url('admindirect/downlinegt/detail/'.$gt->id_downline_gt) ?>"><i class="material-icons">description</i></a>	
											</td> -->
											<?php unset($gt->foto) ?>
										</tr>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
						</div>
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

		
		
		var data_kpi = JSON.parse(<?php echo "'" . json_encode($downlinegt) . "'" ?>);
        var labels = data_kpi.map(k => k.nama_downline); 
        if (typeof data_kpi.map(k => k.nama_downline)[0] === 'undefined') {
            labels = data_kpi.map(k => k.nama_marketing);
        }
        
        console.log(data_kpi);

        var backgroundColor = [];
		var borderColor = [];
		var i = 0;
		while(i < data_kpi.map(k => k.nama_tdc).length) {
			var randR = Math.floor((Math.random()* 130) + 100);
			var randG = Math.floor((Math.random()* 130) + 100);
			var randB = Math.floor((Math.random()* 130) + 100);
			var graphColor = "rgb("+ randR +","+ randG +","+ randB +")";
			backgroundColor.push(graphColor);
			var outlineColor = "rgb("+ (randR - 80) +","+ (randG - 80) +","+ (randB - 80) +")";
			borderColor.push(outlineColor);
			i++;
		}

        var kpiChart = document.getElementById('canvasser').getContext('2d');
        var kpi_ch = new Chart(kpiChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "DEPOSIT DOWNLINE",
                    data: data_kpi.map(k => k.deposit),
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                        }
                    }]
                }
            }
        });
	</script>

</body>

</html>
