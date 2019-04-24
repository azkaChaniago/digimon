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

			<?php if ($this->session->flashdata('status_msg')) : ?>
				<div class="alert alert-danger" >
					<?php echo $this->session->flashdata('status_msg') ?>
				</div>
			<?php endif; ?>
			<div class="card">
				<div class="header">
					<div class="row">
						<form action="<?php echo site_url('indirect/outlet/fetchperiode') ?>" method="post">
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
						<div class="col-md-6"><h2>Outlet</h2></div>
						<div class="col-md-6" style="text-align: right">
							<h2><a href="<?php echo site_url('indirect/outlet/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a></h2>
							<!-- <a href="<?php echo site_url('indirect/outlet/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
							<a href="<?php echo site_url('indirect/outlet/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
							<span>Export PDF<span></a></h2> -->
						</div>
					</div>
				</div>

				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>Nama Outlet</th>
									<th>Kabupaten</th>
									<th>Kecamatan</th>
									<th>Alamat</th>
									<th>Nama Pemilik</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($outlet as $out): ?>
								<tr>
									<td width="150">
										<?php echo $out->nama_outlet ?>
									</td>
									<td class="small">
										<?php echo $out->kabupaten ?>
									</td>
									<td class="small">
										<?php echo $out->kecamatan ?>
									</td>
									<td class="small">
										<?php echo $out->alamat ?>
									</td>
									<td class="small">
										<?php echo $out->nama_pemilik ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('indirect/outlet/edit/'.$out->id_outlet) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('indirect/outlet/remove/'.$out->id_outlet) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('indirect/outlet/detail/'.$out->id_outlet) ?>"><i class="material-icons">description</i></a>	
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
