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
                        <a href="<?php echo site_url('admindirect/mercent') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>Nama TDC<td>
                                <th><?php echo $mercent->nama_tdc ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $mercent->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Tanggal HVC<td>
                                <th><?php echo $mercent->tanggal ?></th>
                                <td>Nama Mercentt<td>
                                <th><?php echo $mercent->nama_mercent ?></th>
                            </tr>
                            <tr>
                                <td>Longtitude<td>
                                <th><?php echo $mercent->longtitude ?></th>
                                <td>Latitude<td>
                                <th><?php echo $mercent->latitude ?></th>
                            </tr>
                            <tr>
                                <td>Nama Pic<td>
                                <th><?php echo $mercent->nama_pic ?></th>
                                <td>No HP Pic<td>
                                <th><?php echo $mercent->no_hp_pic ?></th>
                            </tr>
                            <tr>
                                <td>No KTP<td>
                                <th><?php echo $mercent->no_ktp ?></th>
                                <td>NPWP<td>
                                <th><?php echo $mercent->npwp ?></th>
                            </tr>
                            <tr>
                                <td>Alamat<td>
                                <th><?php echo $mercent->alamat ?></th>
                                <td>Produk Diajukan<td>
                                <th><?php echo $mercent->produk_diajukan ?></th>
                            </tr>
                            <tr>
                                <td>Foto Kegiatan<td>
                                <th colspan="3">
                                <?php 
                                    if ($mercent->foto_mercent) :
                                        $i = 0;
                                        foreach (json_decode($mercent->foto_mercent) as $im):?>
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url('upload/mercent/'.$im->file_name) ?>" class="img img-responsive" />
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
                                            <img src="<?php echo base_url('upload/mercent/default.png') ?>" class="img img-responsive" />
                                        </div>
                                    <?php endif;?>
                                </th>
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
