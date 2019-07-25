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
					<form action="<?= site_url('indirect/historiorder/fetchperiode') ?>" method="post">
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
							<button name="xls" class="btn btn-success waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
							<span>Export Excel</span></button>
							<button name="pdf" class="btn btn-danger waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
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
					<div class="col-md-6"><h2>Histori Order</h2></div>
					<div class="col-md-6" style="text-align: right">
						<h2><a href="<?= site_url('indirect/historiorder/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
						<span>Tambah<span></a>
						<!-- <a href="<?= site_url('indirect/historiorder/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
						<span>Export Excel<span></a>
						<a href="<?= site_url('indirect/historiorder/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
						<span>Export PDF<span></a></h2> -->
					</div>
				</div>						
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>Nama Canvasser</th>
								<th>Nama Outlet</th>
								<th>AS</th>
								<th>Simpati</th>
								<th>Loop</th>
								<th>NSB</th>
								<th>MKIOS Regular</th>
								<th>MKIOS Bulk</th>
								<!-- <th>GT Pulsa</th> -->
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histori as $hist): ?>
							<tr>
								<td>
									<?= $hist->tanggal ?>
								</td>
								<td>
									<?= $hist->nama_marketing ?>	
								</td>
								<td class="small">
									<?= $hist->nama_outlet ?>
								</td>
								<td class="small">
									<?= $hist->as ?>
								</td>
								<td class="small">
									<?= $hist->simpati ?>
								</td>
								<td class="small">
									<?= $hist->loop ?>
								</td>
								<td class="small">
									<?= $hist->nsb ?>
								</td>
								<td class="small">
									<?= $hist->mkios_reguler ?>
								</td>
								<td class="small">
									<?= $hist->mkios_bulk ?>
								</td>
								<!-- <td class="small">
									<?= $hist->gt_pulsa ?>
								</td> -->
								<td width='180' class="text-center" >
									<a href="<?= site_url('indirect/historiorder/edit/'.$hist->id_histori_order) ?>"><i class="material-icons">edit</i></a>
									<a onclick="deleteConfirm('<?= site_url('indirect/historiorder/delete/'.$hist->id_histori_order) ?>')" href="#!"><i class="material-icons">delete</i></a>
									<a href="<?= site_url('indirect/historiorder/detail/'.$hist->id_histori_order) ?>"><i class="material-icons">description</i></a>	
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>

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
