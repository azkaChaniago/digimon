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
					<h2><a href="<?php echo site_url('indirect/sharebroadband') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('indirect/sharebroadband/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
						<div class="row clearfix">
							<div class="col-md-4">
								<div class="form-group form-float">
									<div class="form-line" id="bs_datepicker_container">
										<input class="form-control" type="text" name="tanggal" placeholder="Tanggal" required/>
										<!-- <label class="form-label" for="tanggal">Tanggal*</label> -->
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
						<!-- <div class="row clearfix"> -->
							<h2 class="card-inside-title">Marketshare</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control uang" name="qty_telkomsel_marketshare"  onkeypress="return isNumberKey(event)"  required>
									<label class="form-label" for="qty_telkomsel_marketshare">QTY Telkomsel Marketshare*</label>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control uang" name="qty_indosat_marketshare"  onkeypress="return isNumberKey(event)"  required>
									<label class="form-label" for="qty_indosat_marketshare">QTY Indosat Marketshare*</label>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control uang" name="qty_xl_marketshare"  onkeypress="return isNumberKey(event)"  required>
									<label class="form-label" for="qty_xl_marketshare">QTY XL Marketshare*</label>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control uang" name="qty_tri_marketshare"  onkeypress="return isNumberKey(event)"  required>
									<label class="form-label" for="qty_tri_marketshare">QTY Tri Marketshare*</label>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control uang" name="qty_smartfrend_marketshare"  onkeypress="return isNumberKey(event)"  required>
									<label class="form-label" for="qty_smartfrend_marketshare">QTY smartfrend Marketshare*</label>
								</div>
							</div>				
						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
					</form>
				<!-- </div> -->
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
