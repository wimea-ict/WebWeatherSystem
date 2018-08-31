
<div class="bottom">
    <span ><center>Powered by &copy; WIMEA-ICT. 2016. All Rights Reserved
            <?php echo date("Y");?>
            <?php echo date('d') . date('H') . "00Z"; ?>

        </center></span>
</div>

<script type="text/javascript" src="<?= base_url(); ?>js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>js/daterangepicker.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url(); ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>-->
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- Bootstrap datepicker -->
<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-timepicker-gh-pages/js/bootstrap-timepicker.js"></script>
    <!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes
<script src="js/AdminLTE/demo.js" type="text/javascript"></script>-->
<!-- page script -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url(); ?>js/validate.js" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>js/jquery.table2excel.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.tabletoCSV.js"> </script>
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />

   
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- date range picker here-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<!-- Page script -->
<script type="text/javascript">
    $("#export").click(function(){
        $("#table2excel").table2excel({
            // exclude CSS class
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: "excel-report" //do not include extension
        });
    });

</script>
<script type="text/javascript">
    $(function() {
        $('#time3').datetimepicker({
            pickDate: false,
            pick12HourFormat: true,   // enables the 12-hour format time picker
            pickSeconds: false
        });
    });
</script>
<script>
    $("#exportcsv").on('click', function() {
        $("#table2excel").tableToCSV();
    });
</script>
<script type="text/javascript">
    $("#exportcsv").click(function(){
        $("#table2excel").tableToCSV();
    });
</script>
<script type="text/javascript">
    $('#period').daterangepicker(
        {   maxDate: "today",
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 10 Days': [moment().subtract('days', 9), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            format: 'YYYY-MM-DD'
        },
        function(start, end) {
            $('#period').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        });
</script>

<script type="text/javascript">
    $('#range').daterangepicker(
        { 
			maxDate: "today",
			
            ranges: {

                'Last 10 Days': [moment().subtract('days', 9), moment()]
            },
            startDate: moment().subtract('days', 9),
            endDate: moment(),
            format: 'YYYY-MM-DD'
        },
        function(start, end) {
            $('#range').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        });
</script>

<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('#datepickrange').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  });
        
        $('#datepicker').datepicker({
             dateFormat: "dd-mm-yyyy",
            autoclose: true,
			maxDate: "today",
            endDate: '-4380d'
        });
        $('#date').datepicker({
           
            dateFormat: "yy-mm-dd",
			maxDate: "today",
            autoclose: true,
			
			
        });
        $('#expdate').datepicker({
           dateFormat: "yy-mm-dd",
			maxDate: "today",
            autoclose: true

        });
        $('#opened').datepicker({
            dateFormat: "yy-mm-dd",
			maxDate: "today",
            autoclose: true

        });
        $('#closed').datepicker({
            dateFormat: "yy-mm-dd",
			maxDate: "today",
            autoclose: true

        });
        $('#time').timepicker({
			maxDate: "today",
            showInputs: false

        });

        $("#year").datepicker({
            autoclose: true,
            format: "yyyy", // Notice the Extra space at the beginning
			maxDate: "today",
            viewMode: "years",
			
            minViewMode: "years"

        });

        $("#month").datepicker({
            autoclose: true,
            format: "MM", // Notice the Extra space at the beginning
            viewMode: "months",
            minViewMode: "months"

        });

    });
</script>
<script type="text/javascript">
    jQuery(function($){
        $("#mfgdate").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
        $("#tecdate").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
        $("#clsdate").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
        $("#coudate").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
        $("#phone").mask("(999)9999 - 999 - 999");
        $("#tin").mask("99-9999999");
        $("#ssn").mask("999-99-9999");
        $("#age").mask("99");
        $("#clage").mask("99");
        $("#clsage").mask("99");
        $("#serial").mask("999/999/999");
        $("#labserial").mask("999/999/999");
        $("#clsserial").mask("999/999/999");
        $("#num").mask("9999 999 999");
    });
</script>
<script type="text/javascript">


    $(function() {
        $("#example1").dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "order": [[ 0, "asc" ]],
            "aaSorting": [ [0,'asc'] ],
			"scrollY":        "300px",
            "scrollX":        true,
           "scrollCollapse": true,
            "paging":         true,
            "fixedColumns":   {
            "ileftColumns": 1,
            "irightColumns": 1
        }
        });
		$("#example4").dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "order": [[ 1, "desc" ]],
            "aaSorting": [ [1,'desc'] ],
			"scrollY":        "300px",
            "scrollX":        true,
           "scrollCollapse": true,
            "paging":         true,
            "fixedColumns":   {
            "ileftColumns": 1,
            "irightColumns": 1
        }
        });
        $("#example3").dataTable();
        $('#example2').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: true
        });
        //Timepicker
        $(".timepicker2").timepicker({
            showInputs: false
        });
    });
</script>
</body>
</html>
