<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
	<style>
		/* The message box is shown when the user clicks on the password field */
		#message {
			display:none;
			background: #f1f1f1;
			color: #000;
			position: relative;
			padding: 20px;
			margin-top: 10px;
		}
		#message p {
			padding: 10px 35px;
			font-size: 18px;
		}
		/* Add a green text color and a checkmark when the requirements are right */
		.valid {
			color: green;
		}
		.valid:before {
			position: relative;
			left: -35px;
			content: "&#10004;";
		}
		/* Add a red text color and an "x" icon when the requirements are wrong */
		.invalid {
			color: red;
		}
		.invalid:before {
			position: relative;
			left: -35px;
			content: "&#10006;";
		}
	</style>
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
								<input class="form-control" type="text" name="kode_user" required/>
									<label class="form-label" for="kode_user">Kode User*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control" type="text" name="nama_user" required/>
									<label class="form-label" for="nama_user">Nama User*</label>
								</div>
							</div>

							<!-- <div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="text" name="level" required/>
									<label class="form-label" for="level">Level*</label>
								</div>
							</div> -->

							<div class="form-group form-float">
								<!-- <p>With Search Bar</p> -->
								<select class="form-control show-tick" name="level" data-live-search="true">
									<option value="">--- Pilih TDC ---</option>
									<option value="ADMIN">ADMIN</option>
									<option value="ADM_DIRECT">VIEW DIRECT</option>
									<option value="ADM_INDIRECT">VIEW INDIRECT</option>
									<option value="DIRECT">DIRECT</option>
									<option value="INDIRECT">INDIRECT</option>
								</select>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="password" name="password" id="pwd" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
									<label class="form-label" for="password">Password*</label>
								</div>
                            </div>

							<div id="message">
								<h3>Password must contain the following:</h3>
								<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
								<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
								<p id="number" class="invalid">A <b>number</b></p>
								<p id="length" class="invalid">Minimum <b>8 characters</b></p>
							</div>
                            
                            <div class="form-group form-float">
								<div class="form-line">
								<input class="form-control"	type="password" name="password-repeat" required/>
									<label class="form-label" for="password-repeat">Ulangi Password*</label>
								</div>
							</div>

							<div class="form-group form-float">
								<!-- <p>With Search Bar</p> -->
								<select class="form-control show-tick" 
								name="kode_tdc" data-live-search="true">
									<option value="">--- Pilih TDC ---</option>
									<?php foreach($tdc as $e) : ?>
										<option value="<?php echo $e->kode_tdc ?>" ><?php echo $e->nama_tdc ?></option>
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
	<script>
		var myInput = document.getElementById("psw");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		console.log(myInput.value);

		myInput.onfocus = function() {
			document.getElementById("message").style.display = "block";
		}

		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function() {
			document.getElementById("message").style.display = "none";
		}

		// When the user starts to type something inside the password field
		myInput.onkeyup = function() {
			// Validate lowercase letters
			var lowerCaseLetters = /[a-z]/g;
			if (myInput.value.match(lowerCaseLetters)) {
				letter.classList.remove("invalid");
				letter.classList.add("valid");
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
			}
			// Validate capital letters
			var upperCaseLetters = /[A-Z]/g;
			if(myInput.value.match(upperCaseLetters)) {
				capital.classList.remove("invalid");
				capital.classList.add("valid");
			} else {
				capital.classList.remove("valid");
				capital.classList.add("invalid");
			}

			// Validate numbers
			var numbers = /[0-9]/g;
			if(myInput.value.match(numbers)) {
				number.classList.remove("invalid");
				number.classList.add("valid");
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
			}

			// Validate length
			if(myInput.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
			}
		}
	</script>
</body>
</html>
