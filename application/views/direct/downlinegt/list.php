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
						<h2>Downline GT</h2><hr>
						<a href="<?php echo site_url('direct/downlinegt/add') ?>"><i class="fas fa-plus"></i> Add New</a>						
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama TDC</th>
										<th>Divisi</th>
										<th>Tanggal</th>
										<th>Nama Canvasser</th>
										<th>Nama Downline</th>
										<th>Alamat</th>
										<th>Nomor GT</th>
										<th>Deposit</th>
                                        <th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($downlinegt as $gt): ?>
									<tr>
										<td>
											<?php echo $gt->nama_tdc ?>
										</td>
										<td>
											<?php echo $gt->divisi ?>	
										</td>
										<td class="small">
											<?php echo $gt->tanggal ?>
										</td>
										<td class="small">
											<?php echo $gt->nama_marketing ?>
										</td>
										<td class="small">
											<?php echo $gt->nama_downline ?>
										</td>
										<td class="small">
											<?php echo $gt->alamat ?>
										</td>
										<td class="small">
											<?php echo $gt->nomor_gt ?>
										</td>
										<td class="small">
											<?php echo $gt->deposit ?>
										</td>
										<td width='180'>
											<a href="<?php echo site_url('direct/downlinegt/edit/'.$gt->id_downline_gt) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('direct/downlinegt/remove/'.$gt->id_downline_gt) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i></a>
											 <a href="<?php echo site_url('direct/downlinegt/detail/'.$gt->id_downline_gt) ?>" 
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
