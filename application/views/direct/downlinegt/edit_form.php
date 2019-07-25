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
					<h2><a href="<?php echo site_url('direct/downlinegt') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('direct/downlinegt/edit') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
						<div class="row">
						<div class="col-md-6">

							<div class="form-group form-float">
								<select class="form-control show-tick" 
								name="kode_tdc"
								data-live-search="true">
									<option selected="selected">--- PILIH TDC ---</option>
									<?php foreach($tdc as $tdc) : ?>
										<option value="<?php echo $tdc->kode_tdc ?>" <?= $downlinegt->kode_tdc == $tdc->kode_tdc ? "selected" : "" ?>><?php echo $tdc->nama_tdc ?></option>
									<?php endforeach; ?>
								</select>	
							</div>

							<div class="form-group form-float">
								<div class="form-line">
									<input class="form-control" type="text" name="divisi" value="<?= $downlinegt->divisi ?>" required/>
									<label class='form-label' for="divisi">Divisi*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line" id="bs_datepicker_container">
									<input class="form-control" type="text" name="tanggal" value="<?= date('d/m/Y', strtotime($downlinegt->tanggal)) ?>" placeholder="Tanggal Penjualan" required/>
									<!-- <label class="form-label" for="tanggal">Tanggal Penjualan</label> -->
								</div>
							</div>

							<div class="form-group form-float">
								<select class="form-control show-tick" name="kode_marketing" data-live-search="true">
									<option selected="selected">--- PILIH NAMA MARKETING ---</option>
									<?php foreach($marketing as $mar) : ?>
										<option value="<?php echo $mar->kode_marketing ?>" <?= $downlinegt->kode_marketing == $mar->kode_marketing ? "selected" : "" ?>><?php echo $mar->nama_marketing ?></option>
									<?php endforeach; ?>
								</select>							
							</div>

							<div class="form-group form-float">
								<div class="form-line">
									<input class="form-control" type="text" name="nama_downline" value="<?= $downlinegt->nama_downline ?>" required/>
									<label class='form-label' for="nama_downline">Nama Downline GT*</label>
								</div>
							</div>
						</div>

						<div class="col-md-6">					
							<div class="form-group form-float">
								<div class="form-line">
									<input class="form-control" type="text" name="alamat" value="<?= $downlinegt->alamat_gt ?>" required/>
									<label class='form-label' for="alamat">Alamat*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
									<input class="form-control" type="text" name="nomor_gt" value="<?= $downlinegt->nomor_gt ?>" required/>
									<label class='form-label' for="nomor_gt">Nomor GT*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
									<input class="form-control" type="text" name="deposit" value="<?= $downlinegt->deposit ?>" required/>
									<label class='form-label' for="deposit">Deposit*</label>
								</div>
							</div>
							
							<div class="form-group form-float">
								<label for="foto">Foto Kegiatan*</label>
								<input class="form-control"
								type="file" name="foto[]" value="Foto Kegiatan" multiple/>
							</div>
							<input type="hidden" name="old_image" value="<?= htmlspecialchars($downlinegt->foto) ?>" />

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
