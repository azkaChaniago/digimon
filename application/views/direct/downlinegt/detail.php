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
                            <h2>Detail Downline GT  </h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td>Nama TDC<td>
                                    <th><?php echo $downlinegt->nama_tdc ?></th>
                                    <td>Divisi<td>
                                    <th><?php echo $downlinegt->divisi ?></th>
                                </tr>
                                <tr>
                                    <td>Tanggal<td>
                                    <th><?php echo $downlinegt->tanggal ?></th>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $downlinegt->nama_marketing ?></th>
                                </tr>
                                <tr>
                                    <td>Alamat<td>
                                    <th><?php echo $downlinegt->alamat?></th>
                                    <td>Nomor GT<td>
                                    <th><?php echo $downlinegt->nomor_gt ?></th>
                                </tr>
                                <tr>
                                    <td>Deposit<td>
                                    <th><?php echo $downlinegt->deposit?></th>
                                    <td>Nama Pengguna<td>
                                    <th><?php echo $downlinegt->nama_user ?></th>
                                </tr>
                                <tr>
                                    <td>Foto Kegiatan<td>
                                    <th><img src="<?php echo base_url('upload/downlinegt/' . $downlinegt->foto) ?>" class="img img-responsive" width="50"></th>
                                    <td><td>
                                    <th></th>
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
