<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("direct/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("direct/_parts/navbar.php") ?>
	
	<?php $this->load->view("direct/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">

			<div class="card">
				<div class="header">
					<div class="row">
						<form action="<?php echo site_url('direct/mercent/fetchperiode') ?>" method="post">
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
								<span>Excel</span></button>							
								<button name="pdf" class="btn btn-danger waves-effect" target="blank" formtarget="_blank"><i class="material-icons">save_alt</i>
								<span>PDF</span></button>
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
							<h2>Mercent</h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6" style='text-align: right'>							
							<h2><a href="<?php echo site_url('direct/mercent/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
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
									<th>Tanggal</th>
									<th>Nama Canvasser</th>
									<th>Nama Mercent</th>
									<th>Nama Pic</th>
									<th>No HP Pic</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($mercent as $mer): ?>
								<tr>
									<td>
										<?php echo $mer->nama_tdc ?>
									</td>
									<td>
										<?php echo $mer->tanggal ?>	
									</td>
									<td class="small">
										<?php echo $mer->nama_marketing ?>
									</td>
									<td class="small">
										<?php echo $mer->nama_mercent ?>
									</td>
									<td class="small">
										<?php echo $mer->nama_pic ?>
									</td>
									<td class="small">
										<?php echo $mer->no_hp_pic ?>
									</td>
									<td class="small">
										<?php echo $mer->alamat_mercent ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('direct/mercent/edit/'.$mer->id_mercent) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('direct/mercent/remove/'.$mer->id_mercent) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('direct/mercent/detail/'.$mer->id_mercent) ?>"><i class="material-icons">description</i></a>	
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
	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("direct/_parts/modal.php") ?>

	<?php $this->load->view("direct/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
