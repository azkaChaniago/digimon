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
                    <h2 class="text-center">Detail Share Broadband</h2>
                    <a href="<?php echo site_url('indirect/sharebroadband') ?>" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                    <span>Kembali<span></a>
                </div>
                <div class="body">
                    <table class="table table-stripped">
                        <tr>                                    
                            <td>Tanggal<td>
                            <th><?php echo $sharebroad->tanggal ?></th>
                            <td>Nama Marketing<td>
                            <th><?php echo $sharebroad->kecamatan ?></th>
                        </tr>
                        <tr>
                            <td>QTY Telkomsel Marketshare<td>
                            <th><?php echo $sharebroad->qty_telkomsel_marketshare ?></th>
                            <td>QTY Indosat Marketshare<td>
                            <th><?php echo $sharebroad->qty_indosat_marketshare ?></th>
                        </tr>
                        <tr>
                            <td>QTY XL Marketshare<td>
                            <th><?php echo $sharebroad->qty_xl_marketshare ?></th>
                            <td>QTY Tri Marketshare<td>
                            <th><?php echo $sharebroad->qty_tri_marketshare ?></th>
                        </tr>
                        <tr>
                            <td>QTY Smartfrend Marketshare<td>
                            <th><?php echo $sharebroad->qty_smartfrend_marketshare ?></th>
                            <td>Nama User<td>
                            <th><?php echo $sharebroad->nama_user ?></th>
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
