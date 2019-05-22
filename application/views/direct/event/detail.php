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
                        <a href="<?php echo site_url('direct/event') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>
                                <td>Nama Event<td>
                                <th><?php echo $event->nama_event ?></th>
                                <td>Nama TDC<td>
                                <th><?php echo $event->nama_tdc ?></th>
                            </tr>
                            <tr>
                                <td>Divisi<td>
                                <th><?php echo $event->divisi ?></th>
                                <td>Tanggal Event<td>
                                <th><?php echo $event->tgl_event ?></th>
                            </tr>
                            <tr>
                                <td>Lokasi Penjualan<td>
                                <th><?php echo $event->lokasi_penjualan ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $event->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>QTY 5k<td>
                                <th><?php echo $event->qty_5k ?></th>
                                <td>QTY 10k<td>
                                <th><?php echo $event->qty_10k ?></th>
                            </tr>
                            <tr>
                                <td>QTY 20k<td>
                                <th><?php echo $event->qty_20k ?></th>
                                <td>QTY 25k<td>
                                <th><?php echo $event->qty_25k ?></th>
                            </tr>
                            <tr>
                                <td>QTY 50k<td>
                                <th><?php echo $event->qty_50k ?></th>
                                <td>QTY 100k<td>
                                <th><?php echo $event->qty_100k ?></th>
                            </tr>
                            <tr>
                                <td>Mount Bulk<td>
                                <th><?php echo $event->mount_bulk ?></th>
                                <td>Mount Legacy<td>
                                <th><?php echo $event->mount_legacy ?></th>
                            </tr>
                            <tr>
                                <td>Mount Digital<td>
                                <th><?php echo $event->mount_digital ?></th>
                                <td>Mount Tcash<td>
                                <th><?php echo $event->mount_tcash ?></th>
                            </tr>
                            <tr>
                                <td>Foto Kegiatan<td>
                                <th colspan="3">
                                    <?php 
                                    if ($event->foto_kegiatan != null && json_decode($event->foto_kegiatan) != JSON_ERROR_NONE) :
                                        $i = 0;
                                        foreach (json_decode($event->foto_kegiatan) as $im):?>
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url('upload/event/'.$im->file_name) ?>" class="img img-responsive" />
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
