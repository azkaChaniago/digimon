<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("adminindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("adminindirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("adminindirect/_parts/sidebar.php") ?>

	<section class="content">

		<div class="container-fluid">

			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6"><h2>Scorecard Collector</h2></div>
						<div class="col-md-6" style="text-align: right">
							<h2><a href="<?php echo site_url('adminindirect/scorecardcollector/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a>
							<a href="<?php echo site_url('adminindirect/scorecardcollector/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
							<a href="<?php echo site_url('adminindirect/scorecardcollector/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
							<span>Export PDF<span></a></h2>
						</div>
					</div>				
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
								<tr>
									<th>NAMA TDC</th>
									<th>NAMA MARKETING</th>
									<th>TANGGAL</th>
									<th>NEW RS NON OUTLET</th>
									<th>NSB</th>
									<th>GT PULSA</th>
									<th>COLLECTING</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($collector as $dist): ?>
								<tr>
									<td><?php echo $dist->nama_tdc ?></td>
									<td><?php echo $dist->nama_marketing ?></td>
									<td><?php echo $dist->tanggal ?></td>
									<td><?php echo $dist->new_rs_non_outlet ?></td>
									<td><?php echo $dist->nsb ?></td>
									<td><?php echo $dist->gt_pulsa ?></td>
									<td><?php echo $dist->collecting ?></td>
									<!-- <td width='180' class="text-center" >
										<a href="<?php echo site_url('adminindirect/distribusicollector/detail/'.$dist->id_target) ?>"><i class="material-icons">description</i></a>	
									</td> -->
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>			
			</div>
		</div>
		<!-- /.container-fluid -->

		</div>
		<!-- /.content-wrapper -->

	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("adminindirect/_parts/modal.php") ?>

	<?php $this->load->view("adminindirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
