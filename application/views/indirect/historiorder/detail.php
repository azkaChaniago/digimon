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
                    <h2 class="text-center">Detail Histori Order</h2>
                        <a href="<?php echo site_url('indirect/historiorder') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                        <span>Kembali<span></a>
                    </div>
                    <div class="body">
                        <table class="table table-stripped">
                            <tr>                                    
                                <td>Tanggal<td>
                                <th><?php echo $histori->tanggal ?></th>
                                <td>Nama Marketing<td>
                                <th><?php echo $histori->nama_marketing ?></th>
                            </tr>
                            <tr>
                                <td>Nama Outlet<td>
                                <th><?php echo $histori->nama_outlet ?></th>
                                <td>AS<td>
                                <th><?php echo $histori->as ?></th>
                            </tr>
                            <tr>
                                <td>Simpati<td>
                                <th><?php echo $histori->simpati ?></th>
                                <td>Loop<td>
                                <th><?php echo $histori->loop ?></th>
                            </tr>
                            <tr>
                                <td>NSB<td>
                                <th><?php echo $histori->nsb ?></th>
                                <td>MKIOS Reguler<td>
                                <th><?php echo $histori->mkios_reguler ?></th>
                            </tr>
                            <tr>
                                <td>MKIOS Bulk<td>
                                <th><?php echo $histori->mkios_bulk ?></th>
                                <td>Nama User<td>
                                <th><?php echo $histori->nama_user ?></th>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- /#wrapper -->
	<?php $this->load->view("indirect/_parts/js.php") ?>

</body>

</html>
