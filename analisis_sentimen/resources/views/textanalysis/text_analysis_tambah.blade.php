@extends('layouts.app')

@section('title')
    Tambah Text | Sentiment Analysis
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

<div class="col-mt-5">
    <div class="card">
        <div class="card-header">Add Text</div>
        <div class="card-body card-block">

            <form action="/text_analysis_store" method="post" class="">

            {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="text_input" placeholder="Masukkan Text" class="form-control">
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

@endsection