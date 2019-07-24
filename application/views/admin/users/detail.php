<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
</head>

<body class="theme-red">

    <?php $this->load->view("admin/_parts/navbar.php") ?>
    <?php $this->load->view("admin/_parts/sidebar.php") ?>
	<section class="content">	
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="header">   
                        <h2 class="text-center">Detail User</h2>
                        <a href="<?php echo site_url('admin/user') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>
                                <td>Kode Pengguna<td>
                                <th><?php echo $user->kode_user ?></th>
                            </tr>
                            <tr>
                                <td>Nama Pengguna<td>
                                <th><?php echo $user->nama_user ?></th>
                            </tr>
                            <tr>
                                <td>Level<td>
                                <th><?php echo $user->level ?></th>
                            </tr>
                            <tr>
                                <td>TDC<td>
                                <th><?php echo $user->nama_tdc ?></th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
		</div>
    </section>
	<!-- /#wrapper -->
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
