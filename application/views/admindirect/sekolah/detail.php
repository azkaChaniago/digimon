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
                        <h2 class="text-center">Detail Sekolah</h2>
                        <a href="<?php echo site_url('admindirect/sekolah') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>NPSN<td>
                                <th><?php echo $sekolah->npsn ?></th>
                                <td>Nama TDC<td>
                                <th><?php echo $sekolah->nama_tdc ?></th>
                            </tr>
                            <tr>
                                <td>Nama Sekolah<td>
                                <th><?php echo $sekolah->nama_sekolah ?></th>
                                <td>Alamat<td>
                                <th><?php echo $sekolah->alamat ?></th>
                            </tr>
                            <tr>
                                <td>Kabupaten<td>
                                <th><?php echo $sekolah->kabupaten ?></th>
                                <td>Kecamatan<td>
                                <th><?php echo $sekolah->kecamatan ?></th>
                            </tr>
                            <tr>
                                <td>Longtitude<td>
                                <th><?php echo $sekolah->longtitude ?></th>
                                <td>Latitude<td>
                                <th><?php echo $sekolah->latitude ?></th>
                            </tr>
                            <tr>
                                <td>Jumlah Siswa<td>
                                <th><?php echo $sekolah->jumlah_siswa ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $sekolah->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Nama User<td>
                                <th><?php echo $sekolah->nama_user ?></th>
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
