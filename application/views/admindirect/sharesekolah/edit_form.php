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

			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('direct/marketsharesekolah/') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>					
				</div>
				<div class="body">
					<form action="<?php base_url('direct/marketsharesekolah/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
						<div class="row clearfix">
						<div class="col-md-4">
							<div class="form-group form-float">
								<div class="form-line" id="bs_datepicker_container">
									<input class="form-control" type="text" name="tgl_marketshare" value="<?= $marketshare->tgl_marketshare ?>" required/>
									<label class="form-label" for="tgl_marketshare">Tanggal*</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-float">
								<select class="form-control show-tick" 
								name="kode_tdc" data-live-search="true">
									<option value="">--- PILIH TDC ---</option>
									<?php foreach($tdc as $t) : ?>
										<option value="<?php echo $t->kode_tdc ?>" <?= $t->kode_tdc == $marketshare->kode_tdc ? "selected" : "" ?>><?php echo $t->nama_tdc ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-float">
								<select class="form-control show-tick" 
								name="npsn" data-live-search="true">
									<option value="">--- PILIH SEKOLAH ---</option>
									<?php foreach($sekolah as $t) : ?>
										<option value="<?php echo $t->npsn ?>" <?= $t->npsn == $marketshare->npsn ? "selected" : "" ?> ><?php echo $t->nama_sekolah ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
							<div class="col-md-12">
								<h2 class="card-inside-title">Marketshare</h2>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_simpati" id="simpati_ms" onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_simpati ?>" required>
										<label class="form-label" for="qty_simpati">QTY Simpati*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_as"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_as ?>" required>
										<label class="form-label" for="qty_as">QTY AS*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_loop"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_loop ?>" required>
										<label class="form-label" for="qty_loop">QTY Loop*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_mentari"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_mentari ?>" required>
										<label class="form-label" for="qty_mentari">QTY Mentari*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_im3"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_im3 ?>" required>
										<label class="form-label" for="qty_im3">QTY IM3*</label>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_xl"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_xl ?>" required>
										<label class="form-label" for="qty_xl">QTY XL*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_axsis"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_axsis ?>" required>
										<label class="form-label" for="qty_axsis">QTY AXSIS*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_tri"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_tri ?>" required>
										<label class="form-label" for="qty_tri">QTY Tri*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_smartfrend"  onkeypress="return isNumberKey(event)" value="<?= $marketshare->qty_smartfrend ?>" required>
										<label class="form-label" for="qty_smartfrend">QTY Smartfrend*</label>
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

