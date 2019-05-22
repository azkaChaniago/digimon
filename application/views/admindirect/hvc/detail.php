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
                        <a href="<?php echo site_url('admindirect/hvc') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>Nama TDC<td>
                                <th><?php echo $hvc->nama_tdc ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $hvc->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Tanggal HVC<td>
                                <th><?php echo $hvc->tgl_hvc ?></th>
                                <td>Nama Mercentt<td>
                                <th><?php echo $hvc->nama_mercent ?></th>
                            </tr>
                            <tr>
                                <td>Longlat Lokasi Mercent<td>
                                <th><?php echo $hvc->longlat_lokasi_mercent ?></th>
                                <td>Latitude Lokasi Mercent<td>
                                <th><?php echo $hvc->latitude_lokasi_mercent ?></th>
                            </tr>
                            <tr>
                                <td>QTY 5k<td>
                                <th><?php echo $hvc->qty_5k ?></th>
                                <td>QTY 10k<td>
                                <th><?php echo $hvc->qty_10k ?></th>
                            </tr>
                            <tr>
                                <td>QTY 20k<td>
                                <th><?php echo $hvc->qty_20k ?></th>
                                <td>QTY 25k<td>
                                <th><?php echo $hvc->qty_25k ?></th>
                            </tr>
                            <tr>
                                <td>QTY 50k<td>
                                <th><?php echo $hvc->qty_50k ?></th>
                                <td>QTY 100k<td>
                                <th><?php echo $hvc->qty_100k ?></th>
                            </tr>
                            <tr>
                                <td>Mount Bulk<td>
                                <th><?php echo $hvc->mount_bulk ?></th>
                                <td>QTY Low NSB<td>
                                <th><?php echo $hvc->qty_low_nsb ?></th>
                            </tr>
                            <tr>
                                <td>QTY Middle NSB<td>
                                <th><?php echo $hvc->qty_middle_nsb ?></th>
                                <td>QTY High NSB<td>
                                <th><?php echo $hvc->qty_high_nsb ?></th>
                            </tr>
                            <tr>
                                <td>QTY AS NSB<td>
                                <th><?php echo $hvc->qty_as_nsb ?></th>
                                <td>QTY Loop NSB<td>
                                <th><?php echo $hvc->qty_loop_nsb ?></th>
                            </tr>
                            <tr>
                                <td>Keterangan Kegiatan<td>
                                <th><?php echo $hvc->keterangan_kegiatan ?></th>
                                <td>Nama Pengguna<td>
                                <th><?php echo $hvc->nama_user ?></th>
                            </tr>
                            <tr>
                                <td>Foto Kegiatan<td>
                                <th colspan="3">
                                    <?php 
                                    if ($hvc->foto_kegiatan != null && json_decode($hvc->foto_kegiatan) != JSON_ERROR_NONE) :
                                        $i = 0;
                                        foreach (json_decode($hvc->foto_kegiatan) as $im):?>
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url('upload/hvc/'.$im->file_name) ?>" class="img img-responsive" />
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
                                            <img src="<?php echo base_url('upload/hvc/default.png') ?>" class="img img-responsive" />
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
