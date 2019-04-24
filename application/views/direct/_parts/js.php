<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/old_template/jquery/jquery.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
<script src="<?php echo base_url('assets/old_template/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/old_template/jquery-easing/jquery.easing.min.js') ?>"></script>
<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url('assets/old_template/chart.js/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('assets/old_template/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/old_template/datatables/dataTables.bootstrap4.js') ?>"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/old_template/js/sb-admin.min.js') ?>"></script>
<!-- Demo scripts for this page-->
<script src="<?php echo base_url('assets/old_template/js/demo/datatables-demo.js') ?>"></script>
<!-- <script src="<?php echo base_url('assets/old_template/js/demo/chart-bar-demo.js') ?>"></script> -->
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<!--script src="<?php echo base_url('assets/old_template/ckeditor/ckeditor.js')?>"></script-->

<!--cript src="<?php echo base_url('assets/old_template/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') ?>"></script>
<script src="<?php echo base_url('assets/old_template/jquery.hotkeys/jquery.hotkeys.js') ?>"></script>
<script src="<?php echo base_url('assets/old_template/google-code-prettify/src/prettify.js') ?>"></script-->

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url('assets/old_template/js/custom.min.js') ?>"></script>

<script>

// // Restricts input for the given textbox to the given inputFilter.
// function setInputFilter(textbox, inputFilter) {
//   ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
//     textbox.addEventListener(event, function() {
//       if (inputFilter(this.value)) {
//         this.oldValue = this.value;
//         this.oldSelectionStart = this.selectionStart;
//         this.oldSelectionEnd = this.selectionEnd;
//       } else if (this.hasOwnProperty("oldValue")) {
//         this.value = this.oldValue;
//         this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
//       }
//     });
//   });
// }

// // Restrict input to digits and '.' by using a regular expression filter.
// setInputFilter(document.getElementsByClassName("myTextBox"), function(value) {
//   return /^\d*$/.test(value);
// });

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