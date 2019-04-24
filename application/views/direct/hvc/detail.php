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
                                    <th><?php echo $hvc->nama_tdc ?></th>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $hvc->nama_marketing ?></th>
                                </tr>
                                <tr>
                                    <td>Tanggal HVC<td>
                                    <th><?php echo $hvc->tgl_hvc ?></th>
                                    <td>Nama Mercentt<td>
                                    <th><?php echo $hvc->nama_mercent ?></th>
                                </tr>
                                <tr>
                                    <td>Longlat Lokasi Mercent<td>
                                    <th><?php echo $hvc->longlat_lokasi_mercent ?></th>
                                    <td>Latitude Lokasi Mercent<td>
                                    <th><?php echo $hvc->latitude_lokasi_mercent ?></th>
                                </tr>
                                <tr>
                                    <td>QTY 5k<td>
                                    <th><?php echo $hvc->qty_5k ?></th>
                                    <td>QTY 10k<td>
                                    <th><?php echo $hvc->qty_10k ?></th>
                                </tr>
                                <tr>
                                    <td>QTY 20k<td>
                                    <th><?php echo $hvc->qty_20k ?></th>
                                    <td>QTY 25k<td>
                                    <th><?php echo $hvc->qty_25k ?></th>
                                </tr>
                                <tr>
                                    <td>QTY 50k<td>
                                    <th><?php echo $hvc->qty_50k ?></th>
                                    <td>QTY 100k<td>
                                    <th><?php echo $hvc->qty_100k ?></th>
                                </tr>
                                <tr>
                                    <td>Mount Bulk<td>
                                    <th><?php echo $hvc->mount_bulk ?></th>
                                    <td>QTY Low NSB<td>
                                    <th><?php echo $hvc->qty_low_nsb ?></th>
                                </tr>
                                <tr>
                                    <td>QTY Middle NSB<td>
                                    <th><?php echo $hvc->qty_middle_nsb ?></th>
                                    <td>QTY High NSB<td>
                                    <th><?php echo $hvc->qty_high_nsb ?></th>
                                </tr>
                                <tr>
                                    <td>QTY AS NSB<td>
                                    <th><?php echo $hvc->qty_as_nsb ?></th>
                                    <td>QTY Loop NSB<td>
                                    <th><?php echo $hvc->qty_loop_nsb ?></th>
                                </tr>
                                <tr>
                                    <td>Keterangan Kegiatan<td>
                                    <th><?php echo $hvc->keterangan_kegiatan ?></th>
                                    <td>Nama Pengguna<td>
                                    <th><?php echo $hvc->nama_user ?></th>
                                </tr>
                                <tr>
                                    <td>Foto Kegiatan<td>
                                    <th colspan="3"><img src="<?php echo base_url('upload/hvc' . $hvc->foto_kegiatan) ?>" class="img img-responsive" width="50"></th>
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
