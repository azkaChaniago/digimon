<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("direct/_parts/head.php") ?>
</head>

<body class="theme-red">

	<?php $this->load->view("direct/_parts/navbar.php") ?>
	<?php $this->load->view("direct/_parts/sidebar.php") ?>

	<section class="content">
		<div class="container-fluid">
			<?php if ($this->session->userdata('errors')) :?>
				<div>
					<?php echo $this->session->userdata('errors')  ?>
				</div>
			<?php endif;?>
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('direct/sekolah') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('direct/sekolah/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="npsn" required/>
										<label class="form-label" for="npsn">NPSN*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<select class="form-control show-tick" 
									name="kode_tdc" data-live-search="true">
										<option value="">--- PILIH TDC ---</option>
										<?php foreach($tdc as $t) : ?>
											<option value="<?php echo $t->kode_tdc ?>" ><?php echo $t->nama_tdc ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="nama_sekolah" required/>
										<label class="form-label" for="nama_sekolah">Nama Sekolah*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div id="kabupaten"></div>
								</div>
								<div class="form-group form-float">
									<div id="somewhere"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="alamat" required/>
										<label class="form-label" for="alamat">Alamat*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="jumlah_siswa" required/>
										<label class="form-label" for="jumlah_siswa">Jumlah Siswa*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="latitude" required/>
										<label class="form-label" for="latitude">Latitude*</label>
									</div>
								</div>

								<div class="form-group form-float">
									<div class="form-line">
										<input class="form-control" type="text" name="longtitude" required/>
										<label class="form-label" for="longtitude">Longtitude*</label>
									</div>
								</div> 

								<div class="form-group form-float">
									<select class="form-control show-tick" 
									name="kode_marketing" data-live-search="true">
										<option value="">--- PILIH MARKETING ---</option>
										<?php foreach($marketing as $m) : ?>
											<option value="<?php echo $m->kode_marketing ?>" ><?php echo $m->nama_marketing ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
						</div>
					</form>

				</div>

			</div>
			
		</div>
		<!-- /.container-fluid -->
	</section>
	<?php $this->load->view("direct/_parts/modal.php") ?>
	<?php $this->load->view("direct/_parts/js.php") ?>

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
