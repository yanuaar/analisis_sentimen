@extends('layouts.app')

@section('title')
    Edit Normalisasi | Sentiment Analysis
@endsection

@section('assets')
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
@endsection

@section('breadcrumb')
<div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Data Normalisasi</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">Data Normalisasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')

<div class="col-mt-5">
    <div class="card">
        <div class="card-header">Edit Normalisasi</div>
        <div class="card-body card-block">
            <form action="/normalisasi_update/{{$normalisasi->id}}" method="post" class="">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" value=" {{ $normalisasi->kata_gaul }}" name="kata_gaul" placeholder="Kata Gaul" class="form-control">
                    </div>

                    @if($errors->has('kata_gaul'))
                        <div class="text-danger">
                            {{ $errors->first('kata_gaul')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" value=" {{ $normalisasi->normalisasi }}" name="normalisasi" placeholder="Kata Normalisasi" class="form-control">
                    </div>

                    @if($errors->has('normalisasi'))
                        <div class="text-danger">
                            {{ $errors->first('normalisasi')}}
                        </div>
                    @endif

                </div>
                
                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/init/weather-init.js"></script>
    <script src="../assets/js/init/fullcalendar-init.js"></script>
    <script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/init/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    } );
    </script>
@endsection