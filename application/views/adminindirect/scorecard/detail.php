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
                    <h2 class="text-center">Detail Score Card</h2>
                    <a href="<?php echo site_url('indirect/scorecard') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                    <span>Kembali<span></a>
                </div>
                <div class="body">
                    <table class="table table-stripped">
                        <tr>                                    
                            <td>Tanggal<td>
                            <th><?php echo $scorecard->tanggal ?></th>
                            <td>Nama Marketing<td>
                            <th><?php echo $scorecard->nama_marketing ?></th>
                        </tr>
                        <tr>
                            <td>New Opening Outlet<td>
                            <th><?php echo $scorecard->new_opening_outlet ?></th>
                            <td>Sales Perdana<td>
                            <th><?php echo $scorecard->sales_perdana ?></th>
                        </tr>
                        <tr>
                            <td>Outlet Aktif Digital<td>
                            <th><?php echo $scorecard->outlet_aktif_digital ?></th>
                            <td>MKIOS Bulk<td>
                            <th><?php echo $scorecard->mkios_bulk ?></th>
                        </tr>
                        <tr>
                            <td>Outlet Aktif Voucher<td>
                            <th><?php echo $scorecard->outlet_aktif_voucher ?></th>                            
                            <td>NSB<td>
                            <th><?php echo $scorecard->nsb ?></th>
                        </tr>
                        <tr>
                            <td>Outlet Aktif Tcash<td>
                            <th><?php echo $scorecard->outlet_aktif_bang_tcash ?></th>
                            <td>GT Pulsa<td>
                            <th><?php echo $scorecard->gt_pulsa ?></th>
                        </tr>
                        <tr>                            
                            <td>Nama User<td>
                            <th><?php echo $scorecard->nama_user ?></th>
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
