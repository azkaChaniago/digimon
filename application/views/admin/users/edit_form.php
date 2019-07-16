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
					<h2><a href="<?php echo site_url('admin/user') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('admin/user/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
						
							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="kode_user" value="<?php echo $user->kode_user ?>" readonly required/>
									<label class="form-label" for="kode_user">Kode User*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="nama_user" value="<?php echo $user->nama_user ?>" required/>
									<label class="form-label" for="nama_user">Nama User*</label>
								</div>
							</div>

							<!-- <div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="text" name="level" value="<?php echo $user->level ?>" required/>
									<label class="form-label" for="level">Level*</label>
								</div>
							</div> -->

							<div class="form-group form-float">
								<!-- <p>With Search Bar</p> -->
								<select class="form-control show-tick" name="level" data-live-search="true">
									<option value="">--- Pilih TDC ---</option>
									<option value="ADMINISTRATOR" <?= $user->level == 'ADMIN' ? "selected" : "" ?>>ADMIN</option>
									<option value="ADM_DIRECT" <?= $user->level == 'VIEW DIRECT' ? "selected" : "" ?>>VIEW DIRECT</option>
									<option value="ADM_INDIRECT" <?= $user->level == 'VIEW INDIRECT' ? "selected" : "" ?>>VIEW INDIRECT</option>
									<option value="DIRECT" <?= $user->level == 'DIRECT' ? "selected" : "" ?>>DIRECT</option>
									<option value="INDIRECT" <?= $user->level == 'INDIRECT' ? "selected" : "" ?>>INDIRECT</option>
								</select>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="password" name="password" value="<?php echo $user->password ?>" required/>
									<label class="form-label" for="password">Password*</label>
								</div>
                            </div>
                            <div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="password" name="password-repeat" value="<?php echo $user->password ?>" required/>
									<label class="form-label" for="password-repeat">Ulangi Password*</label>
								</div>
							</div>
							<!-- <?php print_r(array_merge($tdc, $empty)) ?> -->
							<div class="form-group form-float">
								<select class="form-control show-tick" 
								name="kode_tdc" data-live-search="true">
									<option value="">--- Pilih TDC ---</option>
									<?php foreach($tdc as $e) : ?>
										<?php 
										if ($e->kode_user == '' || $e->kode_user == null || $e->kode_user == $user->kode_user) 
										{
											if ($e->kode_user == $user->kode_user)
											{
												echo "<option value='".$e->kode_tdc."' selected>". $e->nama_tdc . "</option>";
											}
											else
											{
												echo "<option value='".$e->kode_tdc."'>". $e->nama_tdc . "</option>"; 
											} 
										} 
										?>
									<?php endforeach; ?>
								</select>
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
		var kab = [
			{"value": "Pilih Kabupaten"},
			{"value": "Bandar Lampung"},
			{"value": "Lampung Selatan"},
			{"value": "Lampung Timur"},
			{"value": "Pesawaran"},	
			];	
		var $sel = $("<select class='form-control show-tick' name='kabupaten' data-live-search='true' required>");
		$sel.appendTo("#kabupaten");

		$.each(kab, function(j, option) {
			var $option = $("<option>", {text: option.value});
			$option.appendTo($sel);
		});


		var kec = [
			{"":[
				{"value": "Pilih Kecamatan"}]},
			{"Bandar Lampung":[
				{"value": "Bumi Waras"}, {"value": "Enggal"}, {"value": "Kedamaian"}, {"value": "Kedaton"}, {"value": "Kemiling"}, {"value": "Labuhan Ratu"}, {"value": "Langkapura"}, {"value": "Panjang"}, {"value": "Rajabasa"}, {"value": "Sukabumi"}, {"value": "Sukarame"}, {"value": "Tanjung Karang Barat"}, {"value": "Tanjung Karang Pusat"}, {"value": "Tanjung Karang Timur"}, {"value": "Tanjung Seneng"}, {"value": "Teluk Betung Barat"}, {"value": "Teluk Betung Timur"}, {"value": "Teluk Betung Selatan"}, {"value": "Teluk Betung Utara"}, {"value": "Way Halim"}, ]},
			{"Lampung Selatan":[
				{"value": "Bakauheni"}, {"value": "Candipuro"}, {"value": "Jati Agung"}, {"value": "Kalianda"},
				{"value": "Katibung"}, {"value": "Ketapang"}, {"value": "Merbau Mataram"}, {"value": "Natar"},
				{"value": "Penengahan"}, {"value": "Palas"}, {"value": "Rajabasa"}, {"value": "Sidomulyo"},
				{"value": "Sragi"}, {"value": "Sukaraja"}, {"value": "Tanjung Bintang"}, {"value": "Tanung Sari"},
				{"value": "Way Panji"}, {"value": "Way Sulan"},]},
			{"Lampung Timur":[
				{"value": "Jabung"}, {"value": "Marga Sekampung"}, {"value": "Pasir Sakti"}, {"value": "Sekampung Udik"},
				{"value": "Waway Karya"},]},
			{"Pesawaran":[
				{"value": "Tegineneng"},]},	
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
