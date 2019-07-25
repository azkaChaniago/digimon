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

			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('indirect/distribusicollector') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('indirect/distribusicollector/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
					
						<!-- <div class="form-group form-float">
							<div class="form-line">
								<input type="text" name="id_target" class="form-control" required/>
								<label class="form-label" for="id_target">ID Target*</label>
							</div>
						</div> -->

						<div class="form-group form-float">
							<div class="form-line" id="bs_datepicker_container">
								<input class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>" type="text" name="tanggal" placeholder="Tanggal" required/>
								<!-- <label class="form-label" for="tanggal">Tanggal*</label> -->
							</div>
						</div>

						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="kode_marketing" data-live-search="true">
								<option value="">--- PILIH COLLECTOR ---</option>
								<?php foreach($collector as $can) : ?>
									<option value="<?php echo $can->kode_marketing ?>" ><?php echo $can->nama_marketing ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('new_rs_non_outlet') ? 'is-invalid':'' ?>"
								type="text" name="new_rs_non_outlet" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="new_rs_non_outlet">New RS Non Outlet*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('nsb') ? 'is-invalid':'' ?>"
								type="text" name="nsb" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="nsb">NSB*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('gt_pulsa') ? 'is-invalid':'' ?>"
								type="text" name="gt_pulsa" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="gt_pulsa">GT Pulsa*</label>
							</div>
						</div>
						
                        <div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('collecting') ? 'is-invalid':'' ?>"
								type="text" name="collecting" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="collecting">Collecting*</label>
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
