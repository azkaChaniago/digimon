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

				<?php #$this->load->view("admin/_parts/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/superuser/outlet/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/superuser/outlet/add') ?>" method="post" enctype="multipart/form-data" >
							<input class="form-control <?php echo form_error('id_outlet') ? 'is-invalid':'' ?>"
							type="hidden" name="id_outlet" placeholder="Nama id_outlet" value="<?php echo $outlet->id_outlet; ?>"/>
							<div class="invalid-feedback">
								<?php echo form_error('id_outlet') ?>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="kabupaten">Kabupaten*</label>
										<input class="form-control <?php echo form_error('kabupaten') ? 'is-invalid':'' ?>"
										type="text" name="kabupaten" placeholder="Nama Kabupaten" value="<?php echo $outlet->kabupaten; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('kabupaten') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="kecamatan">Kecamatan*</label>
										<input class="form-control <?php echo form_error('kecamatan') ? 'is-invalid':'' ?>"
										type="text" name="kecamatan" placeholder="Nama Kecamatan" value="<?php echo $outlet->kecamatan; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('kecamatan') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="nama_outlet">Nama Outlet*</label>
										<input class="form-control <?php echo form_error('nama_outlet') ? 'is-invalid':'' ?>"
										type="text" name="nama_outlet" placeholder="Nama Outlet" value="<?php echo $outlet->nama_outlet; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('nama_outlet') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="alamat">Alamat*</label>
										<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
										type="text" name="alamat" placeholder="Alamat" value="<?php echo $outlet->alamat; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('alamat') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="nama_pemilik">Nama Pemilik*</label>
										<input class="form-control <?php echo form_error('nama_pemilik') ? 'is-invalid':'' ?>"
										type="text" name="nama_pemilik" placeholder="Nama Pemilik" value="<?php echo $outlet->nama_pemilik; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('nama_pemilik') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="no_hp">Nomor HP*</label>
										<input class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>"
										type="text" name="no_hp" placeholder="Nomor HP" value="<?php echo $outlet->no_hp; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('no_hp') ?>
										</div>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="kode_marketing">Nama Canvasser*</label>
										<select class="form-control <?php echo form_error('kode_marketing') ? 'is-invalid':'' ?>" 
										name="kode_marketing">
											<option selected="selected">---</option>
											<?php foreach($marketing as $mar) : ?>
												<option value="<?php echo $mar->kode_marketing ?>" <?php if ($mar->kode_marketing == $outlet->kode_marketing) { echo "selected";} ?>><?php echo $mar->nama_marketing ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_marketing') ?>
										</div>										
									</div>
									<div class="form-group">
										<label for="hari_kunjungan">Hari Kunjungan*</label>
										<input class="form-control <?php echo form_error('hari_kunjungan') ? 'is-invalid':'' ?>"
										type="text" name="hari_kunjungan" placeholder="Hari Kunjungan" value="<?php echo $outlet->hari_kunjungan; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('hari_kunjungan') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="nomor_rs">Nomor RS*</label>
										<input class="form-control <?php echo form_error('nomor_rs') ? 'is-invalid':'' ?>"
										type="text" name="nomor_rs" placeholder="Nomor RS" value="<?php echo $outlet->nomor_rs; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('nomor_rs') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="kode_tdc">Nama TDC*</label>
										<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
										name="kode_tdc">
											<option selected="selected">---</option>
											<?php foreach($tdc as $tdc) : ?>
												<option value="<?php echo $tdc->kode_tdc ?>" <?php if ($tdc->kode_tdc == $outlet->kode_tdc) { echo "selected";} ?>><?php echo $tdc->nama_tdc ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_tdc') ?>
										</div>										
									</div>

									<div class="form-group">
										<label for="kategori_outlet">Kategori Outlet*</label>
										<input class="form-control <?php echo form_error('kategori_outlet') ? 'is-invalid':'' ?>"
										type="text" name="kategori_outlet" placeholder="Kategori Outlet" value="<?php echo $outlet->kategori_outlet; ?>"/>
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

									<!-- <div class="form-group">
										<label for="kode_user">Nama User*</label>
										<select class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>" 
										name="kode_user">
											<option selected="selected">---</option>
											<?php foreach($user as $u) : ?>
												<option value="<?php echo $u->kode_user ?>" ><?php echo $u->nama_user ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_user') ?>
										</div>										
									</div> -->
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
				<?php $this->load->view("admin/_parts/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_parts/scrolltop.php") ?>

		<?php $this->load->view("admin/_parts/js.php") ?>

		<script>
			CKEDITOR.plugins.addExternal('zamanager', '<?php echo base_url('assets/ckeditor/plugins/zamanager') ?>', 'plugin.js');

			CKEDITOR.replace('content');
		</script>

</body>

</html>