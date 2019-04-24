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
					<div class="col-md-6"><h2>Marketshare Reguler Salesshare</h2></div>
					<!-- <div class="col-md-6" style="text-align: right">
						<h2><a href="<?php echo site_url('adminindirect/sharereguler/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
						<span>Tambah<span></a>
						<a href="<?php echo site_url('adminindirect/sharereguler/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
						<span>Export Excel<span></a>
						<a href="<?php echo site_url('adminindirect/sharereguler/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
						<span>Export PDF<span></a></h2>
					</div> -->
				</div>						
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th rowspan='2'>NAMA TDC</th>
								<th rowspan='2'>TANGGAL</th>
								<th rowspan='2'>KABUPATEN</th>
								<th rowspan='2'>KECAMATAN</th>
								<th colspan='3'>TELKOMSEL</th>
								<th colspan='2'>INDOSAT</th>
								<th rowspan='2'>XL</th>
								<th rowspan='2'>TRI</th>
								<th rowspan='2'>SMARTFREND</th>
								<!-- <th>Aksi</th> -->
							</tr>
							<tr>
								<th>SIMPATI</th>
								<th>AS</th>
								<th>LOOP</th>
								<th>INDOSAT</th>
								<th>IM3</th>
								<!-- <th>Aksi</th> -->
							</tr>
						</thead>
						<tbody>
							<?php foreach ($sharereguler as $reg): ?>
							<tr>
								<td><?php echo $reg->nama_tdc ?></td>
								<td><?php echo $reg->tanggal ?></td>
								<td><?php echo $reg->kabupaten ?></td>
								<td><?php echo $reg->kecamatan ?></td>
								<td><?php echo $reg->qty_simpati_salesshare ?></td>
								<td><?php echo $reg->qty_as_salesshare ?></td>
								<td><?php echo $reg->qty_loop_salesshare ?></td>
								<td><?php echo $reg->qty_mentari_salesshare ?></td>
								<td><?php echo $reg->qty_im3_salesshare ?></td>
								<td><?php echo $reg->qty_xl_salesshare ?></td>
								<td><?php echo $reg->qty_tri_salesshare ?></td>
								<td><?php echo $reg->qty_smartfrend_salesshare ?></td>
								<!-- <td width='180'>
									<a href="<?php echo site_url('adminindirect/sharereguler/detail/'.$reg->id_market) ?>"><i class="material-icons">description</i></a>
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
