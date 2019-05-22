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
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="header">
							<h2>Komunitas Chart</h2>
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
									<h2>Mercent</h2>
									<div class="clearfix"></div>
								</div>
								<div class="col-md-6" style='text-align: right'>							
									<h2>
										<!-- <a href="<?php echo site_url('admindirect/komunitas/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i><span>Tambah</span></a> -->
										<a href="<?php echo site_url('admindirect/komunitas/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
										<span>Excel</span></a>							
										<a href="<?php echo site_url('admindirect/komunitas/exportpdf') ?>" class="btn btn-danger waves-effect"  target="_blank"><i class="material-icons">save_alt</i>
										<span>PDF</span></a>
									</h2>
								</div> 						
							</div>
						</div>

						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>Nama TDC</th>
											<th>Nama Petugas</th>
											<th>Nama Komunitas</th>
											<th>Alamat</th>
											<th>Nama Sosmed</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($komunitas as $k): ?>
										<tr>
											<td>
												<?php echo $k->nama_tdc ?>
											</td>
											<td>
												<?php echo $k->nama_petugas ?>	
											</td>
											<td class="small">
												<?php echo $k->nama_komunitas ?>
											</td>
											<td class="small">
												<?php echo $k->alamat ?>
											</td>
											<td class="small">
												<?php echo $k->nama_sosmed ?>
											</td>
											<td width='180' class="text-center" >
												<!-- <a href="<?php echo site_url('admindirect/komunitas/edit/'.$k->id_komunitas) ?>"><i class="material-icons">edit</i></a>
												<a onclick="deleteConfirm('<?php echo site_url('admindirect/komunitas/remove/'.$k->id_komunitas) ?>')" href="#!"><i class="material-icons">delete</i></a> -->
												<a href="<?php echo site_url('admindirect/komunitas/detail/'.$k->id_komunitas) ?>"><i class="material-icons">description</i></a>	
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
		var data_kpi = JSON.parse(<?php echo "'" . json_encode($komunitas) . "'" ?>);
        var labels = data_kpi.map(k => k.nama_komunitas); 
        if (typeof data_kpi.map(k => k.nama_komunitas)[0] === 'undefined') {
            labels = data_kpi.map(k => k.nama_ketua);
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
                    label: "JUMLAH ANGGOTA KOMUNITAS",
                    data: data_kpi.map(k => k.jumlah_anggota),
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
