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
		<!-- <?php if ($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?= $this->session->flashdata('error'); ?>
		</div>
		<?php endif; ?> -->
			<!-- Card  -->
			<div class="card">
				<div class="header">
					<h2><a href="<?= site_url('indirect/historiorder') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
					<span>Kembali<span></a></h2>
				</div>
				<div class="body">
					<form action="<?php base_url('indirect/historiorder/add') ?>" id="form_advanced_validation" method="post" enctype="multipart/form-data" autocomplete="on">
					
						<div class="form-group form-float">
							<div class="form-line" id="bs_datepicker_container">
								<input class="form-control <?= form_error('tanggal') ? 'is-invalid':'' ?>" type="text" name="tanggal" placeholder="Tanggal" required/>
								<!-- <label class="form-label" for="tanggal">Tanggal*</label> -->
							</div>
						</div>

						<div class="form-group">
							<select class="form-control show-tick" name="kode_marketing" data-live-search="true" id="category">
								<option value="">--- PILIH CANVASSER ---</option>
								<?php foreach($marketing as $can) : ?>
									<option value="<?= $can->kode_marketing ?>" ><?= $can->nama_marketing ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<!-- <div class="form-group">
							<select class="form-control show-tick" name="id_outlet" data-live-search="true" id="sub_category">
								<option value="">--- PILIH OUTLET ---</option>								
							</select>
						</div> -->
						<div class="form-group" id="sub_category">
						</div>

						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?= form_error('as') ? 'is-invalid':'' ?>"
								type="text" name="as" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="as">AS*</label>
							</div>
						</div>

						<div class="form-group form-float">						
							<div class="form-line">
							<input class="form-control <?= form_error('simpati') ? 'is-invalid':'' ?>"
								type="text" name="simpati"  onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="simpati">Simpati*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?= form_error('loop') ? 'is-invalid':'' ?>"
								type="text" name="loop" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="loop">Loop*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?= form_error('nsb') ? 'is-invalid':'' ?>"
								type="text" name="nsb" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="nsb">NSB*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?= form_error('mkios_reguler') ? 'is-invalid':'' ?>"
								type="text" name="mkios_reguler" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="mkios_reguler">MKIOS Regular*</label>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?= form_error('mkios_bulk') ? 'is-invalid':'' ?>"
								type="text" name="mkios_bulk" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="mkios_bulk">MKIOS Bulk*</label>
							</div>
						</div>
						<!-- <div class="form-group form-float">
							<div class="form-line">
							<input class="form-control <?= form_error('gt_pulsa') ? 'is-invalid':'' ?>"
								type="text" name="gt_pulsa" onkeypress="return isNumberKey(event)" required/>
								<label class="form-label" for="gt_pulsa">GT Pulsa*</label>
							</div>
						</div>						 -->
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
		// const marketing = JSON.parse('<?= json_encode($marketing) ?>');
		// const outlet = JSON.parse('<?= json_encode($outlet) ?>');
		$(document).ready(function(){
             $('#category').change(function(){ 
                let id = $(this).val();
                $.ajax({
                    url : "<?= site_url('indirect/historiorder/getoutlet');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){                         
                        let options = `<select class="form-control show-tick" name="kode_marketing" data-live-search="true" id="category"><option> -- PILIH OUTLET -- </option>`;
                        let i;
                        for (i=0; i<data.length; i++){
                            options += `<option value='${data[i].id_outlet}'>${data[i].nama_outlet}</option>`;
                        }
						options += `</select>`;
						console.log(options);
                        $('#sub_category').html(options); 
						console.log($('#sub_category'));
                    }
                });
                return false;
            }); 
             
        });


	</script>
</body>
</html>
