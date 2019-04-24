<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/indirect/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/indirect/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/indirect/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<div class="card">
					<div class="header">
						<div class="row">
							<form action="<?php echo site_url('indirect/scorecard/fetchperiode') ?>" method="post">
								<div class="col-md-5">
									<div class="form-group form-float">
										<div class="form-line" id="bs_datepicker_container">
											<input class="form-control" type="text" name="start" required/>
											<label class="form-label" for="start">Periode Awal*</label>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group form-float">
										<div class="form-line" id="bs_datepicker_container">
											<input class="form-control" type="text" name="end" required/>
											<label class="form-label" for="end">Periode Akhir*</label>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<button name="xls" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
									<span>Export Excel</span></button>
									<button name="pdf" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
									<span>Export PDF</span></button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<h2>Score Card</h2><hr>
						<a href="<?php echo site_url('admin/scorecard/add') ?>"><i class="fas fa-plus"></i> Add New</a>						
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Nama Canvasser</th>
										<th>Actual Call</th>
                                        <th>Effective Call</th>
										<th>AS</th>
										<th>Simpati</th>
										<th>Loop</th>
										<th>NSB</th>
										<th>MKIOS Regular</th>
                                        <th>MKIOS Bulk</th>
										<th>GT Pulsa</th>
                                        <th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($scores as $score): ?>
									<tr>
										<td>
											<?php echo $score->tanggal ?>
										</td>
										<td>
											<?php echo $score->nama_marketing ?>	
										</td>
										<td class="small">
											<?php echo $score->actual_call ?>
										</td>
                                        <td class="small">
											<?php echo $score->efective_call ?>
										</td>
										<td class="small">
											<?php echo $score->as ?>
										</td>
										<td class="small">
											<?php echo $score->simpati ?>
										</td>
										<td class="small">
											<?php echo $score->loop ?>
										</td>
										<td class="small">
											<?php echo $score->nsb ?>
										</td>
										<td class="small">
											<?php echo $score->mkios_reguler ?>
										</td>
                                        <td class="small">
											<?php echo $score->mkios_bulk ?>
										</td>
										<td class="small">
											<?php echo $score->gt_pulsa ?>
										</td>
										<td width='180'>
											<a href="<?php echo site_url('admin/scorecard/edit/'.$score->id_score_card) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/scorecard/delete/'.$score->id_score_card) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i></a>
											 <a href="<?php echo site_url('admin/scorecard/detail/'.$score->id_score_card) ?>" 
											 class="btn btn-small text-success"><i class="fas fa-info"></i></a>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/indirect/_parts/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/indirect/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/indirect/_parts/modal.php") ?>

	<?php $this->load->view("admin/indirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
