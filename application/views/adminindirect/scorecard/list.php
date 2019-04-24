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
		<div class="container-fluid">
			<?php if  ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger">
				<?php echo $this->session->flashdata('error') ?>
			</div>
			<?php endif; ?>
			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6"><h2>Scorecard Canvasser</h2></div>
						<!-- <div class="col-md-6" style="text-align: right">
							<h2><a href="<?php echo site_url('adminindirect/scorecard/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a>
							<a href="<?php echo site_url('adminindirect/scorecard/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
							<a href="<?php echo site_url('adminindirect/scorecard/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
							<span>Export PDF<span></a></h2>
						</div> -->
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
									<th>NEW OPENING OUTLET</th>
									<th>OUTLET AKTIF DIGITAL</th>
									<th>OUTLET AKTIF VOUCHER</th>
									<th>OUTLET AKTIF BANG TCASH</th>
									<th>SALES PERDANA</th>
									<th>NSB</th>
									<th>MKIOS BULK</th>
									<th>GT PULSA</th>
									<th>MKIOS REGULAR</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($scores as $dist): ?>
								<tr>
									<td><?php echo $dist->nama_tdc ?></td>
									<td><?php echo $dist->nama_marketing ?></td>
									<td><?php echo $dist->tanggal ?></td>
									<td style="text-align:right"><?php echo $dist->new_opening_outlet ?></td>
									<td style="text-align:right"><?php echo $dist->outlet_aktif_digital ?></td>
									<td style="text-align:right"><?php echo $dist->outlet_aktif_voucher ?></td>
									<td style="text-align:right"><?php echo $dist->outlet_aktif_bang_tcash ?></td>
									<td style="text-align:right"><?php echo $dist->sales_perdana ?></td>
									<td style="text-align:right"><?php echo $dist->nsb ?></td>
									<td style="text-align:right"><?php echo $dist->mkios_bulk ?></td>
									<td style="text-align:right"><?php echo $dist->gt_pulsa ?></td>
									<td style="text-align:right"><?php echo $dist->mkios_reguler ?></td>
									<!-- <td width='180' class="text-center" >
										<a href="<?php echo site_url('adminindirect/distribusi/detail/'.$dist->id_target) ?>"><i class="material-icons">description</i></a>	
									</td> -->
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
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
