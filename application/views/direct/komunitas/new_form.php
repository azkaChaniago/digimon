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
					<?= $this->session->userdata('errors')  ?>
				</div>
			<?php endif;?>
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?= site_url('direct/komunitas') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('direct/komunitas/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<div class="row">
							<div class="col-md-6">
								
								<!-- <div class="form-group form-float">
									<select class="form-control show-tick" 
									name="kode_tdc" data-live-search="true">
										<option value="">--- PILIH TDC ---</option>
										<?php foreach($tdc as $t) : ?>
											<option value="<?= $t->kode_tdc ?>" ><?= $t->nama_tdc ?></option>
										<?php endforeach; ?>
									</select>
								</div> -->

								<div class="form-group form-float">
									<select class="form-control show-tick" name="nama_petugas" data-live-search="true">
										<option value="">--- PILIH PETUGAS ---</option>
										<?php foreach($marketing as $m) : ?>
											<option value="<?= $m->kode_marketing ?>" ><?= $m->nama_marketing ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_komunitas" required/>
										<label class="form-label" for="nama_komunitas">Nama Komunitas*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_ketua" required/>
										<label class="form-label" for="nama_ketua">Nama Ketua*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="no_hpketua" required/>
										<label class="form-label" for="no_hpketua">No HP Ketua*</label>
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
										<input class="form-control" type="text" name="jumlah_anggota" required/>
										<label class="form-label" for="jumlah_anggota">Jumlah Anggota*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_sosmed" required/>
										<label class="form-label" for="nama_sosmed">Nama Sosial Media*</label>
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

