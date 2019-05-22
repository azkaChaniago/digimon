<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("direct/_parts/head.php") ?>
</head>

<body class="theme-red">

    <?php $this->load->view("direct/_parts/navbar.php") ?>
    <?php $this->load->view("direct/_parts/sidebar.php") ?>
	<section class="content">	
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="header">   
                        <h2 class="text-center">Detail Target Assigment</h2>
                        <a href="<?php echo site_url('direct/saleling') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>
                                <td>Nama TDC<td>
                                <th><?php echo $saleling->nama_tdc ?></th>
                                <td>Divisi<td>
                                <th><?php echo $saleling->divisi ?></th>
                            </tr>
                            <tr>
                                <td>Tanggal<td>
                                <th><?php echo $saleling->tanggal ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $saleling->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Lokasi Saleling<td>
                                <th><?php echo $saleling->lokasi_saleling?></th>
                                <td>Nama Pengguna<td>
                                <th><?php echo $saleling->nama_user ?></th>
                            </tr>
                            <tr>
                                <td>Foto Kegiatan<td>
                                <th colspan="3">
                                <?php 
                                    if ($saleling->foto_kegiatan != null && json_decode($saleling->foto_kegiatan) != JSON_ERROR_NONE) :
                                        $i = 0;
                                        foreach (json_decode($saleling->foto_kegiatan) as $im):?>
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url('upload/saleling/'.$im->file_name) ?>" class="img img-responsive" />
                                            </div>
                                            <?php
                                            $i++;
                                            if ($i == 4) {
                                                echo "<div class='clearfix' ></div>";
                                                $i = 0;
                                            } 
                                        endforeach; 
                                    else : ?>
                                        <div class="col-md-3">
                                            <img src="<?php echo base_url('upload/saleling/default.png') ?>" class="img img-responsive" />
                                        </div>
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
		</div>
    </section>
	<!-- /#wrapper -->
	<?php $this->load->view("direct/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
