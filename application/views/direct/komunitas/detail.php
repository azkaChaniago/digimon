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
                                    <th colspan="4"><?php echo $komunitas->nama_tdc ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Petugas<td>
                                    <th><?php echo $komunitas->nama_petugas ?></th>
                                    <td>Nama Komunitas<td>
                                    <th><?php echo $komunitas->nama_komunitas ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Ketua<td>
                                    <th><?php echo $komunitas->nama_ketua ?></th>
                                    <td>No HP Ketua<td>
                                    <th><?php echo $komunitas->no_hpketua ?></th>
                                </tr>
                                <tr>
                                    <td>Alamat<td>
                                    <th><?php echo $komunitas->alamat ?></th>
                                    <td>Jumlah Anggota<td>
                                    <th><?php echo $komunitas->jumlah_anggota ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Sosmed<td>
                                    <th><?php echo $komunitas->nama_sosmed ?></th>
                                    <td>Nama User<td>
                                    <th><?php echo $komunitas->nama_user ?></th>
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
