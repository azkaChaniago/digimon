<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("indirect/_parts/navbar.php") ?>
	<?php $this->load->view("indirect/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">
		<!-- <?php if ($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error'); ?>
		</div>
		<?php endif; ?> -->
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('indirect/historiorder') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('indirect/historiorder/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
					
						<div class="form-group form-float">
							<div class="form-line" id="bs_datepicker_container">
								<input class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>" type="text" name="tanggal"  required/>
								<label class="form-label" for="tanggal">Tanggal*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="kode_marketing" data-live-search="true">
								<option value="">--- PILIH CANVASSER ---</option>
								<?php foreach($marketing as $can) : ?>
									<option value="<?php echo $can->kode_marketing ?>" ><?php echo $can->nama_marketing ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="id_outlet" data-live-search="true">
								<option value="">--- PILIH OUTLET ---</option>
								<?php foreach($outlet as $can) : ?>
									<option value="<?php echo $can->id_outlet ?>" ><?php echo $can->nama_outlet ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('as') ? 'is-invalid':'' ?>"
								type="text" name="as" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="as">AS*</label>
							</div>
						</div>

						<div class="form-group form-float">						
							<div class="form-line">
							<input class="form-control <?php echo form_error('simpati') ? 'is-invalid':'' ?>"
								type="text" name="simpati"  onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="simpati">Simpati*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('loop') ? 'is-invalid':'' ?>"
								type="text" name="loop" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="loop">Loop*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('nsb') ? 'is-invalid':'' ?>"
								type="text" name="nsb" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="nsb">NSB*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('mkios_reguler') ? 'is-invalid':'' ?>"
								type="text" name="mkios_reguler" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="mkios_reguler">MKIOS Regular*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('mkios_bulk') ? 'is-invalid':'' ?>"
								type="text" name="mkios_bulk" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="mkios_bulk">MKIOS Bulk*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('gt_pulsa') ? 'is-invalid':'' ?>"
								type="text" name="gt_pulsa" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="gt_pulsa">GT Pulsa*</label>
							</div>
						</div>						
						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
					</form>

				</div>

			</div>
			
		</div>
		<!-- /.container-fluid -->
	</section>
	<?php $this->load->view("indirect/_parts/modal.php") ?>
	<?php $this->load->view("indirect/_parts/js.php") ?>
</body>
</html>
