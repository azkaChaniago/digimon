<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("indirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("indirect/_parts/sidebar.php") ?>

	<section class="content">

		<div class="container-fluid">

			<?php if ($this->session->flashdata('status_msg')) : ?>
				<div class="alert alert-danger" >
					<?php echo $this->session->flashdata('status_msg') ?>
				</div>
			<?php endif; ?>

			

			<!-- DataTables -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<h2>Tambah Foto</h2>
						</div>
						<div class="body">
							<form id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on" enctype="multipart/form-data">
								<input id="id_galeri" type="hidden" name="id">
								<div class="col-md-4">
									<div class="form-group form-float">
										<div class="form-line" id="bs_datepicker_container">
											<input id="tgl" class="form-control" type="text" name="tanggal"  required/>
											<label class="form-label" for="tanggal">Tanggal*</label>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group form-float">
										<select id="ket" class="form-control show-tick" name="keterangan" data-live-search="true" required>
											<option value="">--- KETERANGAN ---</option>
											<option value="BRANDING OUTLET">BRANDING OUTLET</option>
											<option value="INFO KOMPETITOR">INFO KOMPETITOR</option>
											<option value="BC & TANDEM">BC & TANDEM</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											<input class="form-control" name="images[]" type="file" multiple required/>
										</div>
										<div id="img"></div>
									</div>
									<div class="clearfix"></div>
								</div>
								<input class="btn btn-primary waves-effect" type="submit" name="simpan" value="Simpan" />
								<input class="btn btn-success waves-effect" type="submit" name="ubah" value="Ubah" />
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<div class="row">
								<div class="col-md-6"><h2>Galeri</h2></div>
								<!-- <div class="col-md-6" style="text-align: right">
									<h2><a href="<?php echo site_url('indirect/galeri/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
									<span>Tambah<span></a></h2>
									<a href="<?php echo site_url('indirect/galeri/export') ?>" class="btn btn-success waves-effect"><i class="material-icons">save_alt</i>
									<span>Export Excel<span></a>
									<a href="<?php echo site_url('indirect/galeri/exportpdf') ?>" class="btn btn-danger waves-effect" target="blank"><i class="material-icons">save_alt</i>
									<span>Export PDF<span></a></h2>
								</div> -->
							</div>
						</div>

						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="table">
									<thead>
										<tr>
											<th style="display: none"></th>
											<th>Foto</th>
											<th>Keterangan</th>
											<th>Tanggal</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($galeri as $gal): ?>
										<tr>
											<td style="display: none"> <?php echo $gal->id ?> </td>
											<td>
												<img width='200' class='img img-responsive img-fluid' src='<?php echo base_url("upload/outlet/" . $gal->foto) ?>'/>
											</td>
											<td> <?php echo $gal->keterangan ?> </td>
											<td> <?php echo $gal->tanggal ?> </td>
											<td width='180' class="text-center" >
												<a id="toForm" href="#"><i class="material-icons">edit</i></a>
												<a onclick="deleteConfirm('<?php echo site_url('indirect/galeri/remove/'.$gal->id) ?>')" href="#!"><i class="material-icons">delete</i></a>
												<!-- <a href="<?php echo site_url('indirect/galeri/detail/'.$gal->id) ?>"><i class="material-icons">description</i></a>	 -->
											</td>
										</tr>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
							<div class="row">
							
						</div>
					</div>			
				</div>
			</div>
						
		</div>
		<!-- /.container-fluid -->

	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("indirect/_parts/modal.php") ?>

	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}

		var table = document.getElementById('table'), rIndex;
		for (var i = 0; i < table.rows.length; i++) {
			table.rows[i].onclick = function () {
				rIndex = this.rowIndex;
				document.getElementById('id_galeri').value = this.cells[0].innerHTML;
				document.getElementById('img').innerHTML = this.cells[1].querySelector('img').src;
				document.getElementById('ket').querySelector('option').selected = this.cells[2].innerHTML;
				document.getElementById('ket').querySelector('option').value = this.cells[2].innerHTML;
				document.getElementById('ket').querySelector('option').text = this.cells[2].innerHTML;
				document.getElementById('tgl').value = this.cells[3].innerHTML;
				console.log(document.getElementById('ket').querySelector('option').selected);
			}
		}
	</script>

</body>

</html>
