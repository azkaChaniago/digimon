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
                            <h2>Profil TDC</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td>Nama TDC<td>
                                    <th><?php echo $tdc->nama_tdc ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Manager<td>
                                    <th><?php echo $tdc->manager ?></th>
                                </tr>
                                <tr>
                                    <td>No Telepon<td>
                                    <th><?php echo $tdc->no_telepon ?></th>
                                </tr>
                                <tr>
                                    <td>No Callcenter<td>
                                    <th><?php echo $tdc->no_callcenter ?></th>
                                </tr>
                                <tr>
                                    <td>Alamat<td>
                                    <th><?php echo $tdc->alamat ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Pengguna<td>
                                    <th><?php echo $tdc->nama_user ?></th>
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
