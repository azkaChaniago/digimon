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
						<form action="<?php echo site_url('indirect/sharebroadband/fetchperiode') ?>" method="post">
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
			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6"><h2>Marketshare Broadband</h2></div>
						<div class="col-md-6" style="text-align: right">
							<h2><a href="<?php echo site_url('indirect/sharebroadband/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a>
							<!-- <a href="<?php echo site_url('indirect/sharebroadband/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
							<a href="<?php echo site_url('indirect/sharebroadband/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
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
									<th>Kecamatan</th>
									<th>Qty Telkomsel Market Share</th>
									<th>Qty Indosat Market Share</th>
									<th>Qty XL Market Share</th>
									<th>Qty Tri Market Share</th>
									<th>Qty Smartfrend Market Share</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sharebroadband as $broadband): ?>
								<tr>
									<td>
										<?php echo $broadband->tanggal ?>
									</td>
									<td>
										<?php echo $broadband->kecamatan ?>	
									</td><td class="small">
										<?php echo $broadband->qty_telkomsel_marketshare ?>
									</td>
									<td class="small">
										<?php echo $broadband->qty_indosat_marketshare ?>
									</td>
									<td class="small">
										<?php echo $broadband->qty_xl_marketshare ?>
									</td>
									<td class="small">
										<?php echo $broadband->qty_tri_marketshare ?>
									</td>
									<td class="small">
										<?php echo $broadband->qty_smartfrend_marketshare ?>
									</td>
									<td width='180'>
										<a href="<?php echo site_url('indirect/sharebroadband/edit/'.$broadband->id_market) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('indirect/sharebroadband/delete/'.$broadband->id_market) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('indirect/sharebroadband/detail/'.$broadband->id_market) ?>"><i class="material-icons">description</i></a>
									</td>
								</tr>
								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
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
