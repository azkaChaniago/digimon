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
                    <?php if ($this->uri->segment(3) == 'marketdetail') : ?>   
                    <h2 class="text-center">Detail Marketshare Reguler</h2>
                    <a href="<?php echo site_url('indirect/sharereguler/market') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                    <span>Kembali<span></a>
                    <?php elseif ($this->uri->segment(3) == 'rechargedetail') : ?>   
                    <h2 class="text-center">Detail Rechargeshare Reguler</h2>
                    <a href="<?php echo site_url('indirect/sharereguler/recharge') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                    <span>Kembali<span></a>
                    <?php elseif ($this->uri->segment(3) == 'salesdetail') : ?>   
                    <h2 class="text-center">Detail Salesshare Reguler</h2>
                    <a href="<?php echo site_url('indirect/sharereguler/sales') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                    <span>Kembali<span></a>
                    <?php endif; ?>
                </div>
                <div class="body">
                    <?php if ($this->uri->segment(3) == 'marketdetail') : ?>
                    <table class="table table-stripped">
                        <tr>                                    
                            <td>Tanggal</td>
                            <th><?php echo $sharereg->tanggal ?></th>
                            <td>Kabupaten</td>
                            <th><?php echo $sharereg->kabupaten ?></th>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <th><?php echo $sharereg->kecamatan ?></th>
                            <td>QTY Telkomsel Marketshare</td>
                            <th><?php echo $sharereg->qty_telkomsel_marketshare ?></th>
                        </tr>
                        <tr>
                            <td>QTY Indosat Marketshare</td>
                            <th><?php echo $sharereg->qty_indosat_marketshare ?></th>
                            <td>QTY XL Marketshare</td>
                            <th><?php echo $sharereg->qty_xl_marketshare ?></th>
                        </tr>
                        <tr>
                            <td>QTY Tri Marketshare</td>
                            <th><?php echo $sharereg->qty_tri_marketshare ?></th>
                            <td>QTY Smartfrend Marketshare</td>
                            <th><?php echo $sharereg->qty_smartfrend_marketshare ?></th>
                        </tr>
                        <tr>
                            <td>Nama User</td>
                            <th colspan="3"><?php echo $sharereg->nama_user ?></th>
                        </tr>
                    </table>
                    <?php elseif ($this->uri->segment(3) == 'rechargedetail') : ?>
                    <table class="table table-stripped">
                        <tr>                                    
                            <td>Tanggal</td>
                            <th><?php echo $sharereg->tanggal ?></th>
                            <td>Kabupaten</td>
                            <th><?php echo $sharereg->kabupaten ?></th>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <th><?php echo $sharereg->kecamatan ?></th>
                            <td>Mount Telkomsel Recharge Share</td>
                            <th><?php echo $sharereg->mount_telkomsel_rechargeshare ?></th>
                        </tr>                                
                        <tr>
                            <td>Mount Indosat Recharge Share</td>
                            <th><?php echo $sharereg->mount_indosat_rechargeshare ?></th>                        
                            <td>Mount XL Recharge Share</td>
                            <th><?php echo $sharereg->mount_xl_rechargeshare ?></th>
                        </tr>                                
                        <tr>
                            <td>Mount Tri Recharge Share</td>
                            <th><?php echo $sharereg->mount_tri_rechargeshare ?></th>
                            <td>Mount Smartfrend Recharge Share</td>
                            <th><?php echo $sharereg->mount_smartfrend_rechargeshare ?></th>
                        </tr>
                        <tr>
                            <td>Nama User</td>
                            <th colspan="3"><?php echo $sharereg->nama_user ?></th>
                        </tr>
                    </table>
                    <?php elseif ($this->uri->segment(3) == 'salesdetail') : ?>
                    <table class="table table-stripped">
                        <tr>                                    
                            <td>Tanggal</td>
                            <th><?php echo $sharereg->tanggal ?></th>
                            <td>Kabupaten</td>
                            <th><?php echo $sharereg->kabupaten ?></th>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <th><?php echo $sharereg->kecamatan ?></th>
                            <td>QTY Telkomsel Sales Share</td>
                            <th><?php echo $sharereg->qty_telkomsel_salesshare ?></th>
                        </tr>
                        <tr>
                            <td>QTY Indosat Sales Share</td>
                            <th><?php echo $sharereg->qty_indosat_salesshare ?></th>
                            <td>QTY XL Sales Share</td>
                            <th><?php echo $sharereg->qty_xl_salesshare ?></th>
                        </tr>
                        <tr>
                            <td>QTY Tri Sales Share</td>
                            <th><?php echo $sharereg->qty_tri_salesshare ?></th>
                            <td>QTY Smartfrend Sales Share</td>
                            <th><?php echo $sharereg->qty_smartfrend_salesshare ?></th>
                        </tr>
                        <tr>
                            <td>Nama User</td>
                            <th colspan="3"><?php echo $sharereg->nama_user ?></th>
                        </tr>
                    </table>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        </div>
    </section>
	<!-- /#wrapper -->
	<?php $this->load->view("indirect/_parts/js.php") ?>

</body>

</html>
