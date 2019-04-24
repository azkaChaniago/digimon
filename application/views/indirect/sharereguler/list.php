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
		<!-- DataTables -->
		<?php if ($this->uri->segment(3) == 'market'): ?>
		<div class="card">
			<div class="header">
				<div class="row">
					<form action="<?php echo site_url('indirect/sharereguler/fetchmarket') ?>" method="post">
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
							<button name="xls" class="btn btn-success waves-effect"><i class="material-icons" formtarget="_blank">save_alt</i>
							<span>Export Excel</span></button>
							<button name="pdf" class="btn btn-danger waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
							<span>Export PDF</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="header">
				<div class="row">
					<div class="col-md-6"><h2>Marketshare Reguler</h2></div>
					<div class="col-md-6" style="text-align: right">
						<h2><a href="<?php echo site_url('indirect/sharereguler/marketadd') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
						<span>Tambah<span></a>
						<!-- <a href="<?php echo site_url('indirect/sharereguler/exportmarket') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
						<span>Export Excel<span></a>
						<a href="<?php echo site_url('indirect/sharereguler/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
						<span>Export PDF<span></a></h2> -->
					</div>
				</div>						
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>TANGGAL</th>
								<th>KABUPATEN</th>
								<th>KECAMATAN</th>
								<th>TELKOMSEL</th>
								<th>INDOSAT</th>
								<th>XL</th>
								<th>TRI</th>
								<th>SMARTFREND</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($reguler_view as $reg): ?>
							<tr>
								<td>
									<?php echo $reg->tanggal ?>
								</td>
								<td>
									<?php echo $reg->kabupaten ?>	
								</td>
								<td>
									<?php echo $reg->kecamatan ?>	
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_telkomsel_marketshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_indosat_marketshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_xl_marketshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_tri_marketshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_smartfrend_marketshare ?>
								</td>				
								<td width='180'>
									<a href="<?php echo site_url('indirect/sharereguler/marketedit/'.$reg->id) ?>"><i class="material-icons">edit</i></a>
									<a onclick="deleteConfirm('<?php echo site_url('indirect/sharereguler/marketdelete/'.$reg->id) ?>')" href="#!"><i class="material-icons">delete</i></a>
									<a href="<?php echo site_url('indirect/sharereguler/marketdetail/'.$reg->id) ?>"><i class="material-icons">description</i></a>
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php elseif ($this->uri->segment(3) == 'recharge'): ?>
		<div class="card">
			<div class="header">
				<div class="row">
					<form action="<?php echo site_url('indirect/sharereguler/fetchrecharge') ?>" method="post">
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
							<button name="pdf" class="btn btn-danger waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
							<span>Export PDF</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="header">
				<div class="row">
					<div class="col-md-6"><h2>Recharge Reguler</h2></div>
					<div class="col-md-6" style="text-align: right">
						<h2><a href="<?php echo site_url('indirect/sharereguler/rechargeadd') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
						<span>Tambah<span></a>
						<!-- <a href="<?php echo site_url('indirect/sharereguler/exportrecharge') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
						<span>Export Excel<span></a>
						<a href="<?php echo site_url('indirect/sharereguler/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
						<span>Export PDF<span></a></h2> -->
					</div>
				</div>						
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>TANGGAL</th>
								<th>KABUPATEN</th>
								<th>KECAMATAN</th>
								<th>TELKOMSEL</th>
								<th>INDOSAT</th>
								<th>XL</th>
								<th>TRI</th>
								<th>SMARTFREND</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($reguler_view as $reg): ?>
							<tr>
								<td>
									<?php echo $reg->tanggal ?>
								</td>
								<td>
									<?php echo $reg->kabupaten ?>	
								</td>
								<td>
									<?php echo $reg->kecamatan ?>	
								</td>
								<td style="text-align: right">
									<?php echo $reg->mount_telkomsel_rechargeshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->mount_indosat_rechargeshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->mount_xl_rechargeshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->mount_tri_rechargeshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->mount_smartfrend_rechargeshare ?>
								</td>				
								<td width='180'>
									<a href="<?php echo site_url('indirect/sharereguler/rechargeedit/'.$reg->id) ?>"><i class="material-icons">edit</i></a>
									<a onclick="deleteConfirm('<?php echo site_url('indirect/sharereguler/rechargedelete/'.$reg->id) ?>')" href="#!"><i class="material-icons">delete</i></a>
									<a href="<?php echo site_url('indirect/sharereguler/rechargedetail/'.$reg->id) ?>"><i class="material-icons">description</i></a>
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php elseif ($this->uri->segment(3) == 'sales'): ?>
		<div class="card">
			<div class="header">
				<div class="row">
					<form action="<?php echo site_url('indirect/sharereguler/fetchsales') ?>" method="post">
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
							<button name="pdf" class="btn btn-danger waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
							<span>Export PDF</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="header">
				<div class="row">
					<div class="col-md-6"><h2>Salesshare Reguler</h2></div>
					<div class="col-md-6" style="text-align: right">
						<h2><a href="<?php echo site_url('indirect/sharereguler/salesadd') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
						<span>Tambah<span></a>
						<!-- <a href="<?php echo site_url('indirect/sharereguler/exportsales') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
						<span>Export Excel<span></a>
						<a href="<?php echo site_url('indirect/sharereguler/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
						<span>Export PDF<span></a></h2> -->
					</div>
				</div>						
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>TANGGAL</th>
								<th>KABUPATEN</th>
								<th>KECAMATAN</th>
								<th>TELKOMSEL</th>
								<th>INDOSAT</th>
								<th>XL</th>
								<th>TRI</th>
								<th>SMARTFREND</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($reguler_view as $reg): ?>
							<tr>
								<td>
									<?php echo $reg->tanggal ?>
								</td>
								<td>
									<?php echo $reg->kabupaten ?>	
								</td>
								<td>
									<?php echo $reg->kecamatan ?>	
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_telkomsel_salesshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_indosat_salesshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_xl_salesshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_tri_salesshare ?>
								</td>
								<td style="text-align: right">
									<?php echo $reg->qty_smartfrend_salesshare ?>
								</td>				
								<td width='180'>
									<a href="<?php echo site_url('indirect/sharereguler/salesedit/'.$reg->id) ?>"><i class="material-icons">edit</i></a>
									<a onclick="deleteConfirm('<?php echo site_url('indirect/sharereguler/salesdelete/'.$reg->id) ?>')" href="#!"><i class="material-icons">delete</i></a>
									<a href="<?php echo site_url('indirect/sharereguler/salesdetail/'.$reg->id) ?>"><i class="material-icons">description</i></a>
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php endif; ?>
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
