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

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<?php if (isset($error)): ?>
				<div class="alert alert-error" role="alert">
					<?php echo $error; ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('/direct/sekolah/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('direct/sekolah/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-6">								
									<!-- <div class="form-group">
										<label for="npsn">NPSN*</label> -->
										<input class="form-control <?php echo form_error('npsn') ? 'is-invalid':'' ?>"
										type="hidden" name="npsn" value="<?php echo $sekolah->npsn ?>" placeholder="NPSN" />
										<div class="invalid-feedback">
											<?php echo form_error('npsn') ?>
										</div>
									<!-- </div> -->
									
									<div class="form-group">
										<label for="kode_tdc">Nama TDC*</label>
										<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
										name="kode_tdc">
											<option selected="selected">---</option>
											<?php foreach($tdc as $t) : ?>
												<option value="<?php echo $t->kode_tdc ?>"><?php echo $t->nama_tdc ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_tdc') ?>
										</div>								
									</div>

									<div class="form-group">
										<label for="kabupaten">Kabupaten*</label>
										<input class="form-control <?php echo form_error('kabupaten') ? 'is-invalid':'' ?>"
										type="text" name="kabupaten" placeholder="Kabupaten" value="<?php echo $sekolah->kabupaten ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('kabupaten') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="kecamatan">Kecamatan*</label>
										<input class="form-control <?php echo form_error('kecamatan') ? 'is-invalid':'' ?>"
										type="text" name="kecamatan" placeholder="Kecamatan" value="<?php echo $sekolah->kecamatan ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('kecamatan') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="nama_sekolah">Nama Sekolah*</label>
										<input class="form-control <?php echo form_error('nama_sekolah') ? 'is-invalid':'' ?>"
										type="text" name="nama_sekolah" placeholder="Nama Sekolah" value="<?php echo $sekolah->nama_sekolah ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('nama_sekolah') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="alamat">Alamat*</label>
										<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
										type="text" name="alamat" placeholder="Alamat" value="<?php echo $sekolah->alamat ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('alamat') ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="jumlah_siswa">Jumlah Siswa*</label>
										<input class="form-control <?php echo form_error('jumlah_siswa') ? 'is-invalid':'' ?>"
										type="text" name="jumlah_siswa" placeholder="Jumlah Siswa" value="<?php echo $sekolah->jumlah_siswa ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('jumlah_siswa') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="latitude">Latitude*</label>
										<input class="form-control <?php echo form_error('latitude') ? 'is-invalid':'' ?>"
										type="text" name="latitude" placeholder="Latitude" value="<?php echo $sekolah->latitude ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('latitude') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="longtitude">Longtitude*</label>
										<input class="form-control <?php echo form_error('longtitude') ? 'is-invalid':'' ?>"
										type="text" name="longtitude" placeholder="Longtitude" value="<?php echo $sekolah->longtitude ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('longtitude') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="kode_marketing">Nama Canvasser*</label>
										<select class="form-control <?php echo form_error('kode_marketing') ? 'is-invalid':'' ?>" 
										name="kode_marketing">
											<option selected="selected">---</option>
											<?php foreach($marketing as $mar) : ?>
												<option value="<?php echo $mar->kode_marketing ?>"><?php echo $mar->nama_marketing ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_marketing') ?>
										</div>								
									</div>

									<div class="form-group">
										<label for="kode_user">Nama User*</label>
										<select class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>" 
										name="kode_user">
											<option selected="selected">---</option>
											<?php foreach($user as $u) : ?>
												<option value="<?php echo $u->kode_user ?>"><?php echo $u->nama_user ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_user') ?>
										</div>								
									</div>
								</div>

							</div class="row">
							<div class="row">
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
							</div>
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

</body>

</html>