<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/direct/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/direct/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/direct/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/direct/_parts/breadcrumb.php") ?>

				<div class="container">
                    
                    <div class="card mb-3">
                        <div class="card-header">   
                            <h2>Detail HVC</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>                                    
                                    <td>Nama TDC<td>
                                    <th><?php echo $mercent->nama_tdc ?></th>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $mercent->nama_marketing ?></th>
                                </tr>
                                <tr>
                                    <td>Tanggal HVC<td>
                                    <th><?php echo $mercent->tanggal ?></th>
                                    <td>Nama Mercentt<td>
                                    <th><?php echo $mercent->nama_mercent ?></th>
                                </tr>
                                <tr>
                                    <td>Longtitude<td>
                                    <th><?php echo $mercent->longtitude ?></th>
                                    <td>Latitude<td>
                                    <th><?php echo $mercent->latitude ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Pic<td>
                                    <th><?php echo $mercent->nama_pic ?></th>
                                    <td>No HP Pic<td>
                                    <th><?php echo $mercent->no_hp_pic ?></th>
                                </tr>
                                <tr>
                                    <td>No KTP<td>
                                    <th><?php echo $mercent->no_ktp ?></th>
                                    <td>NPWP<td>
                                    <th><?php echo $mercent->npwp ?></th>
                                </tr>
                                <tr>
                                    <td>Alamat<td>
                                    <th><?php echo $mercent->alamat ?></th>
                                    <td>Produk Diajukan<td>
                                    <th><?php echo $mercent->produk_diajukan ?></th>
                                </tr>
                                <tr>
                                    <td>Foto Mercent<td>
                                    <th><img src="<?php echo base_url('upload/mercent/' . $mercent->foto_mercent) ?>" class="img img-responsive" width="50"></th>
                                    <td>Nama User<td>
                                    <th><?php echo $mercent->nama_user ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/direct/_parts/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/direct/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/direct/_parts/modal.php") ?>

	<?php $this->load->view("admin/direct/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
