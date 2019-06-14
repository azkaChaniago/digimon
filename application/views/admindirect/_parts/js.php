<!-- Jquery Core Js -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.js') ?>"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js') ?>"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') ?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url('assets/plugins/node-waves/waves.js') ?>"></script>

<?php if ($this->uri->segment(2) == 'mercent' || $this->uri->segment(2) == 'komunitas' || $this->uri->segment(2) == 'downlinegt' || $this->uri->segment(2) == 'marketsharesekolah') : ?>
    
    <!-- ChartJs -->
    <!-- <script src="<?php echo base_url('assets/plugins/chartjs/Chart.bundle.js') ?>"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@1" type="module"></script>     -->
    
<?php endif; ?>

<!-- Jquery Validation Plugin Css -->
<script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.js') ?>"></script>

<!-- JQuery Steps Plugin Js -->
<script src="<?php echo base_url('assets/plugins/jquery-steps/jquery.steps.js') ?>"></script>

<!-- Sweet Alert Plugin Js -->
<script src="<?php echo base_url('assets/plugins/sweetalert/sweetalert.min.js') ?>"></script>

 <!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url('assets/plugins/jquery-datatable/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') ?>"></script>
<!-- <script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') ?>"></script> -->

<!-- Autosize Plugin Js -->
<script src="<?php echo base_url('assets/plugins/autosize/autosize.js') ?>"></script>

<!-- Moment Plugin Js -->
<script src="<?php echo base_url('assets/plugins/momentjs/moment.js') ?>"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') ?>"></script>

<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>

<!-- Custom Js -->
<script src="<?php echo base_url('assets/js/admin.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/tables/jquery-datatable.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/forms/form-validation.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/forms/basic-form-elements.js') ?>"></script>
<!-- <script src="<?php echo base_url('assets/js/pages/forms/advanced-form-elements.js') ?>"></script> -->

<!-- Demo Js -->
<script src="<?php echo base_url('assets/js/demo.js') ?>"></script>

<script>
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

$(document).ready(function(){

    // Format mata uang.
    $( '.uang' ).mask('000.000.000', {reverse: true});

})
</script>