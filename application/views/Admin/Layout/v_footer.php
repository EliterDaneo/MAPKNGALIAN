<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; 2014-2021 <a href="https://github.com/EliterDaneo/Webmapk.git">MAPKNGALIAN</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 3.1.0
	</div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url () ?>assets/belakang-web/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url () ?>assets/belakang-web/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url () ?>assets/belakang-web/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url () ?>assets/belakang-web/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url () ?>assets/belakang-web/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url () ?>assets/belakang-web/dist/js/pages/dashboard2.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/toastr/toastr.min.js"></script>

<script src="<?= base_url () ?>assets/belakang-web/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url () ?>assets/belakang-web/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url () ?>assets/belakang-web/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url () ?>assets/belakang-web/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?= base_url () ?>assets/belakang-web/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?= base_url()?>assets/data/datepicker/js/bootstrap-datepicker.js"></script>

<style>
.datepicker{z-index:1151;}
</style>
<script type="text/javascript">
  $(function(){
    $("#tanggal").datepicker({
      format:'yyyy/dd/mm'
    });
  });
  var baseUrl = "<?= base_url();?>";
</script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>

  var lineChartData = {
    labels : <?php echo json_encode($bulan);?>,
    datasets : [

    {
      fillColor: "rgba(60,141,188,0.9)",
      strokeColor: "rgba(60,141,188,0.8)",
      pointColor: "#3b8bba",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(152,235,239,1)",
      data : <?php echo json_encode($value);?>
    }

    ]

  }

  var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

  var canvas = new Chart(myLine).Line(lineChartData, {
    scaleShowGridLines : true,
    scaleGridLineColor : "rgba(0,0,0,.005)",
    scaleGridLineWidth : 0,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve : true,
    bezierCurveTension : 0.4,
    pointDot : true,
    pointDotRadius : 4,
    pointDotStrokeWidth : 1,
    pointHitDetectionRadius : 2,
    datasetStroke : true,
    tooltipCornerRadius: 2,
    datasetStrokeWidth : 2,
    datasetFill : true,
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
    responsive: true
  });

</script>

<script>
  $(function() {
    // setTimeout() function will be fired after page is loaded
    var timeout = 5000; // in miliseconds (5*1000)
    $('.alert').delay(timeout).fadeOut(300);
  });
</script>

<script>
  initSample();
</script>

</body>
</html>