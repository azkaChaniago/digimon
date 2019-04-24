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
		<?php if ($this->session->flashdata('error')) : ?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('error') ?>
		</div>
		<?php endif; ?>
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('indirect/galeri') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('indirect/galeri/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on" enctype="multipart/form-data">
						<div class="col-md-6">

							<div class="form-group form-float">
								<div class="form-line" id="bs_datepicker_container">
									<input class="form-control" type="text" name="tanggal"  required/>
									<label class="form-label" for="tanggal">Tanggal*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<select class="form-control show-tick" name="keterangan" data-live-search="true" required>
									<option value="">--- KETERANGAN ---</option>
									<option value="BRANDING OUTLET">BRANDING OUTLET</option>
									<option value="INFO KOMPETITOR">INFO KOMPETITOR</option>
									<option value="BC & TANDEM">BC & TANDEM</option>
								</select>
							</div>

							<div class="form-group">
								<div class="form-line">
									<input class="form-control" name="images[]" type="file" multiple required/>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
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

		var $sel = $("<select class='form-control show-tick' name='kabupaten' data-live-search='true' required>");
		$sel.appendTo("#kabupaten");

		$.each(kab, function(j, option) {
			var $option = $("<option>", {text: option.value});
			$option.appendTo($sel);
		});

		
		var kec = [
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
		$select.appendTo("#kecamatan");

		$.each(kec, function(i, optgroups) {
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
