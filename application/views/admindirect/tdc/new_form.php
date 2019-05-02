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

				<?php #$this->load->view("admin/direct/_parts/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('direct/tdc/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('direct/tdc/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="offset-md-2 col-md-6">
									<div class="form-group">
										<label for="kode_tdc">Kode TDC*</label>
										<input class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>"
										type="text" name="kode_tdc" placeholder="Kode User" />
										<div class="invalid-feedback">
											<?php echo form_error('kode_tdc') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="nama_tdc">Nama TDC*</label>
										<input class="form-control <?php echo form_error('nama_tdc') ? 'is-invalid':'' ?>"
										type="text" name="nama_tdc" placeholder="Nama TDC" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_tdc') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="no_telepon">No Telepon*</label>
										<input class="form-control <?php echo form_error('no_telepon') ? 'is-invalid':'' ?>"
										type="text" name="no_telepon" placeholder="No Telepon" />
										<div class="invalid-feedback">
											<?php echo form_error('no_telepon') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="no_callcenter">No Callcenter*</label>
										<input class="form-control <?php echo form_error('no_callcenter') ? 'is-invalid':'' ?>"
										type="text" name="no_callcenter" placeholder="No Callcenter" />
										<div class="invalid-feedback">
											<?php echo form_error('no_callcenter') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="manager">Nama Manajer*</label>
										<input class="form-control <?php echo form_error('manager') ? 'is-invalid':'' ?>"
										type="text" name="manager" placeholder="Nama Manajer" />
										<div class="invalid-feedback">
											<?php echo form_error('manager') ?>
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

									<input class="btn btn-success" type="submit" name="btn" value="Save" />
								</div>								
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

		<script>
			CKEDITOR.plugins.addExternal('zamanager', '<?php echo base_url('assets/ckeditor/plugins/zamanager') ?>', 'plugin.js');

			CKEDITOR.replace('content');
		</script>

</body>

</html>