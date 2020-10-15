@extends('layouts.app')

@section('title')
    Classification Training | Sentiment Analysis
@endsection

@section('breadcrumb')
<div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Training</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Classification</a></li>
                                    <li class="active">Training</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')

@if ($message = Session::get('train_sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

<a href="{{url('classification_proses')}}" class="btn btn-add my-3">
    <i class="fa fa-spinner"></i>
    Run Training
</a>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Proses Training</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kata</th>
                                <th>Jumlah Kata</th>
                                <th>P(Kata)</th>
                                <th>P(W|+)</th>
                                <th>P(W|-)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cf as $cfv)
                            <tr>
                                <td>{{ $cfv->kata }}</td>
                                <td>{{ $cfv->jum_kata }}</td>
                                <td>{{ $cfv->p_kata }}</td>
                                <td>{{ $cfv->p_wpos }}</td>
                                <td>{{ $cfv->p_wneg }}</td>
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