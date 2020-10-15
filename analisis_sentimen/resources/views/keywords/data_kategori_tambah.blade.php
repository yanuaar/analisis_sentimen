@extends('layouts.app')

@section('title')
    Tambah Kategori | Sentiment Analysis
@endsection

@section('breadcrumb')
<div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Data Kategori</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Keyword</a></li>
                                    <li class="active">Data Kategori</li>
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

<div class="col-mt-5">
    <div class="card">
        <div class="card-header">Tambah Kategori</div>
        <div class="card-body card-block">
            <form action="/kategori_store" method="post" class="">
            {{ csrf_field() }}
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="kategori" placeholder="Kategori" class="form-control">
                    </div>

                    @if($errors->has('kategori'))
                        <div class="text-danger">
                            {{ $errors->first('kategori')}}
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

@endsection