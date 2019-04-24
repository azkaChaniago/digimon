<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("adminindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("adminindirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("adminindirect/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">
			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6"><h2>Marketshare Broadband</h2></div>
						<!-- <div class="col-md-6" style="text-align: right">
							<h2><a href="<?php echo site_url('adminindirect/sharebroadband/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a>
							<a href="<?php echo site_url('adminindirect/sharebroadband/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
							<a href="<?php echo site_url('adminindirect/sharebroadband/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
							<span>Export PDF<span></a></h2>
						</div> -->
					</div>					
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>NAMA TDC</th>
									<th>TANGGAL</th>
									<th>KABUPATEN</th>
									<th>KECAMATAN</th>
									<th>TELKOMSEL MARKETSHARE</th>
									<th>INDOSAT MARKETSHARE</th>
									<th>XL MARKETSHARE</th>
									<th>TRI MARKETSHARE</th>
									<th>SMARTFREND MARKETSHARE</th>
									<!-- <th>AKSI</th> -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sharebroadband as $broadband): ?>
								<tr>
									<td> <?php echo $broadband->nama_tdc ?> </td>
									<td> <?php echo $broadband->tanggal ?> </td>
									<td> <?php echo $broadband->kabupaten ?> </td>
									<td> <?php echo $broadband->kecamatan ?> </td>
									<td style="text-align:right"> <?php echo $broadband->qty_telkomsel_marketshare ?> </td>
									<td style="text-align:right"> <?php echo $broadband->qty_indosat_marketshare ?> </td>
									<td style="text-align:right"> <?php echo $broadband->qty_xl_marketshare ?> </td>
									<td style="text-align:right"> <?php echo $broadband->qty_tri_marketshare ?> </td>
									<td style="text-align:right"> <?php echo $broadband->qty_smartfrend_marketshare ?> </td>
									<!-- <td width='180'>
										<a href="<?php echo site_url('adminindirect/sharebroadband/detail/'.$broadband->id_market) ?>"><i class="material-icons">description</i></a>
									</td> -->
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

	<?php $this->load->view("adminindirect/_parts/modal.php") ?>

	<?php $this->load->view("adminindirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
