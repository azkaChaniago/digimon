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
						<h2>Sekolah</h2><hr>
						<a href="<?php echo site_url('direct/sekolah/add') ?>"><i class="fas fa-plus"></i> Add New</a>						
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama TDC</th>
										<th>Kabupaten</th>
										<th>Kecamatan</th>
										<th>Nama Sekolah</th>
										<th>Alamat</th>
										<th>Jumlah Siswa</th>
										<th>Nama Marketing</th>
                                        <th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($sekolah as $s): ?>
									<tr>
										<td>
											<?php echo $s->nama_tdc ?>
										</td>
										<td>
											<?php echo $s->kabupaten ?>	
										</td>
										<td class="small">
											<?php echo $s->kecamatan ?>
										</td>
										<td class="small">
											<?php echo $s->nama_sekolah ?>
										</td>
										<td class="small">
											<?php echo $s->alamat ?>
										</td>
										<td class="small">
											<?php echo $s->jumlah_siswa ?>
										</td>
										<td class="small">
											<?php echo $s->nama_marketing ?>
										</td>
										<td width='180'>
											<a href="<?php echo site_url('direct/sekolah/edit/'.$s->npsn) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('direct/sekolah/remove/'.$s->npsn) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i></a>
											 <a href="<?php echo site_url('direct/sekolah/detail/'.$s->npsn) ?>" 
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
