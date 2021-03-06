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
					<h2><a href="<?php echo site_url('admin/tdc') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('admin/tdc/edit') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<input class="form-control" type="hidden" name="kode_tdc" value="<?php echo $tdc->kode_tdc ?>" readonly required/>		
  
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="nama_tdc" value="<?php echo $tdc->nama_tdc ?>" required/>
								<label class="form-label" for="nama_tdc">Nama TDC*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control"	type="text" name="alamat" value="<?php echo $tdc->alamat ?>" required/>
								<label class="form-label" for="alamat">Alamat*</label>
							</div>
						</div>
						
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="no_telepon" onkeypress="return isNumberKey(event)" value="<?php echo $tdc->no_telepon ?>" required/>
								<label class="form-label" for="no_telepon">No Telepon*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control" type="text" name="no_callcenter" onkeypress="return isNumberKey(event)" value="<?php echo $tdc->no_callcenter ?>" required/>
								<label class="form-label" for="no_callcenter">No Callcenter*</label>
							</div>
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control"	type="text" name="manager" value="<?php echo $tdc->manager ?>" required/>
								<label class="form-label" for="manager">Nama Manajer*</label>
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
