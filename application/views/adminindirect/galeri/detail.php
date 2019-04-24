<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("adminindirect/_parts/head.php") ?>
</head>

<body class="theme-red">

    <?php $this->load->view("adminindirect/_parts/navbar.php") ?>
    <?php $this->load->view("adminindirect/_parts/sidebar.php") ?>
	<section class="content">	
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="header">   
                        <h2 class="text-center">Detail Outlet</h2>
                        <a href="<?php echo site_url('adminindirect/outlet') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>
                                <td>ID Outlet<td>
                                <th><?php echo $outlet->id_outlet ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $outlet->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Nama Outlet<td>
                                <th><?php echo $outlet->nama_outlet ?></th>
                                <td>Hari Kunjungan<td>
                                <th><?php echo $outlet->hari_kunjungan ?></th>
                            </tr>
                            <tr>
                                <td>Kabupaten<td>
                                <th><?php echo $outlet->kabupaten ?></th>
                                <td>Nama TDC<td>
                                <th><?php echo $outlet->nama_tdc ?></th>
                            </tr>
                            <tr>
                                <td>Kecamatan<td>
                                <th><?php echo $outlet->kecamatan ?></th>
                                <td>Nomor RS<td>
                                <th><?php echo $outlet->nomor_rs ?></th>
                            </tr>
                            <tr>
                                <td>Alamat<td>
                                <th><?php echo $outlet->alamat ?></th>
                                <td>Kategori Outlet<td>
                                <th><?php echo $outlet->kategori_outlet ?></th>
                            </tr>
                            <tr>
                                <td>Nama Pemilik<td>
                                <th><?php echo $outlet->nama_pemilik ?></th>
                                <td>Nama Pengguna<td>
                                <th><?php echo $outlet->kode_user ?></th>
                            </tr>
                            <tr>
                                <td>No HP<td>
                                <th><?php echo $outlet->no_hp ?></th>
                            </tr>
                            <tr>
                                <td colspan="5">Galeri Foto<td>
                            </tr>
                            <tr>
                                <th colspan="5">
                                    <?php 
                                    $i = 0;
                                    foreach (json_decode($outlet->galeri_foto) as $im):?>
                                        <div class="col-md-3">
                                            <img src="<?php echo base_url('upload/outlet/'.$im->file_name) ?>" class="img img-responsive" />
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
	<?php $this->load->view("adminindirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
