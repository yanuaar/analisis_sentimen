@extends('layouts.app')

@section('title')
    Edit Text Analysis | Sentiment Analysis
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
                                <h1>Text Analysis</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Text Analysis</li>
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
        <div class="card-header">Edit Text</div>
        <div class="card-body card-block">
            <form action="/text_analysis_update/{{ $text_analysis->id }}" method="post" class="form-horizontal">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" value=" {{ $text_analysis->text_input }}" name="text_input" placeholder="Masukkan Text" class="form-control">
                    </div>

                    @if($errors->has('text_input'))
                        <div class="text-danger">
                            {{ $errors->first('text_input')}}
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