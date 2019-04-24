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

			<!-- Card  -->
			<div class="card">
				<div class="header">
					<?php if ($this->uri->segment(3) == 'marketadd') : ?>
					<h2><a href="<?php echo site_url('indirect/sharereguler/market') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
					<?php elseif ($this->uri->segment(3) == 'rechargeadd') : ?>
					<h2><a href="<?php echo site_url('indirect/sharereguler/recharge') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>	
					<?php elseif ($this->uri->segment(3) == 'salesadd') : ?>
					<h2><a href="<?php echo site_url('indirect/sharereguler/sales') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
					<?php endif; ?>
				</div>
				<div class="body">
					<?php if ($this->uri->segment(3) == 'marketadd') : ?>
					<form action="<?php base_url('indirect/sharereguler/marketadd') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
					<?php elseif ($this->uri->segment(3) == 'rechargeadd') : ?>
					<form action="<?php base_url('indirect/sharereguler/rechargeadd') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
					<?php elseif ($this->uri->segment(3) == 'salesadd') : ?>
					<form action="<?php base_url('indirect/sharereguler/salesadd') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
					<?php endif; ?>
						<div class="row clearfix">
						<div class="col-md-4">
							<div class="form-group form-float">
								<div class="form-line" id="bs_datepicker_container">
									<input class="form-control" type="text" name="tanggal" required/>
									<label class="form-label" for="tanggal">Tanggal*</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div id="kabupaten"></div>
						</div>
						<div class="col-md-4">
							<div id="somewhere"></div>
						</div>
						</div>
						<?php if ($this->session->flashdata('error')): ?>
							<div class="alert alert-danger" >
								<?php echo $this->session->flashdata('error') ?>
							</div>
						<?php endif; ?>
						<div class="row clearfix">
							<?php if ($this->uri->segment(3) == 'marketadd') : ?>
							<div class="col-md-12">
								<h2 class="card-inside-title">Marketshare</h2>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_simpati_marketshare" id="simpati_ms" onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_simpati_marketshare">QTY Simpati Marketshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_as_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_as_marketshare">QTY AS Marketshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_loop_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_loop_marketshare">QTY Loop Marketshare*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_mentari_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_mentari_marketshare">QTY Mentari Marketshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_im3_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_im3_marketshare">QTY IM3 Marketshare*</label>
									</div>
								</div>
								<!-- <div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_indosat_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_indosat_marketshare">QTY Indosat Marketshare*</label>
									</div>
								</div> -->
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_xl_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_xl_marketshare">QTY XL Marketshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_tri_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_tri_marketshare">QTY Tri Marketshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_smartfrend_marketshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_smartfrend_marketshare">QTY smartfrend Marketshare*</label>
									</div>
								</div>
							</div>
							<?php elseif ($this->uri->segment(3) == 'rechargeadd') : ?>
							<div class="col-md-12">
								
								<h2 class="card-inside-title">Rechargeshare</h2>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_simpati_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_simpati_rechargeshare">Mount Simpati Recharge*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_as_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_as_rechargeshare">Mount AS Recharge*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_loop_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_loop_rechargeshare">Mount Loop Recharge*</label>
									</div>
								</div>
								<!-- <div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_telkomsel_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_telkomsel_rechargeshare">Mount Telkomsel Recharge*</label>
									</div>
								</div> -->
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_mentari_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_mentari_rechargeshare">Mount Mentari Recharge*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_im3_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_im3_rechargeshare">Mount IM3 Recharge*</label>
									</div>
								</div>
								<!-- <div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_indosat_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_indosat_rechargeshare">Mount Indosat Recharge*</label>
									</div>
								</div> -->
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_xl_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_xl_rechargeshare">Mount XL Recharge*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_tri_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_tri_rechargeshare">Mount Tri Recharge*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="mount_smartfrend_rechargeshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="mount_smartfrend_rechargeshare">Mount Smartfrend Recharge*</label>
									</div>
								</div>
							</div>
							<?php elseif ($this->uri->segment(3) == 'salesadd') : ?>
							<div class="col-md-12">
								
								<h2 class="card-inside-title">Salesshare</h2>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_simpati_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_simpati_salesshare">QTY Simpati Salesshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_as_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_as_salesshare">QTY AS Salesshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_loop_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_loop_salesshare">QTY Loop Salesshare*</label>
									</div>
								</div>
								<!-- <div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_telkomsel_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_telkomsel_salesshare">QTY Telkomsel Salesshare*</label>
									</div>
								</div> -->
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_mentari_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_mentari_salesshare">QTY Mentari Salesshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_im3_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_im3_salesshare">QTY IM3 Salesshare*</label>
									</div>
								</div>
								<!-- <div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_indosat_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_indosat_salesshare">QTY Indosat Salesshare*</label>
									</div>
								</div> -->
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_xl_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_xl_salesshare">QTY XL Salesshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_tri_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_tri_salesshare">QTY Tri Salesshare*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control uang" name="qty_smartfrend_salesshare"  onkeypress="return isNumberKey(event)" required>
										<label class="form-label" for="qty_smartfrend_salesshare">QTY Smartfrend Salesshare*</label>
									</div>
								</div>
							</div>
							<?php endif; ?>
						</div>
					
						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
					</form>

				</div>

			</div>
			
		</div>
		<!-- /.container-fluid -->
	</section>
	<?php $this->load->view("indirect/_parts/modal.php") ?>
	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>
		var kab = [
			{"value": "PILIH KABUPATEN"},
			{"value": "BANDAR LAMPUNG"},
			{"value": "LAMPUNG SELATAN"},
			{"value": "LAMPUNG TIMUR"},
			{"value": "PESAWARAN"},];

		var $sel = $("<select class='form-control show-tick' id='kab' name='kabupaten' data-live-search='true' required>");
		$sel.appendTo("#kabupaten");

		$.each(kab, function(j, option) {
			var $option = $("<option>", {text: option.value});
			$option.appendTo($sel);
		});

		var json = [
			{"":[
				{"value": "PILIH KECAMATAN"}]},
			{"BANDAR LAMPUNG":[
				{"value": "BUMI WARAS"}, {"value": "ENGGAL"}, {"value": "KEDAMAIAN"}, {"value": "KEDATON"}, {"value": "KEMILING"}, {"value": "LABUHAN RATU"}, {"value": "LANGKAPURA"}, {"value": "PANJANG"}, {"value": "RAJABASA"}, {"value": "SUKABUMI"}, {"value": "SUKARAME"}, {"value": "TANJUNG KARANG BARAT"}, {"value": "TANJUNG KARANG PUSAT"}, {"value": "TANJUNG KARANG TIMUR"}, {"value": "TANJUNG SENENG"}, {"value": "TELUK BETUNG BARAT"}, {"value": "TELUK BETUNG TIMUR"}, {"value": "TELUK BETUNG SELATAN"}, {"value": "TELUK BETUNG UTARA"}, {"value": "WAY HALIM"}, ]},
			{"LAMPUNG SELATAN":[
				{"value": "BAKAUHENI"}, {"value": "CANDIPURO"}, {"value": "JATI AGUNG"}, {"value": "KALIANDA"},
				{"value": "KATIBUNG"}, {"value": "KETAPANG"}, {"value": "MERBAU MATARAM"}, {"value": "NATAR"},
				{"value": "PENENGAHAN"}, {"value": "PALAS"}, {"value": "RAJABASA"}, {"value": "SIDOMULYO"},
				{"value": "SRAGI"}, {"value": "SUKARAJA"}, {"value": "TANJUNG BINTANG"}, {"value": "TANUNG SARI"},
				{"value": "WAY PANJI"}, {"value": "WAY SULAN"},]},
			{"LAMPUNG TIMUR":[
				{"value": "JABUNG"}, {"value": "MARGA SEKAMPUNG"}, {"value": "PASIR SAKTI"}, {"value": "SEKAMPUNG UDIK"},
				{"value": "WAWAY KARYA"},]},
			{"PESAWARAN":[
				{"value": "TEGINENENG"},]},	
			];	
		
				
		var $select = $("<select class='form-control show-tick' name='kecamatan' data-live-search='true' required>");
		$select.appendTo("#somewhere");
		
		$.each(json, function(i, optgroups) {
			$.each(optgroups, function(groupName, options) {
				var $optgroup = $("<optgroup>", {label: groupName});
				$optgroup.appendTo($select);

				$.each(options, function(j, option) {
					var $option = $("<option>", {text: option.value});
					$option.appendTo($optgroup);
				});
			});
		});
	</script>

</body>
</html>

