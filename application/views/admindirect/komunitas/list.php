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
			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<h2>Mercent</h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6" style='text-align: right'>							
							<h2>
								<a href="<?php echo site_url('direct/komunitas/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i><span>Tambah</span></a>
								<a href="<?php echo site_url('direct/komunitas/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
								<span>Excel</span></a>							
								<a href="<?php echo site_url('direct/komunitas/exportpdf') ?>" class="btn btn-danger waves-effect"><i class="material-icons">save_alt</i>
								<span>PDF</span></a>
							</h2>
						</div> 						
					</div>
				</div>

				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>Nama TDC</th>
									<th>Nama Petugas</th>
									<th>Nama Komunitas</th>
									<th>Alamat</th>
									<th>Nama Sosmed</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($komunitas as $k): ?>
								<tr>
									<td>
										<?php echo $k->nama_tdc ?>
									</td>
									<td>
										<?php echo $k->nama_petugas ?>	
									</td>
									<td class="small">
										<?php echo $k->nama_komunitas ?>
									</td>
									<td class="small">
										<?php echo $k->alamat ?>
									</td>
									<td class="small">
										<?php echo $k->nama_sosmed ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('direct/komunitas/edit/'.$k->id_komunitas) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('direct/komunitas/remove/'.$k->id_komunitas) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('direct/komunitas/detail/'.$k->id_komunitas) ?>"><i class="material-icons">description</i></a>	
									</td>
								</tr>
								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>			
			</div>

		</div>
	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("direct/_parts/modal.php") ?>

	<?php $this->load->view("direct/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
