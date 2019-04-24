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
					<div class="col-md-6"><h2>Histori Order</h2></div>
					<!-- <div class="col-md-6" style="text-align: right">
						<h2><a href="<?php echo site_url('adminindirect/historiorder/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
						<span>Tambah<span></a>
						<a href="<?php echo site_url('adminindirect/historiorder/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
						<span>Export Excel<span></a>
						<a href="<?php echo site_url('adminindirect/historiorder/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
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
								<th>NAMA OUTLET</th>
								<th>TANGGAL</th>
								<th>AS</th>
								<th>SIMPATI</th>
								<th>LOOP</th>
								<th>NSB</th>
								<th>MKIOS REGULAR</th>
								<th>MKIOS BULK</th>
								<th>GT PULSA</th>
								<!-- <th>Aksi</th> -->
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histori as $hist): ?>
							<tr>
								<td><?php echo $hist->nama_tdc ?></td>
								<td><?php echo $hist->nama_marketing ?>	</td>
								<td><?php echo $hist->nama_outlet ?></td>
								<td><?php echo $hist->tanggal ?></td>
								<td style="text-align:right"><?php echo $hist->as ?></td>
								<td style="text-align:right"><?php echo $hist->simpati ?></td>
								<td style="text-align:right"><?php echo $hist->loop ?></td>
								<td style="text-align:right"><?php echo $hist->nsb ?></td>
								<td style="text-align:right"><?php echo $hist->mkios_reguler ?></td>
								<td style="text-align:right"><?php echo $hist->mkios_bulk ?></td>
								<td style="text-align:right"><?php echo $hist->gt_pulsa ?></td>
								<!-- <td width='180' class="text-center" >
									<a href="<?php echo site_url('adminindirect/historiorder/edit/'.$hist->id_histori_order) ?>"><i class="material-icons">edit</i></a>
									<a onclick="deleteConfirm('<?php echo site_url('adminindirect/historiorder/delete/'.$hist->id_histori_order) ?>')" href="#!"><i class="material-icons">delete</i></a>
									<a href="<?php echo site_url('adminindirect/historiorder/detail/'.$hist->id_histori_order) ?>"><i class="material-icons">description</i></a>	
								</td> -->
							</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
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
