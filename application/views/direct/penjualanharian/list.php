<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/direct/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/direct/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/direct/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/direct/_parts/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<h2>Penjualan Harian</h2><hr>
						<a href="<?php echo site_url('direct/penjualanharian/add') ?>"><i class="fas fa-plus"></i> Add New</a>						
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama TDC</th>
										<th>Divisi</th>
										<th>Tanggal Penjualan</th>
										<th>Nama Marketing</th>
										<th>Lokasi Penjualan</th>
                                        <th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($penjualanharian as $jual): ?>
									<tr>
										<td>
											<?php echo $jual->nama_tdc ?>
										</td>
										<td>
											<?php echo $jual->divisi ?>	
										</td>
										<td class="small">
											<?php echo $jual->tgl_penjualan ?>
										</td>
										<td class="small">
											<?php echo $jual->nama_marketing ?>
										</td>
										<td class="small">
											<?php echo $jual->lokasi_penjualan ?>
										</td>
										<td width='180'>
											<a href="<?php echo site_url('direct/penjualanharian/edit/'.$jual->id_penjualan) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('direct/penjualanharian/remove/'.$jual->id_penjualan) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i></a>
											<a href="<?php echo site_url('direct/penjualanharian/detail/'.$jual->id_penjualan) ?>" 
											 class="btn btn-small text-success"><i class="fas fa-info"></i> Detail</a>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/direct/_parts/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/direct/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/direct/_parts/modal.php") ?>

	<?php $this->load->view("admin/direct/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
