@extends('layouts.app')

@section('title')
    Classification Testing | Sentiment Analysis
@endsection

@section('breadcrumb')
<div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Testing</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Classification</a></li>
                                    <li class="active">Testing</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')

@if ($message = Session::get('class_sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

<a href="{{url('classification_testing_proses')}}" class="btn btn-add my-3">
    <i class="fa fa-spinner"></i>
    Run Classification
</a>

<a href="{{url('cari_index')}}" class="btn btn-add my-3">
    <i class="fa fa-search"></i>
    Target Klasifikasi
</a>

<a href="{{url('cari_semua')}}" class="btn btn-add my-3">
    <i class="fa fa-search"></i>
    Target Tweet
</a>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Proses Testing</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tweet</th>
                                <th>Label Manual</th>
                                <th>Datetime</th>
                                <th>Algoritma Naive Bayes</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tst as $cfv)
                            <tr>
                                <td>{{ $cfv->text }}</td>
                                <td>{{ $cfv->label }}</td>
                                <td>{{ $cfv->datetime }}</td>
                                <td>{{ $cfv->hasil_nb }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- PENGUJIAN APLIKASI -->

    @foreach ($pgn as $pgnv)
        <div class="col-lg-4">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="mb-0">
                            <span class="count">{{$pgnv->accuracy}}</span>
                            <span>%</span>
                        </h3>
                        <p class="text-light mt-1 m-0">Accuracy System</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card text-white bg-flat-color-5">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="mb-0">
                            <span class="count float-left">{{$pgnv->prec_pos}}</span>
                            <span>%</span>
                        </h3>
                        <p class="text-light mt-1 m-0">Precision Positif</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="mb-0">
                            <span class="count">{{$pgnv->prec_neg}}</span>
                            <span>%</span>
                        </h3>
                        <p class="text-light mt-1 m-0">Precision Negatif</p>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-2">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="mb-0">
                            <span class="count">{{$pgnv->rec_pos}}</span>
                            <span>%</span>
                        </h3>
                        <p class="text-light mt-1 m-0">Recall Positif</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="mb-0">
                            <span class="count">{{$pgnv->rec_neg}}</span>
                            <span>%</span>
                        </h3>
                        <p class="text-light mt-1 m-0">Recall Negatif</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection

@section('scripts')

@endsection