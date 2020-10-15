@extends('layouts.app')

@section('title')
    List Stopword | Sentiment Analysis
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

<a type="button" href="/keyword_tambah" class="btn btn-add my-3">
    <i class="fa fa-plus"></i>
    Add Data
</a>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">List Keyword</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Keyword</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($keyword as $kw)
                            <tr>
                                <td>{{ $kw->keyword }}</td>
                                <td>{{ $kw->kategori }}</td>
                                <td>
                                    <a href="/keyword_edit/{{ $kw->id_keyword }}" class="btn btn-edit">
                                        <i class="fa fa-pencil"></i>
                                        Edit
                                    </a>
                                    <a href="/keyword_hapus/{{ $kw->id_keyword }}" class="btn btn-del">
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