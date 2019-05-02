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
						<form action="<?php echo site_url('direct/event/fetchperiode') ?>" method="post">
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

			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<h2>Event</h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6" style='text-align: right'>							
							<h2><a href="<?php echo site_url('direct/event/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah</span></a></h2>
						</div> 						
					</div>
				</div>

				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>NAMA TDC</th>
									<th>TANGGAL EVENT</th>
									<th>NAMA EVENT</th>
									<th>LOKASI PENJUALAN</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($event as $ev): ?>
								<tr>
									<td>
										<?php echo $ev->nama_tdc ?>
									</td>
									<td>
										<?php echo $ev->tgl_event ?>
									</td>
									<td>
										<?php echo $ev->nama_event ?>	
									</td>
									<td>
										<?php echo $ev->lokasi_penjualan ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('direct/event/edit/'.$ev->id_event) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('direct/event/remove/'.$ev->id_event) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('direct/event/detail/'.$ev->id_event) ?>"><i class="material-icons">description</i></a>	
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
