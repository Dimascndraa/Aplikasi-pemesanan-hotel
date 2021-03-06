<!-- jQuery -->
<script src="../src/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../src/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script src="../src/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../src/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../src/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../src/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../src/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../src/plugins/moment/moment.min.js"></script>
<script src="../src/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../src/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../src/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../src/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../src/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../src/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../src/plugins/jszip/jszip.min.js"></script>
<script src="../src/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../src/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../src/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../src/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../src/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../src/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script src="../src/dist/js/adminlte.min.js?v=3.2.0"></script>

<script src="../src/dist/js/demo.js"></script>

<script>
    $(function() {
        $("#datatab").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }, "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>