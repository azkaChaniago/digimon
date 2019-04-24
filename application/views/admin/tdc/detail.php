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
                        <h2 class="text-center">Profil TDC</h2>
                        <a href="<?php echo site_url('admin/tdc') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
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
