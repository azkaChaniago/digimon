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
                        <a href="<?php echo site_url('direct/penjualanharian') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>Nama TDC<td>
                                <th><?php echo $penjualanharian->nama_tdc ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $penjualanharian->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Divisi<td>
                                <th><?php echo $penjualanharian->divisi ?></th>
                                <td>Tanggal Event<td>
                                <th><?php echo $penjualanharian->tgl_penjualan ?></th>
                            </tr>
                            <tr>
                                <td>Lokasi Penjualan<td>
                                <th><?php echo $penjualanharian->lokasi_penjualan ?></th>
                                <td><td>
                                <th></th>
                            </tr>
                            <tr>
                                <td>QTY 5k<td>
                                <th><?php echo $penjualanharian->qty_5k ?></th>
                                <td>QTY 10k<td>
                                <th><?php echo $penjualanharian->qty_10k ?></th>
                            </tr>
                            <tr>
                                <td>QTY 20k<td>
                                <th><?php echo $penjualanharian->qty_20k ?></th>
                                <td>QTY 25k<td>
                                <th><?php echo $penjualanharian->qty_25k ?></th>
                            </tr>
                            <tr>
                                <td>QTY 50k<td>
                                <th><?php echo $penjualanharian->qty_50k ?></th>
                                <td>QTY 100k<td>
                                <th><?php echo $penjualanharian->qty_100k ?></th>
                            </tr>
                            <tr>
                                <td>Mount Bulk<td>
                                <th><?php echo $penjualanharian->mount_bulk ?></th>
                                <td>Mount Legacy<td>
                                <th><?php echo $penjualanharian->mount_legacy ?></th>
                            </tr>
                            <tr>
                                <td>Paket Max Digital<td>
                                <th><?php echo $penjualanharian->paket_max_digital ?></th>
                                <td>No MSDN Digital<td>
                                <th><?php echo $penjualanharian->no_msdn_digital ?></th>
                            </tr>
                            <tr>
                                <td>Price Digital<td>
                                <th><?php echo $penjualanharian->price_digital ?></th>
                                <td>MSDN Tcash<td>
                                <th><?php echo $penjualanharian->msdn_tcash ?></th>
                            </tr>
                            <tr>
                                <td>Cashin Tcash<td>
                                <th><?php echo $penjualanharian->cashin_tcash ?></th>
                                <td>Status Tcash<td>
                                <th><?php echo $penjualanharian->status_tcash ?></th>
                            </tr>
                            <tr>
                                <td>Foto Kegiatan<td>
                                <th colspan="3">
                                    <?php 
                                    $i = 0;
                                    // print_r(($penjualanharian->foto_kegiatan));
                                    foreach (json_decode($penjualanharian->foto_kegiatan) as $im):?>
                                        <div class="col-md-3">
                                            <img src="<?php echo base_url('upload/penjualanharian/'.$im->file_name) ?>" class="img img-responsive" />
                                        </div>
                                        <?php
                                        $i++;
                                        if ($i == 4) {
                                            echo "<div class='clearfix' ></div>";
                                            $i = 0;
                                        } 
                                    endforeach; ?>
                                    
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
