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
						<div class="col-md-6"><h2>TDC</h2></div>
						<div class="col-md-6" style="text-align: right">
							<h2><a href="<?php echo site_url('admin/tdc/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah<span></a></h2>
							<!-- <a href="<?php echo site_url('admin/tdc/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
							<span>Export Excel<span></a>
							<a href="<?php echo site_url('admin/tdc/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
							<span>Export PDF<span></a></h2> -->
						</div>
					</div>	
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>Nama TDC</th>
									<th>Manager</th>
									<th>No Telepon</th>
									<th>No Callcenter</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tdc as $t): ?>
								<tr>
									<td width="150">
										<?php echo $t->nama_tdc ?>
									</td>
									<td class="small">
										<?php echo $t->manager ?>
									</td>
									<td class="small">
										<?php echo $t->no_telepon ?>
									</td>
									<td class="small">
										<?php echo $t->no_callcenter ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('admin/tdc/edit/'.$t->kode_tdc) ?>"><i class="material-icons">edit</i></a>
										<a onclick="deleteConfirm('<?php echo site_url('admin/tdc/remove/'.$t->kode_tdc) ?>')" href="#!"><i class="material-icons">delete</i></a>
										<a href="<?php echo site_url('admin/tdc/detail/'.$t->kode_tdc) ?>"><i class="material-icons">description</i></a>	
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
