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
			<!-- DataTables -->
			<div class="card">
				<div class="header">
				<div class="row">
					<div class="col-md-6"><h2>Data Petugas</h2></div>
					<div class="col-md-6" style="text-align: right">
						<h2>
							<a href="<?php echo site_url('admin/marketing/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a>
							<a href="<?php echo site_url('admin/marketing/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
						</h2>
					</div>
				</div>
				</div>
				<div class="body">

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
							<thead>
								<tr>
									<th>Nama Marketing</th>
									<th>Nama TDC</th>
									<th>Divisi</th>
									<th>MKIOS</th>
									<th>No HP</th>
									<th>Alamat</th>
									<th>Email</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($marketing as $mar): ?>
								<tr>
									<td width="150">
										<?php echo $mar->nama_marketing ?>
									</td>
									<td class="small">
										<?php echo $mar->nama_tdc ?>
									</td>
									<td class="small">
										<?php echo $mar->divisi ?>
									</td>
									<td class="small">
										<?php echo $mar->mkios ?>
									</td>
									<td class="small">
										<?php echo $mar->no_hp ?>
									</td>
									<td class="small">
										<?php echo $mar->alamat ?>
									</td>
									<td class="small">
										<?php echo $mar->email ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('admin/marketing/edit/'.$mar->kode_marketing) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('admin/marketing/remove/'.$mar->kode_marketing) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('admin/marketing/detail/'.$mar->kode_marketing) ?>"><i class="material-icons">description</i></a>	
									</td>
								</tr>
								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
	</section>
	<?php $this->load->view("admin/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/_parts/modal.php") ?>

	<?php $this->load->view("admin/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
