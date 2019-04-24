<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("indirect/_parts/navbar.php") ?>
	
	<?php $this->load->view("indirect/_parts/sidebar.php") ?>

	<section class="content">
	<?php if($this->session->flashdata('error')): ?>
	<div class="alert alert-danger">
		<?php print_r( $this->session->flashdata('error')) ?>
	</div>
	<?php endif; ?>
	<div class="container-fluid">
		<!-- DataTables -->
		<div class="container-fluid">
			<!-- DataTables -->
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-md-6"><h2>Laporan</h2></div>
					</div>			
				</div>
				<div class="body">
					<?php isset($pivot) ? print_r($pivot) : ""; ?>
					<div class="row">
						<form id="monthform" action="<?php echo site_url('indirect/laporan/exportpdf') ?>" method='post'>
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
								<input type="submit" class="btn btn-danger" value="PDF" id="kirim" name="pdf" formtarget="_blank"/>
								<input type="submit" class="btn btn-success" value="XLSX" id="kirim"name="xls" formtarget="_blank"/>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<!-- /#wrapper -->

	<?php $this->load->view("indirect/_parts/modal.php") ?>

	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>
		// $(document).ready(function() {
		// 	$('#result').dataTable({
		// 		"ajax": {
		// 			url: "<?php echo site_url('indirect/laporan/getreport') ?>",
		// 			type: 'GET'
		// 		}
		// 	})
		// })

		// $(document).ready(function(){
		// 	$('#kirim').click(function() {				
		// 		var start = $('#start').val();
		// 		var end = $('#end').val();
				
		// 		$.ajax({
		// 			url: '<?php echo site_url('indirect/laporan/getpivot') ?>',
		// 			type: 'POST',
		// 			async: true,
		// 			dataType: 'JSON',
		// 			data: {start:start, end:end},
		// 			success: function(response) {
		// 				console.log(response)
		// 				var html = '';
		// 				var i;
		// 				for (i=0; i<data.lenght; i++){
		// 					html += '<tr>' +
		// 							'<td>'+data[i].kode_marketing+'</td>'+
		// 							'</tr>';
		// 				}
		// 				$('tbody').html(html);
		// 			},
		// 			error: function(xhr, status, error) {
		// 				var err = eval("(" + xhr.responseText + ")");
		// 				alert(err.Message);
		// 			}
		// 		})
		// 	})
		// })
	</script>

</body>

</html>
