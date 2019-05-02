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

			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<h2>Sekolah</h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6" style='text-align: right'>							
							<h2><a href="<?php echo site_url('admindirect/marketsharesekolah/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
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
										<a href="<?php echo site_url('admindirect/marketsharesekolah/edit/'.$ms->id_market) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('admindirect/marketsharesekolah/remove/'.$ms->id_market) ?>')" href="#!"><i class="material-icons">delete</i></a>
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
	</script>

</body>

</html>
