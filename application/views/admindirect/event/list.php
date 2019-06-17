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
				<div class="body">
				<div class="subnav">
					<div class="btn-group">
						<div class="btn-group" role="group">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Filter Fields
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu stop-propagation"><div id="filter-list"></div></ul>
							</div>
						</div>
						<div class="btn-group" role="group">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Row Label Fields
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu stop-propagation"><div id="row-label-fields"></div></ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-pills">
						<!-- <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Filter Fields
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu stop-propagation" style="overflow:auto;max-height:450px;padding:10px;">
							<div id="filter-list"></div>
						</ul>
						</li> -->
						<!-- <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Row Label Fields
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu stop-propagation" style="overflow:auto;max-height:450px;padding:10px;">
							<div id="row-label-fields"></div>
						</ul>
						</li -->>
						<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Column Label Fields
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu stop-propagation" style="overflow:auto;max-height:450px;padding:10px;">
							<div id="column-label-fields"></div>
						</ul>
						</li>
						<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Summary Fields
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu stop-propagation" style="overflow:auto;max-height:450px;padding:10px;">
							<div id="summary-fields"></div>
						</ul>
						</li>
						<li class="dropdown pull-right">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Canned Reports
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<li><a id="ar-aged-balance" href="#">AR Aged Balance</a></li>
						<li><a id="acme-detail-report" href="#">Acme Corp Detail</a></li>
						<li><a id="miami-invoice-detail" href="#">Miami Invoice Detail</a></li>
						</ul>
						</li>
					</ul>
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

						<!-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
						</table> -->
					</div>

					<div class="table-responsive">
						<table id="results" class="table table-bordered table-striped table-hover js-basic-example dataTable"></table>
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

		const data = <?= $field ?>;
		const field = [Object.keys(data[0]).map( k => k.replace(/_/g, ' ').toUpperCase())];

		const dataVal = data.map(({nama_tdc, divisi, tgl_event, nama_marketing, nama_event, lokasi_penjualan, qty_5k, qty_10k, qty_20k, qty_25k, qty_50k, qty_100k, mount_bulk, mount_legacy, mount_digital, mount_tcash, qty_low_nsb, qty_middle_nsb, qty_high_nsb, qty_as_nsb, qty_simpati_nsb, qty_loop_nsb}) => field.push([nama_tdc, divisi, tgl_event, nama_marketing, nama_event, lokasi_penjualan, parseInt(qty_5k), parseInt(qty_10k), parseInt(qty_20k), parseInt(qty_25k), parseInt(qty_50k), parseInt(qty_100k), parseInt(mount_bulk), parseInt(mount_legacy), parseInt(mount_digital), parseInt(mount_tcash), parseInt(qty_low_nsb), parseInt(qty_middle_nsb), parseInt(qty_high_nsb), parseInt(qty_as_nsb), parseInt(qty_simpati_nsb), parseInt(qty_loop_nsb)]));
		
		let dataArr = field;
		let dataStr = JSON.stringify(dataArr);
		console.log(dataStr);		

		function ageBucket(row, field){
		var age = Math.abs(((new Date().getTime()) - row[field.dataSource])/1000/60/60/24);
		switch (true){
			case (age < 31):
			return '000 - 030'
			case (age < 61):
			return '031 - 060'
			case (age < 91):
			return '061 - 090'
			case (age < 121):
			return '091 - 120'
			default:
			return '121+'
		}
		};
		var fields = [
			// filterable fields
			{name: 'NAMA TDC', type: 'string', filterable: true, columnLabelable: true},
			{name: 'DIVISI', type: 'string', filterable: true},
			{name: 'TGL EVENT', type: 'date', filterable: true},
			{name: 'NAMA MARKETING',  type: 'string', filterable: true},
			{name: 'NAMA EVENT', type: 'string', filterable: true},
			{name: 'LOKASI PENJUALAN', type: 'date', filterable: true},

			// psuedo fields
			{name: 'QTY 5K', type: 'integer', filterable: true},
			{name: 'QTY 10K', type: 'integer', filterable: true},
			{name: 'QTY 20K', type: 'integer', filterable: true},

			// summary fields
			{name: 'QTY 25K',     type: 'integer',  rowLabelable: false},
			{name: 'QTY 50K',     type: 'integer',  rowLabelable: false},
			{name: 'QTY 100K',    type: 'integer',  rowLabelable: false},
			{name: 'MOUNT BULK', type: 'integer', rowLabelable: false, summarizable: 'sum', displayFunction: value => accounting.formatMoney(value)},
			{name: 'MOUNT DIGITAL',  type: 'integer',  filterable: true, summarizable: 'sum', displayFunction: value => accounting.formatMoney(value)},
			{name: 'MOUNT TCASH',      type: 'integer',   filterable: true, summarizable: 'sum', displayFunction: value => accounting.formatMoney(value)},
			{name: 'QTY LOW NSB',      type: 'integer',   filterable: true},
			{name: 'QTY MIDDLE NSB',      type: 'integer',   filterable: true},
			{name: 'QTY HIGH NSB',      type: 'integer',   filterable: true},
			{name: 'QTY AS NSB',      type: 'integer',   filterable: true},
			{name: 'QTY SIMPATI NSB',      type: 'integer',   filterable: true},
			{name: 'QTY LOOP NSB',      type: 'integer',   filterable: true}
		]

		function setupPivot(input){
			input.callbacks = {afterUpdateResults: function(){
			$('#results > table').dataTable({
				"sDom": "<'row'<'span6'l><'span6'f>>t<'row'<'span6'i><'span6'p>>",
				"iDisplayLength": 10,
				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
				"sPaginationType": "bootstrap",
				"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
				}
			});
			}};
			$('#pivot-demo').pivot_display('setup', input);
		};

		$(document).ready(function() {

			setupPivot({json: dataStr, fields: fields, rowLabels:["NAMA TDC", "MOUNT BULK", "MOUNT DIGITAL", "MOUNT TCASH"]})

			// prevent dropdown from closing after selection
			$('.stop-propagation').click(function(event){
				event.stopPropagation();
			});

			// **Sexy** In your console type pivot.config() to view your current internal structure (the full initialize object).  Pass it to setup and you have a canned report.
			$('#ar-aged-balance').click(function(event){
				$('#pivot-demo').pivot_display('reprocess_display', {rowLabels:["employer"], columnLabels:["age_bucket"], summaries:["balance"]})
			});

			$('#acme-detail-report').click(function(event){
				$('#pivot-demo').pivot_display('reprocess_display', {filters:{"employer":"Acme Corp"},rowLabels:["city","last_name","first_name","state","invoice_date"]})
			});

			$('#miami-invoice-detail').click(function(event){
				$('#pivot-demo').pivot_display('reprocess_display', {"filters":{"city":"Miami"},"rowLabels":["last_name","first_name","employer","invoice_date"],"summaries":["payment_amount"]})
			});
		});
	</script>

</body>

</html>



