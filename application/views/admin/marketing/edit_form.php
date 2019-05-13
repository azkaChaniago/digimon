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
					<form action="<?php base_url('admin/marketing/edit') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<!-- <div class="form-group form-float">
							<div class="form-line"> -->
							<input class="form-control" type="hidden" name="kode_marketing" value="<?php echo $marketing->kode_marketing ?>" required/>
								<!-- <label class="form-label" for="kode_marketing">Kode Marketing*</label>
							</div>
						</div> -->
  
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="nama_marketing" value="<?php echo $marketing->nama_marketing ?>" required/>
								<label class="form-label" for="nama_marketing">Nama Marketing*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="kode_tdc" data-live-search="true">
								<option value="">--- PILIH TDC ---</option>
								<?php foreach($tdc as $tdc) : ?>
									<option value="<?php echo $tdc->kode_tdc ?>" <?php echo $marketing->kode_tdc == $tdc->kode_tdc ? "selected" : "" ?>><?php echo $tdc->nama_tdc ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="divisi" data-live-search="true">
								<option value="">--- PILIH DIVISI ---</option>
								<optgroup label="DIRECT">
									<option value="AO YNC" <?php echo $marketing->divisi == "AO YNC" ? "selected" : "" ?>>AO YNC</option>
									<option value="EVENT OFFICER" <?php echo $marketing->divisi == "EVENT OFFICER" ? "selected" : "" ?>>EVENT OFFICER</option>
									<option value="PROMOTOR" <?php echo $marketing->divisi == "PROMOTOR" ? "selected" : "" ?>>PROMOTOR</option>
								</optgroup>
								<optgroup label="INDIRECT">
									<option value="CANVASSER" <?php echo $marketing->divisi == "CANVASSER" ? "selected" : "" ?>>CANVASSER</option>
									<option value="COLLECTOR" <?php echo $marketing->divisi == "COLLECTOR" ? "selected" : "" ?>>COLLECTOR</option>
								</optgroup>
							</select>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control"	type="text" name="mkios" value="<?php echo $marketing->mkios ?>" required/>
								<label class="form-label" for="mkios">MKIOS*</label>
							</div>
						</div>
						
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="no_hp" onkeypress="return isNumberKey(event)" value="<?php echo $marketing->no_hp ?>" required/>
								<label class="form-label" for="no_hp">No HP*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="alamat" value="<?php echo $marketing->alamat ?>" required/>
								<label class="form-label" for="alamat">Alamat*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control"	type="email" name="email" value="<?php echo $marketing->email ?>" required/>
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
