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
                            <h2>Profil Marketing / Canvasser</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td>Nama Marketing<td>
                                    <th><?php echo $marketing->nama_marketing ?></th>
                                    <td>Nama TDC<td>
                                    <th><?php echo $marketing->nama_tdc ?></th>
                                </tr>
                                <tr>
                                    <td>Divisi<td>
                                    <th><?php echo $marketing->divisi ?></th>
                                    <td>Alamat<td>
                                    <th><?php echo $marketing->alamat ?></th>
                                </tr>
                                <tr>
                                    <td>MKIOS<td>
                                    <th><?php echo $marketing->mkios ?></th>
                                    <td>Alamat Email<td>
                                    <th><?php echo $marketing->email ?></th>
                                </tr>
                                <tr>
                                    <td>No HP<td>
                                    <th><?php echo $marketing->no_hp ?></th>
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
