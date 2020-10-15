@extends('layouts.app')

@section('title')
    Text Analysis | Sentiment Analysis
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

@if ($message = Session::get('tambah_sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

@if ($message = Session::get('edit_sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

@if ($message = Session::get('delete_sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

<!-- <a type="button" href="/text_analysis/tambah" class="btn btn-success my-3"> -->
<a type="button" href="/text_analysis_tambah" class="btn btn-add">
    <i class="fa fa-plus"></i>
    Add Text
</a>

<a type="button" href="/text_analysis_proses" class="btn btn-add">
    <i class="fa fa-spinner"></i>
    Analyze
</a>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Text Analysis</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tweet</th>
                                <th>Hasil</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($text_analysis as $t)
                            <tr>
                                <td>{{ $t->text_input }}</td>
                                <td>{{ $t->hasil_nb }}</td>
                                <td>
                                    <a href="/text_analysis_edit/{{ $t->id }}" class="btn btn-edit">
                                        <i class="fa fa-pencil"></i>
                                        Edit
                                    </a>
                                    <a href="/text_analysis_hapus/{{ $t->id }}" class="btn btn-del">
                                        <i class="fa fa-trash-o"></i>
                                        Delete
                                    </a>
                                </td>
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