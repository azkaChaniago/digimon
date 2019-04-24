<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("indirect/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("indirect/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("indirect/_parts/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('posts/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

                    <form action="<?php base_url('coverage/add') ?>" method="post" enctype="multipart/form-data" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="kabupaten">Kabupaten*</label>
									<input class="form-control <?php echo form_error('kabupaten') ? 'is-invalid':'' ?>"
									type="text" name="kabupaten" placeholder="Nama Kabupaten" value="<?php echo $coverage->kabupaten; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('kabupaten') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="kecamatan">Kecamatan*</label>
									<input class="form-control <?php echo form_error('kecamatan') ? 'is-invalid':'' ?>"
									type="text" name="kecamatan" placeholder="Nama Kecamatan" value="<?php echo $coverage->kecamatan; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('kecamatan') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="nama_outlet">Nama Outlet*</label>
									<input class="form-control <?php echo form_error('nama_outlet') ? 'is-invalid':'' ?>"
									type="text" name="nama_outlet" placeholder="Nama Outlet" value="<?php echo $coverage->nama_outlet; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('nama_outlet') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="alamat">Alamat*</label>
									<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
									type="text" name="alamat" placeholder="Alamat" value="<?php echo $coverage->alamat; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('alamat') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="nama_pemilik">Nama Pemilik*</label>
									<input class="form-control <?php echo form_error('nama_pemilik') ? 'is-invalid':'' ?>"
									type="text" name="nama_pemilik" placeholder="Nama Pemilik" value="<?php echo $coverage->nama_pemilik; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('nama_pemilik') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="no_hp">Nomor HP*</label>
									<input class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>"
									type="text" name="no_hp" placeholder="Nomor HP" value="<?php echo $coverage->no_hp; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('no_hp') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kode_tdc">Nama Canvasser*</label>
									<input class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>"
									type="text" name="kode_tdc" placeholder="Nama Canvasser" value="<?php echo $coverage->kode_tdc; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('kode_tdc') ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="hari_kunjungan">Hari Kunjungan*</label>
									<input class="form-control <?php echo form_error('hari_kunjungan') ? 'is-invalid':'' ?>"
									type="text" name="hari_kunjungan" placeholder="Hari Kunjungan" value="<?php echo $coverage->hari_kunjungan; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('hari_kunjungan') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="nomor_rs">Nomor RS*</label>
									<input class="form-control <?php echo form_error('nomor_rs') ? 'is-invalid':'' ?>"
									type="text" name="nomor_rs" placeholder="Nomor RS" value="<?php echo $coverage->nomor_rs; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('nomor_rs') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kode_tdc">TDC*</label>
									<input class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>"
									type="text" name="kode_tdc" placeholder="TDC" value="<?php echo $coverage->kode_tdc; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('kode_tdc') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kategori_outlet">Kategori Outlet*</label>
									<input class="form-control <?php echo form_error('kategori_outlet') ? 'is-invalid':'' ?>"
									type="text" name="kategori_outlet" placeholder="Kategori Outlet" value="<?php echo $coverage->kategori_outlet; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('kategori_outlet') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="galeri_foto">Galeri Foto</label>
									<input class="form-control <?php echo form_error('galeri_foto') ? 'is-invalid':'' ?>"
									type="file" name="galeri_foto" />
									<div class="invalid-feedback">
										<?php echo form_error('galeri_foto') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kode_user">Kode User*</label>
									<input class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>"
									type="text" name="kode_user" placeholder="Kode User" value="<?php echo $coverage->kode_user; ?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('kode_user') ?>
									</div>
								</div>
							</div>
						</div>
						<input class="btn btn-success" type="submit" name="btn" value="Save"/>
					</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("indirect/_parts/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<?php $this->load->view("indirect/_parts/scrolltop.php") ?>

		<?php $this->load->view("indirect/_parts/js.php") ?>

</body>

</html>
