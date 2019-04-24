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
                                    <td>NPSN<td>
                                    <th><?php echo $sekolah->npsn ?></th>
                                    <td>Nama TDC<td>
                                    <th><?php echo $sekolah->nama_tdc ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Sekolah<td>
                                    <th><?php echo $sekolah->nama_sekolah ?></th>
                                    <td>Alamat<td>
                                    <th><?php echo $sekolah->alamat ?></th>
                                </tr>
                                <tr>
                                    <td>Kabupaten<td>
                                    <th><?php echo $sekolah->kabupaten ?></th>
                                    <td>Kecamatan<td>
                                    <th><?php echo $sekolah->kecamatan ?></th>
                                </tr>
                                <tr>
                                    <td>Longtitude<td>
                                    <th><?php echo $sekolah->longtitude ?></th>
                                    <td>Latitude<td>
                                    <th><?php echo $sekolah->latitude ?></th>
                                </tr>
                                <tr>
                                    <td>Jumlah Siswa<td>
                                    <th><?php echo $sekolah->jumlah_siswa ?></th>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $sekolah->nama_marketing ?></th>
                                </tr>
                                <tr>
                                    <td>Nama User<td>
                                    <th><?php echo $sekolah->nama_user ?></th>
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
