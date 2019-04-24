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
				<?php if (isset($error)): ?>
				<div class="alert alert-error" role="alert">
					<?php echo $error; ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('/direct/mercent/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('direct/mercent/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-6">
								
									<div class="form-group">
										<label for="id_mercent">ID Mercent*</label>
										<input class="form-control <?php echo form_error('id_mercent') ? 'is-invalid':'' ?>"
										type="text" name="id_mercent" placeholder="ID Mercent" />
										<div class="invalid-feedback">
											<?php echo form_error('id_mercent') ?>
										</div>
									</div>
									
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
										<label for="nama_mercent">Nama Mercent*</label>
										<input class="form-control <?php echo form_error('nama_mercent') ? 'is-invalid':'' ?>"
										type="text" name="nama_mercent" placeholder="Nama Mercent" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_mercent') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="nama_pic">Nama Pic*</label>
										<input class="form-control <?php echo form_error('nama_pic') ? 'is-invalid':'' ?>"
										type="text" name="nama_pic" placeholder="Nama Pic" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_pic') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="no_hp_pic">No HP Pic*</label>
										<input class="form-control <?php echo form_error('no_hp_pic') ? 'is-invalid':'' ?>"
										type="text" name="no_hp_pic" placeholder="No HP Pic" />
										<div class="invalid-feedback">
											<?php echo form_error('no_hp_pic') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="no_ktp">No KTP*</label>
										<input class="form-control <?php echo form_error('no_ktp') ? 'is-invalid':'' ?>"
										type="text" name="no_ktp" placeholder="No KTP" />
										<div class="invalid-feedback">
											<?php echo form_error('no_ktp') ?>
										</div>
									</div>
								</div>

								<div class="col-md-6">									
									<div class="form-group">
										<label for="npwp">NPWP*</label>
										<input class="form-control <?php echo form_error('npwp') ? 'is-invalid':'' ?>"
										type="text" name="npwp" placeholder="NPWP" />
										<div class="invalid-feedback">
											<?php echo form_error('npwp') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="longtitude">Longtitude*</label>
										<input class="form-control <?php echo form_error('longtitude') ? 'is-invalid':'' ?>"
										type="text" name="longtitude" placeholder="Longtitude" />
										<div class="invalid-feedback">
											<?php echo form_error('longtitude') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="latitude">Latitude*</label>
										<input class="form-control <?php echo form_error('latitude') ? 'is-invalid':'' ?>"
										type="text" name="latitude" placeholder="Latitude" />
										<div class="invalid-feedback">
											<?php echo form_error('latitude') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="alamat">Alamat*</label>
										<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
										type="text" name="alamat" placeholder="Alamat" />
										<div class="invalid-feedback">
											<?php echo form_error('alamat') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="produk_diajukan">Produk Diajukan*</label>
										<input class="form-control <?php echo form_error('produk_diajukan') ? 'is-invalid':'' ?>"
										type="text" name="produk_diajukan" placeholder="Produk Diajukan" />
										<div class="invalid-feedback">
											<?php echo form_error('produk_diajukan') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="foto_mercent">Foto Mercent*</label>
										<input class="form-control <?php echo form_error('foto_mercent') ? 'is-invalid':'' ?>"
										type="file" name="foto_mercent" placeholder="Foto Mercent" />
										<div class="invalid-feedback">
											<?php echo form_error('foto_mercent') ?>
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
				<?php $this->load->view("admin/direct/_parts/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/direct/_parts/scrolltop.php") ?>

		<?php $this->load->view("admin/direct/_parts/js.php") ?>

</body>

</html>