@extends('layouts.app')

@section('title')
    Normalisasi | Sentiment Analysis
@endsection

@section('breadcrumb')
<div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Normalisasi</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Preprocessing</a></li>
                                    <li class="active">Normalisasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')

@if ($message = Session::get('nm_sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

<a href="{{ url('normalisasi_proses') }}" class="btn btn-add my-3">
    <i class="fa fa-spinner"></i>
    Run Normalisasi
</a>


<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Normalisasi Kata Baku</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Casefolding</th>
                                <th>Hasil Normalisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($norm as $normv)
                            <tr>
                                <td>{{ $normv->casefolding }}</td>
                                <td>{{ $normv->normalisasi }}</td>
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