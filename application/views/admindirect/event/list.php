<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("admindirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("admindirect/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">

			<div class="card">
				<div class="header">
					<div class="row">
						<form action="<?php echo site_url('admindirect/event/fetchperiode') ?>" method="post">
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
								<button name="xls" class="btn btn-success waves-effect" formtarget="_blank"><i class="material-icons">save_alt</i>
								<span>Excel</span></button>							
								<button name="pdf" class="btn btn-danger waves-effect" target="blank" formtarget="_blank"><i class="material-icons">save_alt</i>
								<span>PDF</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<h2>Event</h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6" style='text-align: right'>							
							<!-- <h2><a href="<?php echo site_url('admindirect/event/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah</span></a></h2> -->
						</div> 						
					</div>
				</div>

				<div class="body">
					<div class="table-responsive">
						<!-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead><tr id="field"></tr></thead>
							<tbody id="records"></tbody>
						</table> -->
						<!-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>NAMA TDC</th>
									<th>TANGGAL EVENT</th>
									<th>NAMA EVENT</th>
									<th>LOKASI PENJUALAN</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($event as $ev): ?>
								<tr>
									<td>
										<?php echo $ev->nama_tdc ?>
									</td>
									<td>
										<?php echo $ev->tgl_event ?>
									</td>
									<td>
										<?php echo $ev->nama_event ?>	
									</td>
									<td>
										<?php echo $ev->lokasi_penjualan ?>
									</td>
									<td width='180' class="text-center" >
										<a href="<?php echo site_url('admindirect/event/detail/'.$ev->id_event) ?>"><i class="material-icons">description</i></a>	
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table> -->

						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>kode_tdc</th>
									<th>tanggal</th>
									<th>bulan</th>
									<th>kd_marketing</th>
									<th>id_outlet</th>
									<th>nama_marketing</th>
									<th>nama_outlet</th>
									<th>sum_of_as</th>
									<th>sum_of_simpati</th>
									<th>sum_of_loop</th>
									<th>sum_of_nsb</th>
									<th>sum_of_mkios_reguler</th>
									<th>sum_of_mkios_bulk</th>
									<th>sum_of_gt_pulsa</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pivot as $rv): ?>
								<tr>
									<th><?= $rv->kode_tdc ?></th>
									<td><?= $rv->tanggal ?></td>
									<td><?= $rv->bulan ?></td>
									<td><?= $rv->kd_marketing ?></td>
									<td><?= $rv->id_outlet ?></td>
									<td><?= $rv->nama_marketing ?></td>
									<td><?= $rv->nama_outlet ?></td>
									<td><?= $rv->sum_of_as ?></td>
									<td><?= $rv->sum_of_simpati ?></td>
									<td><?= $rv->sum_of_loop ?></td>
									<td><?= $rv->sum_of_nsb ?></td>
									<td><?= $rv->sum_of_mkios_reguler ?></td>
									<td><?= $rv->sum_of_mkios_bulk ?></td>
									<td><?= $rv->sum_of_gt_pulsa ?></td>
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

	<?php $this->load->view("admindirect/_parts/modal.php") ?>

	<?php $this->load->view("admindirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}

		// const show_hide_column = (col_no, do_show) => {
		// 	let tbl = document.getElementById('id_of_table');
		// 	let col = tbl.getElementsByTagName('col')[col_no];
		// 	console.log(do_show)
		// 	if (col) {
		// 		col.style.visibility = do_show ? "" : "collapse";
		// 	}
		// }

		// show_hide_column(0, false);

		const data = JSON.parse('<?= ($field) ?>');
		const field = Object.keys(data[0]).map( k => k.replace(/_/g, ' ').toUpperCase());
		
		let head = '';
		let rec = '';
		// field.forEach( k => {
		// 	head += `<th>${k}</th>`;
		// });
		// data.forEach( (item, key) => {
		// 	rec += `<tr>`;
		// 	console.log(Object.keys(item));
		// 	Object.values(item).forEach(i => {
		// 		rec += `<td>${i}</td>`;
		// 	})
		// 	rec += `</tr>`;
		// })
		// document.getElementById('field').innerHTML = head;
		// document.getElementById('records').innerHTML = rec;
		
	</script>

</body>

</html>



