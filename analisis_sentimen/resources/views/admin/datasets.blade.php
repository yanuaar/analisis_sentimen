@extends('layouts.app')

@section('title')
    Datasets | Sentiment Analysis
@endsection

@section('breadcrumb')
<div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Datasets</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Datasets</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')

<!-- notifikasi form validasi -->
@if ($errors->has('file'))
	<span class="invalid-feedback" role="alert">
		<strong>{{ $errors->first('file') }}</strong>
	</span>
@endif

@if ($message = Session::get('sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

<button type="button" class="btn btn-add mr-1" data-toggle="modal" data-target="#importExcel">
    <i class="fa ti-import"></i>
    Import Excel
</button>

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/datasets/import_excel" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">
                        <i class="fa ti-close"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-add">
                        <i class="fa ti-import"></i>
                        Import
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<a type="button" href="/datasets/export_excel" class="btn btn-add my-3">
    <i class="fa ti-export"></i>
    Export Excel
</a>

<a type="button" class="btn btn-clear" href="/datasets/clear_data">
    <i class="fa ti-close"></i>
    Clear Data
</a>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Datasets</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tweet</th>
                                <th>Label</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $datav)
                            <tr>
                                <td>{{ $datav->ID }}</td>
                                <td>{{ $datav->text }}</td>
                                <td>{{ $datav->label }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection

@section('scripts')

@endsection