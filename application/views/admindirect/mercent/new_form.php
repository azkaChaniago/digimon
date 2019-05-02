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
					<h2><a href="<?php echo site_url('direct/mercent') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('direct/mercent/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-float">
									<select class="form-control show-tick" 
									name="kode_tdc" data-live-search="true">
										<option value="">--- PILIH TDC ---</option>
										<?php foreach($tdc as $t) : ?>
											<option value="<?php echo $t->kode_tdc ?>" ><?php echo $t->nama_tdc ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group form-float">
									<div class="form-line" id="bs_datepicker_container">
										<input class="form-control" type="text" name="tanggal" required/>
										<label class="form-label" for="tanggal">Tanggal HVC</label>
									</div>
								</div>

								<div class="form-group form-float">
									<!-- <p>With Search Bar</p> -->
									<select class="form-control show-tick" 
									name="kode_marketing" data-live-search="true">
										<option value="">--- PILIH MARKETING ---</option>
										<?php foreach($marketing as $m) : ?>
											<option value="<?php echo $m->kode_marketing ?>" ><?php echo $m->nama_marketing ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_mercent" required/>
										<label class="form-label" for="nama_mercent">Nama Mercent*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_pic" required/>
										<label class="form-label" for="nama_pic">Nama Pic*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="no_hp_pic" required/>
										<label class="form-label" for="no_hp_pic">No HP Pic*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="no_ktp" required/>
										<label class="form-label" for="no_ktp">No KTP*</label>
									</div>
								</div>							
							</div>

							<div class="col-md-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="npwp" required/>
										<label class="form-label" for="npwp">NPWP*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="longtitude" required/>
										<label class="form-label" for="longtitude">Longtitude*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="latitude" required/>
										<label class="form-label" for="latitude">Latitude*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="alamat" required/>
										<label class="form-label" for="alamat">Alamat*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="produk_diajukan" required/>
										<label class="form-label" for="produk_diajukan">Produk Diajukan*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
									<input class="form-control" type="file" name="foto_mercent[]" multiple/>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
						</div>
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
