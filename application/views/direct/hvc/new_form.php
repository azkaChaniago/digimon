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

				<?php
				// print_r($marketing);
				// echo $error;
				// print_r($error);
				?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('/direct/hvc/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('direct/hvc/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
							<div class="col-md-6">

								<p>Input Data Event</p><hr>
								<div class="form-group">
									<label for="id_hvc">ID Penjualan*</label>
									<input class="form-control <?php echo form_error('id_hvc') ? 'is-invalid':'' ?>"
									type="text" name="id_hvc" placeholder="ID Penjualan" />
									<div class="invalid-feedback">
										<?php echo form_error('id_hvc') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kode_tdc">Nama TDC*</label>
									<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
									name="kode_tdc">
										<option value="" selected="selected">---</option>
										<?php foreach($tdc as $t) : ?>
											<option value="<?php echo $t->kode_tdc ?>"><?php echo $t->nama_tdc ?></option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('kode_tdc') ?>
									</div>								
								</div>

								<div class="form-group">
									<label for="tgl_hvc">Tanggal HVC*</label>
									<input class="form-control <?php echo form_error('tgl_hvc') ? 'is-invalid':'' ?>"
									type="date" name="tgl_hvc" placeholder="Tanggal Penjualan" />
									<div class="invalid-feedback">
										<?php echo form_error('tgl_hvc') ?>
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

								<div class="form-group">
									<label for="nama_mercent">Nama Mercent*</label>
									<input class="form-control <?php echo form_error('nama_mercent') ? 'is-invalid':'' ?>"
									type="text" name="nama_mercent" placeholder="Nama Mercent" />
									<div class="invalid-feedback">
									<?php echo form_error('nama_mercent') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="longlat_lokasi_mercent">Longlat Lokasi Mercent*</label>
									<input class="form-control <?php echo form_error('longlat_lokasi_mercent') ? 'is-invalid':'' ?>"
									type="text" name="longlat_lokasi_mercent" placeholder="Longlat Lokasi Mercent" />
									<div class="invalid-feedback">
										<?php echo form_error('longlat_lokasi_mercent') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="latitude_lokasi_mercent">Latitude Lokasi Mercent*</label>
									<input class="form-control <?php echo form_error('latitude_lokasi_mercent') ? 'is-invalid':'' ?>"
									type="text" name="latitude_lokasi_mercent" placeholder="Latitude Lokasi Mercent" />
									<div class="invalid-feedback">
										<?php echo form_error('latitude_lokasi_mercent') ?>
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
									<label for="foto_kegiatan">Keterangan Kegiatan*</label>
									<input class="form-control <?php echo form_error('foto_kegiatan') ? 'is-invalid':'' ?>"
									type="file" name="foto_kegiatan" placeholder="Keterangan Kegiatan" />
									<div class="invalid-feedback">
										<?php echo form_error('foto_kegiatan') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="keterangan_kegiatan">Keterangan Kegiatan*</label>
									<input class="form-control <?php echo form_error('keterangan_kegiatan') ? 'is-invalid':'' ?>"
									type="text" name="keterangan_kegiatan" placeholder="Keterangan Kegiatan" />
									<div class="invalid-feedback">
										<?php echo form_error('keterangan_kegiatan') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="kode_user">Nama User*</label>
									<select class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>" 
									name="kode_user">
										<option selected="selected">---</option>
										<?php foreach($user as $us) : ?>
											<option value="<?php echo $us->kode_user ?>"><?php echo $us->nama_user ?></option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('kode_user') ?>
									</div>								
								</div>
							</div>

							<div class="col-md-6">
								<p>QTY</p><hr>
								<div class="row">								
									<div class="col-sm-6">
										<div class="form-group">
											<label for="qty_5k">QTY 5k*</label>
											<input class="form-control <?php echo form_error('qty_5k') ? 'is-invalid':'' ?>"
											type="text" name="qty_5k" placeholder="QTY 5k" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_5k') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="qty_10k">QTY 10k*</label>
											<input class="form-control <?php echo form_error('qty_10k') ? 'is-invalid':'' ?>"
											type="text" name="qty_10k" placeholder="QTY 10k" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_10k') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="qty_20k">QTY 20k*</label>
											<input class="form-control <?php echo form_error('qty_20k') ? 'is-invalid':'' ?>"
											type="text" name="qty_20k" placeholder="QTY 25k" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_20k') ?>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="qty_25k">QTY 25k*</label>
											<input class="form-control <?php echo form_error('qty_25k') ? 'is-invalid':'' ?>"
											type="text" name="qty_25k" placeholder="QTY2 5k" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_25k') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="qty_50k">QTY 50k*</label>
											<input class="form-control <?php echo form_error('qty_50k') ? 'is-invalid':'' ?>"
											type="text" name="qty_50k" placeholder="QTY 50k" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_50k') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="qty_100k">QTY 100k*</label>
											<input class="form-control <?php echo form_error('qty_100k') ? 'is-invalid':'' ?>"
											type="text" name="qty_100k" placeholder="QTY 100k" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_100k') ?>
											</div>
										</div>
									</div>
								</div>
								<p>Mount</p><hr>
								<div class="row">								
									<div class="col-sm-12">
										<div class="form-group">
											<label for="mount_bulk">Mount Bulk*</label>
											<input class="form-control uang <?php echo form_error('mount_bulk') ? 'is-invalid':'' ?>"
											type="text" name="mount_bulk" placeholder="Mount Bulk" />
											<div class="invalid-feedback">
												<?php echo form_error('mount_bulk') ?>
											</div>
										</div>
									</div>
								</div>
								
								<p>QTY NSB</p><hr>
								<div class="row">								
									<div class="col-sm-6">
										<div class="form-group">
											<label for="qty_low_nsb">QTY Low NSB*</label>
											<input class="form-control <?php echo form_error('qty_low_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_low_nsb" placeholder="QTY Low NSB" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_low_nsb') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="qty_middle_nsb">QTY Middle NSB*</label>
											<input class="form-control <?php echo form_error('qty_middle_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_middle_nsb" placeholder="QTY Middle NSB" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_middle_nsb') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="qty_high_nsb">QTY High NSB*</label>
											<input class="form-control <?php echo form_error('qty_high_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_high_nsb" placeholder="QTY High NSB" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_high_nsb') ?>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
									<div class="form-group">
											<label for="qty_as_nsb">QTY AS NSB*</label>
											<input class="form-control <?php echo form_error('qty_as_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_as_nsb" placeholder="QTY AS NSB" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_as_nsb') ?>
											</div>
										</div>
										<!-- <div class="form-group">
											<label for="qty_simpati_nsb">QTY Simpati NSB*</label>
											<input class="form-control <?php echo form_error('qty_simpati_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_simpati_nsb" placeholder="QTY Simpati NSB" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_simpati_nsb') ?>
											</div>
										</div> -->
										<div class="form-group">
											<label for="qty_loop_nsb">QTY Loop NSB*</label>
											<input class="form-control <?php echo form_error('qty_loop_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_loop_nsb" placeholder="QTY Loop NSB" onkeypress="return isNumberKey(event)" />
											<div class="invalid-feedback">
												<?php echo form_error('qty_loop_nsb') ?>
											</div>
										</div>
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