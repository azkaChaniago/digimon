<?php
if ($this->session->userdata('access') != 'direct' && $this->session->userdata('access') != 'DIRECT')
{
    $this->session->sess_destroy();
    redirect(site_url('login'));
}
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title><?php echo SITE_NAME ?></title>
<!-- Favicon-->
<link rel="icon" href="<?php echo base_url('assets/favicon.ico') ?>" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<link href="https://www.jsdelivr.com/package/npm/pdfjs-dist" />

<!-- Bootstrap Core Css -->
<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.css') ?>" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="<?php echo base_url('assets/plugins/node-waves/waves.css') ?>" rel="stylesheet" />

<!-- Animation Css -->
<link href="<?php echo base_url('assets/plugins/animate-css/animate.css') ?>" rel="stylesheet" />

<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') ?>" rel="stylesheet" />

<!-- Bootstrap DatePicker Css -->
<link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />

<!-- Wait Me Css -->
<link href="<?php echo base_url('assets/plugins/waitme/waitMe.css') ?>" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css') ?>" rel="stylesheet" />

<?php if ($this->uri->segment(2) == 'indirect'): ?>
    <!-- Morris Chart Css-->
    <link href="<?php echo base_url('assets/plugins/morrisjs/morris.css') ?>" rel="stylesheet" />
<?php endif; ?>

<!-- Sweet Alert Css -->
<link href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="<?php echo base_url('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') ?>" rel="stylesheet">

<!-- Custom Css -->
<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="<?php echo base_url('assets/css/themes/all-themes.css') ?>" rel="stylesheet" />

