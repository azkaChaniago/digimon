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

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('direct/saleling/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('direct/saleling/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<!-- <label for="id_saleling">ID Saleling*</label> -->
									<input class="form-control <?php echo form_error('id_saleling') ? 'is-invalid':'' ?>"
									type="hidden" name="id_saleling" placeholder="ID Saleling" value="<?php echo $saleling->id_saleling ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('id_saleling') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="kode_tdc">Nama TDC*</label>
									<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
									name="kode_tdc">
										<option selected="selected">---</option>
										<?php foreach($tdc as $tdc) : ?>
											<option value="<?php echo $tdc->kode_tdc ?>"><?php echo $tdc->nama_tdc ?></option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('kode_tdc') ?>
									</div>								
								</div>

								<div class="form-group">
									<label for="divisi">Divisi*</label>
									<input class="form-control <?php echo form_error('divisi') ? 'is-invalid':'' ?>"
									type="text" name="divisi" placeholder="Divisi" value="<?php echo $saleling->divisi ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('divisi') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="tanggal">Tanggal*</label>
									<input class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>"
									type="date" name="tanggal" placeholder="" value="<?php echo $saleling->tanggal ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('tanggal') ?>
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
									<label for="lokasi_saleling">Lokasi Saleling*</label>
									<input class="form-control <?php echo form_error('lokasi_saleling') ? 'is-invalid':'' ?>"
									type="text" name="lokasi_saleling" placeholder="Lokasi Saleling" value="<?php echo $saleling->lokasi_saleling ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('lokasi_saleling') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="foto_kegiatan">Foto Kegiatan*</label>
									<input class="form-control <?php echo form_error('foto_kegiatan') ? 'is-invalid':'' ?>"
									type="file" name="foto_kegiatan" placeholder="Foto Kegiatan" value="<?php echo $saleling->foto_kegiatan ?>" />
									<input type="hidden" name="old_image" value="<?php echo $saleling->foto_kegiatan ?>"  />
									<div class="invalid-feedback">
										<?php echo form_error('foto_kegiatan') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="kode_user">Nama User*</label>
									<select class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>" 
									name="kode_user">
										<option selected="selected">---</option>
										<?php foreach($user as $user) : ?>
											<option value="<?php echo $user->kode_user ?>"><?php echo $user->nama_user ?></option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('kode_user') ?>
									</div>								
								</div>
							</div>
							</div class="row">
							<div class="row">
							<input class="btn btn-success" type="submit" name="btn" value="Save" value="<?php echo $saleling->id_saleling ?>" />
							</div>
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
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

		<?php $this->load->view("admin/direct/_parts/js.php") ?>

</body>

</html>