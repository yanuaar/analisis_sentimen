@extends('layouts.app')

@section('title')
    Edit Keyword | Sentiment Analysis
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
                                <h1>Data Keyword</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Keyword</a></li>
                                    <li class="active">Data Keyword</li>
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
        <div class="card-header">Edit Keyword</div>
        <div class="card-body card-block">
        @foreach($keyword as $dt)
            <form action="/keyword_update/{{$dt->id_keyword}}" method="post" class="">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" value=" {{$dt->keyword}}" name="keyword" placeholder="Kategori" class="form-control">
                    </div>
                    @if($errors->has('keyword'))
                        <div class="text-danger">
                            {{ $errors->first('keyword')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="exampleFormControlSelect1">Kategori</label>
                    <select class="chosen-select form-control" id="id_kategori" name="id_kategori" >
                        <option value="option_select" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $key)
                            <option value="{{ $key->id }}">{{ $key->kategori }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('id_kategori'))
                            <div class="text-danger">
                                {{ $errors->first('id_kategori')}}
                            </div>
                    @endif
                </div>
        @endforeach                
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