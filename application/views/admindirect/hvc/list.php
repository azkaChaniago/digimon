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
						<form action="<?php echo site_url('admindirect/hvc/fetchperiode') ?>" method="post">
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
						<div class="btn-group" role="group">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Column Label Fields
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu stop-propagation"><div id="column-label-fields"></div></ul>
							</div>
						</div>
						<div class="btn-group" role="group">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Summary Fields
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu stop-propagation"><div id="summary-fields"></div></ul>
							</div>
						</div>						
					</div>					
				</div>
				</div>
			</div>

			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<h2>HVC</h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6" style='text-align: right'>							
							<!-- <h2><a href="<?php echo site_url('admindirect/hvc/add') ?>" class="btn btn-warning waves-effect"><i class="material-icons">add</i>
							<span>Tambah</span></a></h2> -->
						</div> 						
					</div>
				</div>

				<div class="body">
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

		const data = <?= $json ?>;
		const field = [Object.keys(data[0]).map( k => k.replace(/_/g, ' ').toUpperCase())];
		console.log(field)
		const dataVal = data.map(({nama_tdc, tgl_hvc, nama_marketing, nama_mercent, longlat_lokasi_mercent, latitude_lokasi_mercent, alamat_hvc, qty_5k, qty_10k, qty_20k, qty_25k, qty_50k, qty_100k, mount_bulk, qty_low_nsb, qty_middle_nsb, qty_high_nsb, qty_as_nsb, qty_simpati_nsb, qty_loop_nsb, keterangan_kegiatan, nama_user}) => field.push([nama_tdc, tgl_hvc, nama_marketing, nama_mercent, longlat_lokasi_mercent, latitude_lokasi_mercent, alamat_hvc, parseInt(qty_5k), parseInt(qty_10k), parseInt(qty_20k), parseInt(qty_25k), parseInt(qty_50k), parseInt(qty_100k), parseInt(mount_bulk), parseInt(qty_low_nsb), parseInt(qty_middle_nsb), parseInt(qty_high_nsb), parseInt(qty_as_nsb), parseInt(qty_simpati_nsb), parseInt(qty_loop_nsb), keterangan_kegiatan, nama_user]));

		let dataStr = JSON.stringify(field);

		const fields = [
			{name:'NAMA TDC', type:'string', filterable:true},
			{name:'TGL HVC', type:'date', filterable:true},
			{name:'NAMA MARKETING', type:'string', filterable:true},
			{name:'NAMA MERCENT', type:'string', filterable:true},
			{name:'LONGLAT LOKASI MERCENT', type:'string', filterable:true},
			{name:'LATITUDE LOKASI MERCENT', type:'string', filterable:true},
			{name:'ALAMAT HVC', type:'string', filterable:true},
			{name:'QTY 5K', type:'integer', filterable:true},
			{name:'QTY 10K', type:'integer', filterable:true},
			{name:'QTY 20K', type:'integer', filterable:true},
			{name:'QTY 25K', type:'integer', filterable:true},
			{name:'QTY 50K', type:'integer', filterable:true},
			{name:'QTY 100K', type:'integer', filterable:true},
			{name:'MOUNT BULK', type:'integer', filterable:true, displayFunction: value => accounting.formatMoney(value)},
			{name:'QTY LOW NSB', type:'integer', filterable:true},
			{name:'QTY MIDDLE NSB', type:'integer', filterable:true},
			{name:'QTY HIGH NSB', type:'integer', filterable:true},
			{name:'QTY AS NSB', type:'integer', filterable:true},
			{name:'QTY SIMPATI NSB', type:'integer', filterable:true},
			{name:'QTY LOOP NSB', type:'integer', filterable:true},
			{name:'KETERANGAN KEGIATAN', type:'string', filterable:true},
			{name:'NAMA USER', type:'string', filterable:true},
			
			{name:'MOUNT BULK SUM', type:'integer', dataSource: 'MOUNT BULK', rowLabelable: false, summarizable: 'sum', displayFunction: value => accounting.formatMoney(value)}
		];		

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

			setupPivot({json: dataStr, fields: fields, rowLabels:["NAMA TDC"], summaries:["MOUNT BULK SUM"]})

			// prevent dropdown from closing after selection
			$('.stop-propagation').click(function(event){
				event.stopPropagation();
			});

			// **Sexy** In your console type pivot.config() to view your current internal structure (the full initialize object).  Pass it to setup and you have a canned report.
			// $('#ar-aged-balance').click(function(event){
			// 	$('#pivot-demo').pivot_display('reprocess_display', {rowLabels:["employer"], columnLabels:["age_bucket"], summaries:["balance"]})
			// });

			// $('#acme-detail-report').click(function(event){
			// 	$('#pivot-demo').pivot_display('reprocess_display', {filters:{"employer":"Acme Corp"},rowLabels:["city","last_name","first_name","state","invoice_date"]})
			// });

			// $('#miami-invoice-detail').click(function(event){
			// 	$('#pivot-demo').pivot_display('reprocess_display', {"filters":{"city":"Miami"},"rowLabels":["last_name","first_name","employer","invoice_date"],"summaries":["payment_amount"]})
			// });
		});
	</script>

</body>

</html>
