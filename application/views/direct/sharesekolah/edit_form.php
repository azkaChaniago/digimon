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
									<div class="form-group">
										<label for="id_market">ID Market*</label>
										<input class="form-control <?php echo form_error('id_market') ? 'is-invalid':'' ?>"
										type="text" name="id_market" placeholder="ID Market" />
										<div class="invalid-feedback">
											<?php echo form_error('id_market') ?>
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
										<label for="npsn">NPSN*</label>
										<select class="form-control <?php echo form_error('npsn') ? 'is-invalid':'' ?>" 
										name="npsn">
											<option selected="selected">---</option>
											<?php foreach($sekolah as $s) : ?>
												<option value="<?php echo $s->npsn ?>"><?php echo $s->nama_sekolah ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('npsn') ?>
										</div>								
									</div>

									<div class="form-group">
										<label for="tgl_marketshare">Tanggal Marketshare*</label>
										<input class="form-control <?php echo form_error('tgl_marketshare') ? 'is-invalid':'' ?>"
										type="date" name="tgl_marketshare" placeholder="Tanggal Marketshare" />
										<div class="invalid-feedback">
											<?php echo form_error('tgl_marketshare') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="qty_simpati">QTY Simpati*</label>
										<input class="form-control <?php echo form_error('qty_simpati') ? 'is-invalid':'' ?>"
										type="text" name="qty_simpati" placeholder="QTY Simpati" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_simpati') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="qty_as">QTY AS*</label>
										<input class="form-control <?php echo form_error('qty_as') ? 'is-invalid':'' ?>"
										type="text" name="qty_as" placeholder="QTY AS" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_as') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="qty_loop">QTY Loop*</label>
										<input class="form-control <?php echo form_error('qty_loop') ? 'is-invalid':'' ?>"
										type="text" name="qty_loop" placeholder="QTY Loop" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_loop') ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="qty_mentari">QTY Mentari*</label>
										<input class="form-control <?php echo form_error('qty_mentari') ? 'is-invalid':'' ?>"
										type="text" name="qty_mentari" placeholder="QTY Mentari" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_mentari') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="qty_im3">QTY IM3*</label>
										<input class="form-control <?php echo form_error('qty_im3') ? 'is-invalid':'' ?>"
										type="text" name="qty_im3" placeholder="QTY IM3" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_im3') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="qty_xl">QTY XL*</label>
										<input class="form-control <?php echo form_error('qty_xl') ? 'is-invalid':'' ?>"
										type="text" name="qty_xl" placeholder="QTY XL" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_xl') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="qty_axsis">QTY Axsis*</label>
										<input class="form-control <?php echo form_error('qty_axsis') ? 'is-invalid':'' ?>"
										type="text" name="qty_axsis" placeholder="QTY Axsis" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_axsis') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="qty_tri">QTY Tri*</label>
										<input class="form-control <?php echo form_error('qty_tri') ? 'is-invalid':'' ?>"
										type="text" name="qty_tri" placeholder="QTY Tri" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_tri') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="qty_smartfrend">QTY Smartfrend*</label>
										<input class="form-control <?php echo form_error('qty_smartfrend') ? 'is-invalid':'' ?>"
										type="text" name="qty_smartfrend" placeholder="QTY Smartfrend" />
										<div class="invalid-feedback">
											<?php echo form_error('qty_smartfrend') ?>
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