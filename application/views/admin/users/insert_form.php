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

				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('admin/users/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/users/add') ?>" method="post" enctype="multipart/form-data">

							<div class="form-group">
								<label for="username">Username*</label>
								<input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
								 type="text" name="username" placeholder="Username"/>
								<div class="invalid-feedback">
									<?php echo form_error('username') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="email">Email Address*</label>
								<input class="form-control <?php echo form_error('user_email') ? 'is-invalid':'' ?>"
								 type="email" name="email" placeholder="user@domain.com"/>
								<div class="invalid-feedback">
									<?php echo form_error('email') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="password">Password*</label>
								<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
								 type="password" name="password" placeholder="Password"/>
								<div class="invalid-feedback">
									<?php echo form_error('password') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="status">Status*</label>
								<input class="form-control <?php echo form_error('status') ? 'is-invalid':'' ?>"
								 type="status" name="status" placeholder="(e.g. superuser, assistant, student)"/>
								<div class="invalid-feedback">
									<?php echo form_error('status') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="user_avatar">User Avatar</label>
								<input class="form-control-file <?php echo form_error('user_avatar') ? 'is-invalid':'' ?>"
								 type="file" name="user_avatar" />
								<input type="hidden" name="old_image"/>
								<div class="invalid-feedback">
									<?php echo form_error('user_avatar') ?>
								</div>
							</div>
                            							

							<input class="btn btn-success" type="submit" name="btn" value="Save" />
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