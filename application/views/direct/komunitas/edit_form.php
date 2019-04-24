<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/direct/_parts/head.php") ?>
</head>

<body id="page-top">


	<?php $this->load->view("admin/direct/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/direct/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/direct/_parts/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<?php if (isset($error)): ?>
				<div class="alert alert-error" role="alert">
					<?php echo $error; ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('/direct/komunitas/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('direct/komunitas/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-6">
								
									<!-- <div class="form-group">
										<label for="id_komunitas">ID Komunitas*</label> -->
										<input class="form-control <?php echo form_error('id_komunitas') ? 'is-invalid':'' ?>"
										type="hidden" name="id_komunitas" placeholder="ID Komunitas" value="<?php echo $komunitas->id_komunitas ?>"/>
										<div class="invalid-feedback">
											<?php echo form_error('id_komunitas') ?>
										</div>
									<!-- </div> -->
									
									<div class="form-group">
										<label for="kode_tdc">Nama TDC*</label>
										<select class="form-control <?php echo form_error('kode_tdc') ? 'is-invalid':'' ?>" 
										name="kode_tdc">
											<option selected="selected">---</option>
											<?php foreach($tdc as $t) : ?>
												<option value="<?php echo $t->kode_tdc ?>"><?php echo $t->nama_tdc ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_tdc') ?>
										</div>								
									</div>

									<div class="form-group">
										<label for="nama_petugas">Nama Petugas*</label>
										<input class="form-control <?php echo form_error('nama_petugas') ? 'is-invalid':'' ?>"
										type="text" name="nama_petugas" placeholder="Nama Petugas" value="<?php echo $komunitas->nama_petugas ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_petugas') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="nama_komunitas">Nama Komunitas*</label>
										<input class="form-control <?php echo form_error('nama_komunitas') ? 'is-invalid':'' ?>"
										type="text" name="nama_komunitas" placeholder="Nama Komunitas" value="<?php echo $komunitas->nama_komunitas ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_komunitas') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="nama_ketua">Nama Ketua*</label>
										<input class="form-control <?php echo form_error('nama_ketua') ? 'is-invalid':'' ?>"
										type="text" name="nama_ketua" placeholder="Nama Ketua" value="<?php echo $komunitas->nama_ketua ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_ketua') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="no_hpketua">No HP Ketua*</label>
										<input class="form-control <?php echo form_error('no_hpketua') ? 'is-invalid':'' ?>"
										type="text" name="no_hpketua" placeholder="No HP Ketua" value="<?php echo $komunitas->no_hpketua ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('no_hpketua') ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">									
									<div class="form-group">
										<label for="alamat">Alamat*</label>
										<input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
										type="text" name="alamat" placeholder="Alamat" value="<?php echo $komunitas->alamat ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('alamat') ?>
										</div>
									</div>
									<div class="form-group">
										<label for="jumlah_anggota">Jumlah Anggota*</label>
										<input class="form-control <?php echo form_error('jumlah_anggota') ? 'is-invalid':'' ?>"
										type="text" name="jumlah_anggota" placeholder="Jumlah Anggota" value="<?php echo $komunitas->jumlah_anggota ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('jumlah_anggota') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="nama_sosmed">Nama Sosmed*</label>
										<input class="form-control <?php echo form_error('nama_sosmed') ? 'is-invalid':'' ?>"
										type="text" name="nama_sosmed" placeholder="Nama Sosmed" value="<?php echo $komunitas->nama_sosmed ?>" />
										<div class="invalid-feedback">
											<?php echo form_error('nama_sosmed') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="kode_user">Nama User*</label>
										<select class="form-control <?php echo form_error('kode_user') ? 'is-invalid':'' ?>" 
										name="kode_user">
											<option selected="selected">---</option>
											<?php foreach($user as $u) : ?>
												<option value="<?php echo $u->kode_user ?>"><?php echo $u->nama_user ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('kode_user') ?>
										</div>								
									</div>
								</div>

							</div class="row">
							<div class="row">
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
							</div>
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/direct/_parts/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/direct/_parts/scrolltop.php") ?>

		<?php $this->load->view("admin/direct/_parts/js.php") ?>

</body>

</html>