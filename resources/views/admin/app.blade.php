<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NEA</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/bower_components/select2/dist/css/select2.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-blue.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/nepali.datepicker.v2.2.min.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    #meterDetail {
      margin-left: -20px;
      min-height: 300px;
      border: 1px solid #f1f1f1;
      box-shadow: 2px 5px 5px 7px rgba(0, 0, 0, 0.35);
    }

    #meterDetail p {
      font-size: 16px;
    }

    #meterDetail strong {
      color: #186596;
      font-size: 14px;
      margin-right: 5px;
    }

    #customer_details {
      margin-left: -20px;
      min-height: 300px;
      border: 1px solid #f1f1f1;
      box-shadow: 2px 5px 5px 7px rgba(0, 0, 0, 0.35);
    }

    #customer_details p {
      font-size: 16px;
    }

    #customer_details strong {
      color: #186596;
      font-size: 14px;
      margin-right: 5px;
    }

    #customer_view {
      margin-left: -50%;
      min-height: 200px;
      min-width: 550px;
    }

    #customer_view p {
      font-size: 14px;
    }

    #customer_view strong {
      color: #186596;
      font-size: 14px;
      margin-right: 5px;
    }


    .vl {
      border-left: 2px solid #186596;
      height: 240px;
    }

    .v2 {
      border-left: 2px solid #186596;
      height: 200px;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    @include('admin.common.header')
    @include('admin.common.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            @yield('breadcrumb')
          </ol>
        </nav>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        @yield('content')

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.common.footer')
    <script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{asset('assets/bower_components/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dist/mainrn.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dist/nepali.datepicker.v2.2.min.js')}}"></script>

    <script>
      $('#datepicker').datepicker({
        autoclose: true
      });

      $('.select2').select2();

      //CKEDITOR.replace('editor1');

      $(document).ready(function() {

        $('body .dropdown-toggle').dropdown();

        $('#nepaliDate3').nepaliDatePicker({
          npdMonth: true,
          npdYear: true,
        });
        $('#nepaliDate4').nepaliDatePicker({
          npdMonth: true,
          npdYear: true,
        });

        $('#nepaliDate5').nepaliDatePicker({
          npdMonth: true,
          npdYear: true,
        });
        $('#nepaliDate3').val(getNepaliDate());
        $('#nepaliDate4').val(getNepaliDate());
        $('#nepaliDate5').val(getNepaliDate());

        $('#dtHorizontalExample').DataTable({

          "scrollX": true,
          dom: "lBfrtip",
          buttons: [
            'excel', 'csv', 'pdf', 'copy'
          ],
          "lengthMenu": [10, 25, 50, 75, 100, 500]
        });
        $('.dataTables_length').addClass('bs-select');


        $('#example1').DataTable({

          "min-height": 300,
          "lengthMenu": [10, 25, 50, 75, 100, 500]
        });
        $('#example3').DataTable({

          "min-height": 300,
          "lengthMenu": [10, 25, 50, 75, 100, 500]
        });
        $('#example2').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': false,
          'ordering': true,
          'info': true,
          'autoWidth': false
        });
      });
    </script>

    @yield('scripts')
</body>

</html>
