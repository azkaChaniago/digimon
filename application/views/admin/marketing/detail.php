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
                        <h2 class="text-center">Detail Marketing</h2>
                        <a href="<?php echo site_url('admin/marketing') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
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
