<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body class="theme-red">

    <?php $this->load->view("indirect/_parts/navbar.php") ?>
    <?php $this->load->view("indirect/_parts/sidebar.php") ?>
	<section class="content">	
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="header">   
                        <h2 class="text-center">Detail Target Assigment</h2>
                        <a href="<?php echo site_url('indirect/distribusicollector') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>Tanggal<td>
                                <th><?php echo $distribusi->tanggal ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $distribusi->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>New Opening Outlet<td>
                                <th><?php echo $distribusi->new_rs_non_outlet ?></th>
                                <td>NSB<td>
                                <th><?php echo $distribusi->nsb ?></th>
                            </tr>
                            <tr>
                                <td>GT Pulsa<td>
                                <th><?php echo $distribusi->gt_pulsa ?></th>
                                <td>Collecting<td>
                                <th><?php echo $distribusi->collecting ?></th>
                            </tr>
                            <tr>
                                <td>Nama User<td>
                                <th><?php echo $distribusi->nama_user ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
		</div>
    </section>
	<!-- /#wrapper -->
	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
