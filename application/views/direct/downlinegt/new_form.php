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
						<a href="<?php echo site_url('direct/downlinegt/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('direct/downlinegt/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="id_downline_gt">ID Downline GT*</label>
									<input class="form-control <?php echo form_error('id_downline_gt') ? 'is-invalid':'' ?>"
									type="text" name="id_downline_gt" placeholder="ID Downline GT" />
									<div class="invalid-feedback">
										<?php echo form_error('id_downline_gt') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="kode_tdc">Nama TDC*</label>
									<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
									name="kode_tdc">
										<option value="" selected="selected">---</option>
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
									type="text" name="divisi" placeholder="" />
									<div class="invalid-feedback">
										<?php echo form_error('divisi') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="tanggal">Tanggal*</label>
									<input class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>"
									type="date" name="tanggal" placeholder="" />
									<div class="invalid-feedback">
										<?php echo form_error('tanggal') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kode_marketing">Nama Canvasser*</label>
									<select class="form-control <?php echo form_error('kode_marketing') ? 'is-invalid':'' ?>" 
									name="kode_marketing">
										<option value="" selected="selected">---</option>
										<?php foreach($marketing as $mar) : ?>
											<option value="<?php echo $mar->kode_marketing ?>"><?php echo $mar->nama_marketing ?></option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('kode_marketing') ?>
									</div>								
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="alamat">Alamat*</label>
									<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
									type="text" name="alamat" placeholder="Alamat" />
									<div class="invalid-feedback">
										<?php echo form_error('alamat') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="nama_downline">Nama Downline*</label>
									<input class="form-control <?php echo form_error('nama_downline') ? 'is-invalid':'' ?>"
									type="text" name="nama_downline" placeholder="Nama Downline" />
									<div class="invalid-feedback">
										<?php echo form_error('nama_downline') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="nomor_gt">Nomor GT*</label>
									<input class="form-control <?php echo form_error('nomor_gt') ? 'is-invalid':'' ?>"
									type="text" name="nomor_gt" placeholder="Nomor GT" />
									<div class="invalid-feedback">
										<?php echo form_error('nomor_gt') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="deposit">Deposit*</label>
									<input class="form-control <?php echo form_error('deposit') ? 'is-invalid':'' ?>"
									type="text" name="deposit" placeholder="Deposit" />
									<div class="invalid-feedback">
										<?php echo form_error('deposit') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="foto">Foto Kegiatan*</label>
									<input class="form-control <?php echo form_error('foto') ? 'is-invalid':'' ?>"
									type="file" name="foto" placeholder="Foto Kegiatan" />
									<div class="invalid-feedback">
										<?php echo form_error('foto') ?>
									</div>
								</div>
								<!-- <div class="form-group">
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
								</div> -->
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
				<?php $this->load->view("admin/direct/_parts/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/direct/_parts/scrolltop.php") ?>

		<?php $this->load->view("admin/direct/_parts/js.php") ?>

</body>

</html>