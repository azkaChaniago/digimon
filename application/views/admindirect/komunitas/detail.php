<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

    <?php $this->load->view("admindirect/_parts/navbar.php") ?>
    <?php $this->load->view("admindirect/_parts/sidebar.php") ?>
	<section class="content">	
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="header">   
                        <h2 class="text-center">Detail Target Assigment</h2>
                        <a href="<?php echo site_url('admindirect/komunitas') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>  
                                <td>Nama TDC<td>
                                <th colspan="4"><?php echo $komunitas->nama_tdc ?></th>
                            </tr>
                            <tr>
                                <td>Nama Petugas<td>
                                <th><?php echo $komunitas->nama_petugas ?></th>
                                <td>Nama Komunitas<td>
                                <th><?php echo $komunitas->nama_komunitas ?></th>
                            </tr>
                            <tr>
                                <td>Nama Ketua<td>
                                <th><?php echo $komunitas->nama_ketua ?></th>
                                <td>No HP Ketua<td>
                                <th><?php echo $komunitas->no_hpketua ?></th>
                            </tr>
                            <tr>
                                <td>Alamat<td>
                                <th><?php echo $komunitas->alamat ?></th>
                                <td>Jumlah Anggota<td>
                                <th><?php echo $komunitas->jumlah_anggota ?></th>
                            </tr>
                            <tr>
                                <td>Nama Sosmed<td>
                                <th><?php echo $komunitas->nama_sosmed ?></th>
                                <td>Nama User<td>
                                <th><?php echo $komunitas->nama_user ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
		</div>
    </section>
	<!-- /#wrapper -->
	<?php $this->load->view("admindirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
