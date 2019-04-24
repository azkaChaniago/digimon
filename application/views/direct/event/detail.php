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
                            <h2>Detail Event</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td>Nama Event<td>
                                    <th><?php echo $event->nama_event ?></th>
                                    <td>Nama TDC<td>
                                    <th><?php echo $event->nama_tdc ?></th>
                                </tr>
                                <tr>
                                    <td>Divisi<td>
                                    <th><?php echo $event->divisi ?></th>
                                    <td>Tanggal Event<td>
                                    <th><?php echo $event->tgl_event ?></th>
                                </tr>
                                <tr>
                                    <td>Lokasi Penjualan<td>
                                    <th><?php echo $event->lokasi_penjualan ?></th>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $event->nama_marketing ?></th>
                                </tr>
                                <tr>
                                    <td>QTY 5k<td>
                                    <th><?php echo $event->qty_5k ?></th>
                                    <td>QTY 10k<td>
                                    <th><?php echo $event->qty_10k ?></th>
                                </tr>
                                <tr>
                                    <td>QTY 20k<td>
                                    <th><?php echo $event->qty_20k ?></th>
                                    <td>QTY 25k<td>
                                    <th><?php echo $event->qty_25k ?></th>
                                </tr>
                                <tr>
                                    <td>QTY 50k<td>
                                    <th><?php echo $event->qty_50k ?></th>
                                    <td>QTY 100k<td>
                                    <th><?php echo $event->qty_100k ?></th>
                                </tr>
                                <tr>
                                    <td>Mount Bulk<td>
                                    <th><?php echo $event->mount_bulk ?></th>
                                    <td>Mount Legacy<td>
                                    <th><?php echo $event->mount_legacy ?></th>
                                </tr>
                                <tr>
                                    <td>Mount Digital<td>
                                    <th><?php echo $event->mount_digital ?></th>
                                    <td>Mount Tcash<td>
                                    <th><?php echo $event->mount_tcash ?></th>
                                </tr>
                                <tr>
                                    <td>Foto Kegiatan<td>
                                    <th><img src="<?php echo base_url('upload/' . $event->foto_kegiatan) ?>" class="img img-responsive" width="50"></th>
                                    <td>Nama Pengguna<td>
                                    <th><?php echo $event->nama_user ?></th>
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
