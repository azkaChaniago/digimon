<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("admin/_parts/navbar.php") ?>
	<?php $this->load->view("admin/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">

			<?php if ($this->session->flashdata('error') !== null) : ?>
				<div class="alert alert-danger">
					<?= $this->session->flashdata('error') ?>
				</div>
			<?php endif; ?>

			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('admin/marketing') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('admin/marketing/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="kode_marketing" required/>
								<label class="form-label" for="kode_marketing">Kode Marketing*</label>
							</div>
						</div>
  
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="nama_marketing" required/>
								<label class="form-label" for="nama_marketing">Nama Marketing*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="kode_tdc" data-live-search="true">
								<option value="">--- Pilih TDC ---</option>
								<?php foreach($tdc as $can) : ?>
									<option value="<?php echo $can->kode_tdc ?>" ><?php echo $can->nama_tdc ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="divisi" data-live-search="true">
								<option value="">--- PILIH DIVISI ---</option>
								<optgroup label="Direct">
									<option value="AO YNC">AO YNC</option>
									<option value="EVENT OFFICCER">EVENT OFFICCER</option>
									<option value="PROMOTOR">PROMOTOR</option>
								</optgroup>
								<optgroup label="Indirect">
									<option value="CANVASSER">CANVASSER</option>
									<option value="COLLECTOR">COLLECTOR</option>
								</optgroup>
							</select>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control"	type="text" name="mkios" required/>
								<label class="form-label" for="mkios">MKIOS*</label>
							</div>
						</div>
						
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="no_hp" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="no_hp">No HP*</label>
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
							<input class="form-control"	type="email" name="email" required/>
								<label class="form-label" for="email">Email*</label>
							</div>
						</div>

						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
					</form>

				</div>

			</div>
			
		</div>
		<!-- /.container-fluid -->
	</section>
	<?php $this->load->view("admin/_parts/modal.php") ?>
	<?php $this->load->view("admin/_parts/js.php") ?>
</body>
</html>