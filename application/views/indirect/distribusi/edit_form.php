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

					<h2><a href="<?php echo site_url('indirect/distribusi') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('indirect/distribusi/edit') ?>" id="form_validation_stats" method="post" enctype="multipart/form-data" autocomplete="on">
						<input type="hidden" name="id_target" value="<?php echo $distribusi->id_target ?>" />

						<div class="form-group form-float">
							<div class="form-line" id="bs_datepicker_container">
								<input class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>" type="text" name="tanggal" value="<?php echo $distribusi->tanggal ?>" placeholder="Tanggal" required/>
								<!-- <label class="form-label" for="tanggal">Tanggal*</label> -->
							</div>
						</div>
						
						<div class="form-group form-float">
							<!-- <p>With Search Bar</p> -->
							<select class="form-control show-tick" 
							name="kode_marketing" data-live-search="true">
								<option value="">--- Pilih Canvasser ---</option>
								<?php foreach($canvasser as $can) : ?>
									<option value="<?php echo $can->kode_marketing ?>" <?php if ($can->kode_marketing == $distribusi->kode_marketing) { echo "selected"; } ?>><?php echo $can->nama_marketing ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('new_opening_outlet') ? 'is-invalid':'' ?>"
								type="text" name="new_opening_outlet" value="<?php echo $distribusi->new_opening_outlet ?>" onkeypress="return isNumberKey(event)"/>
								<label class="form-label" for="new_opening_outlet">New Opening Outlet*</label>
							</div>
						</div>

						<div class="form-group form-float">						
							<div class="form-line">
							<input class="form-control <?php echo form_error('outlet_aktif_digital') ? 'is-invalid':'' ?>"
								type="text" name="outlet_aktif_digital" value="<?php echo $distribusi->outlet_aktif_digital ?>" onkeypress="return isNumberKey(event)"/>
								<label class="form-label" for="outlet_aktif_digital">Outlet Aktif Digital*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('outlet_aktif_voucher') ? 'is-invalid':'' ?>"
								type="text" name="outlet_aktif_voucher" value="<?php echo $distribusi->outlet_aktif_voucher ?>" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="outlet_aktif_voucher">Outlet Aktif Voucher*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('outlet_aktif_bang_tcash') ? 'is-invalid':'' ?>"
								type="text" name="outlet_aktif_bang_tcash"  value="<?php echo $distribusi->outlet_aktif_bang_tcash ?>" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="outlet_aktif_bang_tcash">Outlet Aktif Bang Tcash*</label>
							</div>
						</div>
						
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('sales_perdana') ? 'is-invalid':'' ?>"
								type="text" name="sales_perdana"  value="<?php echo $distribusi->sales_perdana ?>" onkeypress="return isNumberKey(event)"required/>
								<label class="form-label" for="sales_perdana">Sales Perdana*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('nsb') ? 'is-invalid':'' ?>"
								type="text" name="nsb" value="<?php echo $distribusi->nsb ?>" onkeypress="return isNumberKey(event)"/>
								<label class="form-label" for="nsb">NSB*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('mkios_bulk') ? 'is-invalid':'' ?>"
								type="text" name="mkios_bulk" value="<?php echo $distribusi->mkios_bulk ?>" onkeypress="return isNumberKey(event)"/>
								<label class="form-label" for="mkios_bulk">MKIOS Bulk*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('gt_pulsa') ? 'is-invalid':'' ?>"
								type="text" name="gt_pulsa" value="<?php echo $distribusi->gt_pulsa ?>" onkeypress="return isNumberKey(event)"/>
								<label class="form-label" for="gt_pulsa">GT Pulsa*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?php echo form_error('mkios_reguler') ? 'is-invalid':'' ?>"
								type="text" name="mkios_reguler" value="<?php echo $distribusi->mkios_reguler ?>" onkeypress="return isNumberKey(event)"/>
								<label class="form-label" for="mkios_reguler">MKIOS Regular*</label>
							</div>
						</div>

						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Ubah" />
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
