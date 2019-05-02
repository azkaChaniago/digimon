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
						<a href="<?php echo site_url('admin/direct/marketing/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/direct/marketing/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
							<div class="offset-md-2 col-md-6">
									<div class="form-group">
										
										<input class="form-control <?php echo form_error('kode_marketing') ? 'is-invalid':'' ?>"
										type="hidden" name="kode_marketing" placeholder="Kode Marketing" value="<?php echo $marketing->kode_marketing; ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('kode_marketing') ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="nama_marketing">Nama Marketing*</label>
										<input class="form-control <?php echo form_error('nama_marketing') ? 'is-invalid':'' ?>"
										type="text" name="nama_marketing" placeholder="Nama Marketing" value="<?php echo $marketing->nama_marketing; ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_marketing') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="kode_tdc">Nama TDC*</label>
										<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
										name="kode_tdc">
											<option selected="selected">---</option>
											<?php foreach($related as $rel) : ?>
												<option value="<?php echo $rel->kode_tdc ?>"><?php echo $rel->nama_tdc ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_tdc') ?>
										</div>										
									</div>
									
									<div class="form-group">
										<label for="divisi">Divisi*</label>
										<select class="form-control <?php echo form_error('divisi') ? 'is-invalid':'' ?>" 
										name="divisi">
											<option value="" selected>---</option>
											<option value="administrator">Administrator</option>
											<option value="direct">Direct</option>
											<option value="indirect">Indirect</option>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('divisi') ?>
										</div>										
									</div>
									
									<div class="form-group">
										<label for="mkios">MKIOS*</label>
										<input class="form-control <?php echo form_error('mkios') ? 'is-invalid':'' ?>"
										type="text" name="mkios" placeholder="MKIOS" value="<?php echo $marketing->mkios; ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('mkios') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="no_hp">No HP*</label>
										<input class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>"
										type="text" name="no_hp" placeholder="No HP" value="<?php echo $marketing->no_hp; ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('no_hp') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="alamat">Alamat*</label>
										<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
										type="text" name="alamat" placeholder="Alamat" value="<?php echo $marketing->alamat; ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('alamat') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="email">Email*</label>
										<input class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
										type="email" name="email" placeholder="Email" value="<?php echo $marketing->email; ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('email') ?>
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