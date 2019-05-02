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
                        <h2 class="text-center">Detail Sekolah</h2>
                        <a href="<?php echo site_url('direct/marketsharesekolah') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>NPSN<td>
                                <th><?php echo $marketshare->npsn ?></th>
                                <td>Nama Sekolah<td>
                                <th><?php echo $marketshare->nama_sekolah ?></th>
                            </tr>
                            <tr>
                                <td>Nama TDC<td>
                                <th><?php echo $marketshare->nama_tdc ?></th>
                                <td>Tanggal<td>
                                <th><?php echo $marketshare->tgl_marketshare ?></th>
                            </tr>
                            <tr>
                                <td>QTY Simpati<td>
                                <th><?php echo $marketshare->qty_simpati ?></th>
                                <td>QTY AS<td>
                                <th><?php echo $marketshare->qty_as ?></th>
                            </tr>
                            <tr>
                                <td>QTY Loop<td>
                                <th><?php echo $marketshare->qty_loop ?></th>
                                <td>QTY Mentari<td>
                                <th><?php echo $marketshare->qty_mentari ?></th>
                            </tr>
                            <tr>
                                <td>QTY IM3<td>
                                <th><?php echo $marketshare->qty_im3 ?></th>
                                <td>QTY XL<td>
                                <th><?php echo $marketshare->qty_xl ?></th>
                            </tr>
                            <tr>
                                <td>QTY Axsis<td>
                                <th><?php echo $marketshare->qty_axsis ?></th>
                                <td>QTY Tri<td>
                                <th><?php echo $marketshare->qty_tri ?></th>
                            </tr>
                            <tr>
                                <td>QTY Smartfrend<td>
                                <th><?php echo $marketshare->qty_smartfrend ?></th>
                                <td>Nama User<td>
                                <th><?php echo $marketshare->nama_user ?></th>
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
