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
			<div class="card">
				<div class="header">
					<div class="row">
						<form action="<?php echo site_url('indirect/distribusicollector/fetchperiode') ?>" method="post">
							<div class="col-md-5">
								<div class="form-group form-float">
									<div class="form-line" id="bs_datepicker_container">
										<input class="form-control" type="text" name="start" placeholder="Tanggal periode awal" required/>
										<!-- <label class="form-label" for="start">Periode Awal*</label> -->
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group form-float">
									<div class="form-line" id="bs_datepicker_container">
										<input class="form-control" type="text" name="end" placeholder="Tanggal periode akhir" required/>
										<!-- <label class="form-label" for="end">Periode Akhir*</label> -->
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<button name="xls" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
								<span>Export Excel</span></button>
								<button name="pdf" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
								<span>Export PDF</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<h2 style="margin-bottom: 17px">Target Assignment Collector	</h2>
						</div>
						<div class="col-md-6" style='text-align: right'>
							<h2><a href="<?php echo site_url('indirect/distribusicollector/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah</span></a></h2>
						</div>
					</div>				
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>Tahun</th>
									<th>Bulan</th>
									<th>Nama Collector</th>
									<th>New RS Non Outlet</th>
									<th>Collecting</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($collector as $dist): ?>
								<tr>
									<td>
										<?php echo $dist->tahun ?>
									</td>
									<td>
										<?php echo $dist->bulan ?>
									</td>
									<td>
										<?php echo $dist->nama_marketing ?>	
									</td>
									<td>
										<?php echo $dist->new_rs_non_outlet ?>	
									</td>
									<td style="text-align: right">
										<?php echo $dist->collecting ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('indirect/distribusicollector/edit/'.$dist->id_target) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('indirect/distribusicollector/delete/'.$dist->id_target) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('indirect/distribusicollector/detail/'.$dist->id_target) ?>"><i class="material-icons">description</i></a>	
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
		<!-- /.container-fluid -->

		</div>
		<!-- /.content-wrapper -->

	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("indirect/_parts/modal.php") ?>

	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
