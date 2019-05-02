<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("direct/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("direct/_parts/navbar.php") ?>
	<?php $this->load->view("direct/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">
			<?php if ($this->session->userdata('errors')) :?>
				<div>
					<?php echo $this->session->userdata('errors')  ?>
				</div>
			<?php endif;?>
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('direct/hvc') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('direct/hvc/edit') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<div class="row">
							<div class="col-md-6">													
								<div class="form-group form-float">
									<select class="form-control show-tick" 
									name="kode_tdc" data-live-search="true">
										<option value="">--- PILIH TDC ---</option>
										<?php foreach($tdc as $t) : ?>
											<option value="<?php echo $t->kode_tdc ?>" <?= $t->kode_tdc == $hvc->kode_tdc ? "selected" : "" ?>><?php echo $t->nama_tdc ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group form-float">
									<div class="form-line" id="bs_datepicker_container">
										<input class="form-control" type="text" name="tgl_hvc" value="<?= date('d/m/Y', strtotime($hvc->tgl_hvc)) ?>" required/>
										<label class="form-label" for="tgl_hvc">Tanggal HVC</label>
									</div>
								</div>

								<div class="form-group form-float">
									<select class="form-control show-tick" 
									name="kode_marketing" data-live-search="true">
										<option value="">--- PILIH MARKETING ---</option>
										<?php foreach($marketing as $m) : ?>
											<option value="<?php echo $m->kode_marketing ?>" <?= $m->kode_marketing == $hvc->kode_marketing ? "selected" : "" ?> ><?php echo $m->nama_marketing ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_mercent" value="<?= $hvc->nama_mercent ?>" required/>
										<label class="form-label" for="nama_mercent">Nama Mercent*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="longlat_lokasi_mercent" value="<?= $hvc->longlat_lokasi_mercent ?>" required/>
										<label class="form-label" for="longlat_lokasi_mercent">Longlat LokasiM ercent*</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="latitude_lokasi_mercent" value="<?= $hvc->latitude_lokasi_mercent ?>" required/>
										<label class="form-label" for="latitude_lokasi_mercent">Latitude LokasiM ercent*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="alamat" value="<?= $hvc->alamat ?>" required/>
										<label class="form-label" for="alamat">Alamat*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="keterangan_kegiatan" value="<?= $hvc->keterangan_kegiatan ?>" required/>
										<label class="form-label" for="keterangan_kegiatan">Keterangan Kunjungan*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control" type="file" name="foto_kegiatan[]" multiple/>
									</div>
								</div>
								<input type="hidden" name="old_image" value="<?= htmlspecialchars($hvc->foto_kegiatan) ?>">

							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<h3>MKIOS</h3>
								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control <?php echo form_error('qty_5k') ? 'is-invalid':'' ?>"
										type="text" name="qty_5k" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_5k ?>" required/>
										<label class="form-label" for="qty_5k">QTY 5K*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control <?php echo form_error('qty_10k') ? 'is-invalid':'' ?>"
										type="text" name="qty_10k" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_10k ?>" required/>
										<label class="form-label" for="qty_10k">QTY 10K*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control <?php echo form_error('qty_20k') ? 'is-invalid':'' ?>"
										type="text" name="qty_20k" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_20k ?>" required/>
										<label class="form-label" for="qty_20k">QTY 20K*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control <?php echo form_error('qty_25k') ? 'is-invalid':'' ?>"
										type="text" name="qty_25k" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_25k ?>" required/>
										<label class="form-label" for="qty_25k">QTY 25K*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control <?php echo form_error('qty_50k') ? 'is-invalid':'' ?>"
										type="text" name="qty_50k" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_50k ?>" required/>
										<label class="form-label" for="qty_50k">QTY 50K*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control <?php echo form_error('qty_100k') ? 'is-invalid':'' ?>"
										type="text" name="qty_100k" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_100k ?>" required/>
										<label class="form-label" for="qty_100k">QTY 100K*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('mount_bulk') ? 'is-invalid':'' ?>"
											type="text" name="mount_bulk" onkeypress="return isNumberKey(event)" value="<?= $hvc->mount_bulk ?>" required/>
										<label class="form-label" for="mount_bulk">Mount Bulk*</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<h3>NSB</h3>
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('qty_low_nsb') ? 'is-invalid':'' ?>" type="text" name="qty_low_nsb" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_low_nsb ?>" required/>
										<label class="form-label" for="qty_low_nsb">QTY Low NSB*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('qty_middle_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_middle_nsb" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_middle_nsb ?>" required/>
										<label class="form-label" for="qty_middle_nsb">QTY Middle NSB*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('qty_high_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_high_nsb" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_high_nsb ?>" required/>
										<label class="form-label" for="qty_high_nsb">QTY High NSB*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('qty_as_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_as_nsb" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_as_nsb ?>" required/>
										<label class="form-label" for="qty_as_nsb">QTY AS NSB*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('qty_simpati_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_simpati_nsb" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_simpati_nsb ?>" required/>
										<label class="form-label" for="qty_simpati_nsb">QTY Simpati NSB*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control <?php echo form_error('qty_loop_nsb') ? 'is-invalid':'' ?>"
											type="text" name="qty_loop_nsb" onkeypress="return isNumberKey(event)" value="<?= $hvc->qty_loop_nsb ?>" required/>
										<label class="form-label" for="qty_loop_nsb">QTY Loop NSB*</label>
									</div>
								</div>
							</div>
						</div>

						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
					</form>

				</div>

			</div>
			
		</div>
		<!-- /.container-fluid -->
	</section>
	<?php $this->load->view("direct/_parts/modal.php") ?>
	<?php $this->load->view("direct/_parts/js.php") ?>
</body>
</html>
