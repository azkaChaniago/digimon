<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_parts/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<h2>Target Assignment</h2><hr>
						<a href="<?php echo site_url('admin/historiorder/add') ?>"><i class="fas fa-plus"></i> Add New</a>						
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Nama Canvasser</th>
										<th>Nama Outlet</th>
										<th>AS</th>
										<th>Simpati</th>
										<th>Loop</th>
										<th>NSB</th>
										<th>MKIOS Regular</th>
                                        <th>MKIOS Bulk</th>
										<th>GT Pulsa</th>
                                        <th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($histori as $hist): ?>
									<tr>
										<td>
											<?php echo $hist->tanggal ?>
										</td>
										<td>
											<?php echo $hist->nama_marketing ?>	
										</td>
										<td class="small">
											<?php echo $hist->nama_outlet ?>
										</td>
										<td class="small">
											<?php echo $hist->as ?>
										</td>
										<td class="small">
											<?php echo $hist->simpati ?>
										</td>
										<td class="small">
											<?php echo $hist->loop ?>
										</td>
										<td class="small">
											<?php echo $hist->nsb ?>
										</td>
										<td class="small">
											<?php echo $hist->mkios_reguler ?>
										</td>
                                        <td class="small">
											<?php echo $hist->mkios_bulk ?>
										</td>
										<td class="small">
											<?php echo $hist->gt_pulsa ?>
										</td>
										<td width='180'>
											<a href="<?php echo site_url('admin/historiorder/edit/'.$hist->id_histori_order) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/historiorder/delete/'.$hist->id_histori_order) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i></a>
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
			<?php $this->load->view("admin/_parts/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/_parts/modal.php") ?>

	<?php $this->load->view("admin/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
