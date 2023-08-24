<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AMU Workers Credit and Saving</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition layout-top-nav">
    @include('members.layouts.topnav')

@yield('content')


<div class="container d-flex justify-content-center">
    <footer class="main-footer">
        <strong>Copyright &copy;
            <?php
                use Carbon\Carbon;
                echo Carbon::now()->format('Y');
            ?>
            <a href="https://www.amu.edu.et/" target="_blank">Arbaminch university</a>.
        </strong>
        All rights reserved.
    </footer>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
   $(document).ready(function() {
  // Add buttons to DataTable
  $('#savingtable').DataTable( {
    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f><"col-sm-12"B>>' +
         '<"row"<"col-sm-12"tr>>' +
         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    buttons: [
      { extend: 'pdf', className: 'btn btn-danger mx-1 mt-1' },
      { extend: 'print', className: 'btn btn-success mx-1 mt-1' },
      { extend: 'excel', className: 'btn btn-info mx-1 mt-1' }
    ],
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
    pageLength: 10
  });

  // Make table responsive
  $('#savingtable').wrap('<div class="table-responsive"></div>');
});

$(document).ready(function() {
  // Initialize DataTable
  $('#mycredit').DataTable({
    dom: '<"row"<"col-sm-12 col-md-6"l>><"row"<"col-sm-12"tr>>' +
         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
    pageLength: 10
  });

  // Make table responsive
  $('#mycredit').wrap('<div class="table-responsive"></div>');
});
</script>

</body>
