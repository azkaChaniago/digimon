<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
</head>

<body id="page-top">


	<?php $this->load->view("admin/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_parts/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('/admin/historiorder/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					
						<form action="<?php base_url('admin/historiorder/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label for="tanggal">Tanggal*</label>
								<input class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>"
								 type="date" name="tanggal" value="<?php echo $histori->tanggal ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('tanggal') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="kode_marketing">Nama Canvasser*</label>
								<select class="form-control <?php echo form_error('kode_marketing') ? 'is-invalid':'' ?>" 
								name="kode_marketing">
									<?php foreach($users as $user) : ?>
										<option value="<?php echo $user->kode_marketing ?>" <?php set_select('kode_marketing', $user->kode_marketing) ?>><?php echo $user->nama_marketing ?></option>
									<?php endforeach; ?>
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('kode_marketing') ?>
								</div>
								
							</div>

							<div class="form-group">
								<label for="id_outlet">Nama Outlet*</label>
								<select class="form-control <?php echo form_error('id_outlet') ? 'is-invalid':'' ?>" 
								name="id_outlet">
									<?php foreach($users as $user) : ?>
										<option value="<?php echo $user->id_outlet ?>" <?php set_select('id_outlet', $user->id_outlet) ?>><?php echo $user->nama_outlet ?></option>
									<?php endforeach; ?>
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('id_outlet') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="as">AS*</label>
								<input class="form-control <?php echo form_error('as') ? 'is-invalid':'' ?>"
								 type="text" name="as" placeholder="AS" value="<?php echo $histori->as ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('as') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="simpati">Simpati*</label>
								<input class="form-control <?php echo form_error('simpati') ? 'is-invalid':'' ?>"
								 type="text" name="simpati" placeholder="Simpati" value="<?php echo $histori->simpati ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('simpati') ?>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label for="loop">Loop*</label>
								<input class="form-control <?php echo form_error('loop') ? 'is-invalid':'' ?>"
								 type="text" name="loop" placeholder="Loop" value="<?php echo $histori->loop ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('loop') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="nsb">NSB*</label>
								<input class="form-control <?php echo form_error('nsb') ? 'is-invalid':'' ?>"
								 type="text" name="nsb" placeholder="NSB" value="<?php echo $histori->nsb ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('nsb') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="mkios_reguler">MKIOS Reguler*</label>
								<input class="form-control <?php echo form_error('mkios_reguler') ? 'is-invalid':'' ?>"
								 type="text" name="mkios_reguler" placeholder="MKIOS Reguler" value="<?php echo $histori->mkios_reguler ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('mkios_reguler') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="mkios_bulk">MKIOS Bulk*</label>
								<input class="form-control <?php echo form_error('mkios_bulk') ? 'is-invalid':'' ?>"
								 type="text" name="mkios_bulk" placeholder="MKIOS Bulk" value="<?php echo $histori->mkios_bulk ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('mkios_bulk') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="gt_pulsa">GT Pulsa*</label>
								<input class="form-control <?php echo form_error('gt_pulsa') ? 'is-invalid':'' ?>"
								 type="text" name="gt_pulsa" placeholder="GT Pulsa" value="<?php echo $histori->gt_pulsa ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('gt_pulsa') ?>
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
				<?php $this->load->view("admin/_parts/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_parts/scrolltop.php") ?>

		<?php $this->load->view("admin/_parts/js.php") ?>

</body>

</html>