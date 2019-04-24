<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_parts/navbar.php") ?>
	<div id="wrapper">

        

		<?php $this->load->view("admin/_parts/sidebar.php") ?>        

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_parts/breadcrumb.php") ?>

				<div class="container">
                
                    <div class="card mb-3">
                        <div class="card-header">   
                            <h2>Profil Pengguna</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td>ID Outlet<td>
                                    <th><?php echo $outlet->id_outlet ?></th>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $outlet->nama_marketing ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Outlet<td>
                                    <th><?php echo $outlet->nama_outlet ?></th>
                                    <td>Hari Kunjungan<td>
                                    <th><?php echo $outlet->hari_kunjungan ?></th>
                                </tr>
                                <tr>
                                    <td>Kabupaten<td>
                                    <th><?php echo $outlet->kabupaten ?></th>
                                    <td>Nama TDC<td>
                                    <th><?php echo $outlet->nama_tdc ?></th>
                                </tr>
                                <tr>
                                    <td>Kecamatan<td>
                                    <th><?php echo $outlet->kecamatan ?></th>
                                    <td>Nomor RS<td>
                                    <th><?php echo $outlet->nomor_rs ?></th>
                                </tr>
                                <tr>
                                    <td>Alamat<td>
                                    <th><?php echo $outlet->alamat ?></th>
                                    <td>Kategori Outlet<td>
                                    <th><?php echo $outlet->kategori_outlet ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Pemilik<td>
                                    <th><?php echo $outlet->nama_pemilik ?></th>
                                    <td>Galeri Foto<td>
                                    <th><?php echo $outlet->galeri_foto ?></th>
                                </tr>
                                <tr>
                                    <td>No HP<td>
                                    <th><?php echo $outlet->no_hp ?></th>
                                    <td>Nama Pengguna<td>
                                    <th><?php echo $outlet->kode_user ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_parts/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/_parts/modal.php") ?>

	<?php $this->load->view("admin/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
