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
		<?php if ($this->session->flashdata('error')) : ?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('error') ?>
		</div>
		<?php endif; ?>
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?php echo site_url('admin/outlet') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('admin/outlet/edit') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on" enctype="multipart/form-data">
						<div class="col-md-6">
							<!-- <div class="form-group form-float">
								<div class="form-line"> -->
								<input class="form-control" type="hidden" name="id_outlet" value="<?php echo $outlet->id_outlet ?>" required/>
									<!-- <label class="form-label" for="id_outlet">ID Outlet*</label>
								</div>
							</div> -->

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="nama_outlet" value="<?php echo $outlet->nama_outlet ?>" required/>
									<label class="form-label" for="nama_outlet">Nama Outlet*</label>
								</div>
							</div>

							<div class="form-group">
								<div id="kabupaten">
								</div>
							</div>

							<div class="form-group">
								<div id="kecamatan">
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="text" name="alamat" value="<?php echo $outlet->alamat ?>" required/>
									<label class="form-label" for="alamat">Alamat*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="text" name="nama_pemilik" value="<?php echo $outlet->nama_pemilik ?>" required/>
									<label class="form-label" for="nama_pemilik">Nama Pemilik*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="no_hp" onkeypress="return isNumberKey(event)" value="<?php echo $outlet->no_hp ?>" required/>
									<label class="form-label" for="no_hp">No HP*</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-float">
								<!-- <p>With Search Bar</p> -->
								<select class="form-control show-tick" 
								name="kode_marketing" data-live-search="true">
									<option value="">--- Pilih Marketing ---</option>
									<?php foreach($marketing as $can) : ?>
										<option value="<?php echo $can->kode_marketing ?>" value="<?php echo $can->kode_marketing ?>" <?php echo $can->kode_marketing == $outlet->kode_marketing ? "selected" : "" ?>><?php echo $can->nama_marketing ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="hari_kunjungan" value="<?php echo $outlet->hari_kunjungan ?>" required/>
									<label class="form-label" for="hari_kunjungan">Hari Kunjungan*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="nomor_rs" value="<?php echo $outlet->nomor_rs ?>" required/>
									<label class="form-label" for="nomor_rs">Nomor RS*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<!-- <p>With Search Bar</p> -->
								<select class="form-control show-tick" 
								name="kode_tdc" data-live-search="true">
									<option value="">--- Pilih TDC ---</option>
									<?php foreach($tdc as $can) : ?>
										<option value="<?php echo $can->kode_tdc ?>" <?php echo $can->kode_tdc == $outlet->kode_tdc ? "selected" : "" ?>><?php echo $can->nama_tdc ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="text" name="kategori_outlet" value="<?php echo $outlet->kategori_outlet ?>" required/>
									<label class="form-label" for="kategori_outlet">Kategori Outlet*</label>
								</div>
							</div>

							<div class="form-group">
								<div class="form-line">
									<input class="form-control" name="images[]" type="file" multiple />
								</div>
							</div>

							<input type="text" value="<?php print_r(json_decode($outlet->galeri_foto)) ?>" name="galeri_lama"/>


						</div>
						<div class="clearfix"></div>
						<input class="btn btn-primary waves-effect" type="submit" name="btn" value="Simpan" />
					</form>

				</div>

			</div>
			
		</div>
		<!-- /.container-fluid -->
	</section>
	<?php $this->load->view("admin/_parts/modal.php") ?>
	<?php $this->load->view("admin/_parts/js.php") ?>

	<script>
		var curr_kab = '<?php echo $outlet->kabupaten ?>';
		var kab = [
			{"value": "PILIH KABUPATEN"},
			{"value": "BANDAR LAMPUNG"},
			{"value": "LAMPUNG SELATAN"},
			{"value": "LAMPUNG TIMUR"},
			{"value": "PESAWARAN"},	
			];	
		var $sel = $("<select class='form-control show-tick' name='kabupaten' data-live-search='true' required>");
		$sel.appendTo("#kabupaten");

		$.each(kab, function(j, option) {
			if (option.value == curr_kab){
				var $option = $("<option>", {text: option.value, selected: true});				
			} else {
				var $option = $("<option>", {text: option.value});
			}
			$option.appendTo($sel);
		});

		var curr_kec = '<?php echo $outlet->kecamatan ?>';
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
					if (option.value == curr_kec){
						var $option = $("<option>", {text: option.value, selected: true});
					} else {
						var $option = $("<option>", {text: option.value});	
					}
					$option.appendTo($optgroup);
				});
			});
		});
	</script>
</body>
</html>
