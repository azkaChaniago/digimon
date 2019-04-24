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
						<a href="<?php echo site_url('admin/superuser/user/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/superuser/user/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="offset-md-2 col-md-6">
									<!-- <div class="form-group">
										<label for="kode_user">Kode User*</label>
										<input class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>"
										type="hidden" name="kode_user" placeholder="Kode User" value="<?php echo $user->kode_user ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('kode_user') ?>
										</div>
									</div> -->
									
									<div class="form-group">
										<label for="nama_user">Nama User*</label>
										<input class="form-control <?php echo form_error('nama_user') ? 'is-invalid':'' ?>"
										type="text" name="nama_user" placeholder="Nama User" value="<?php echo $user->nama_user ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_user') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="kode_tdc">Nama TDC*</label>
										<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
										name="kode_tdc">
											<!-- <option selected="selected">---</option> -->
											<?php foreach($tdc as $t) : ?>
												<option value="<?php echo $t->kode_tdc ?>" <?php if ($t->kode_tdc == $user->kode_tdc) { echo "selected";} ?>><?php echo $t->nama_tdc ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_tdc') ?>
										</div>										
									</div>
									
									<div class="form-group">
										<label for="level">Level*</label>
										<select class="form-control <?php echo form_error('level') ? 'is-invalid':'' ?>" 
										name="level">
											<!-- <option value="" selected>---</option> -->
											<option value="administrator" <?php if ($user->level == "administrator") { echo "selected";} ?>>Administrator</option>
											<option value="direct" <?php if ($user->level == "direct") { echo "selected";} ?>>Direct</option>
											<option value="indirect" <?php if ($user->level == "indirect") { echo "selected";} ?>>Indirect</option>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('level') ?>
										</div>										
									</div>
									
									<div class="form-group">
										<label for="password">Password User*</label>
										<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
										type="password" name="password" placeholder="Password User" value="<?php echo $user->password ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('password') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="password-repeat">Password Repeat*</label>
										<input class="form-control <?php echo form_error('password-repeat') ? 'is-invalid':'' ?>"
										type="password" name="password-repeat" placeholder="Password Repeat" value="<?php echo $user->password ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('password-repeat') ?>
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