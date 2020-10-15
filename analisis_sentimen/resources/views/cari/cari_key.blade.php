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
                    <h1>Search Target</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="{{url('classification_testing')}}">Classification</a></li>
                        <li class="active">Testing</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Pencarian Target</div>
            <div class="card-body card-block">
                <form action="/cari_proses" method="GET" class="">
                    <div class="form-group">
                        <label class="exampleFormControlSelect1">Target</label>
                        <select class="form-control" id="cari" name="cari" >
                            <option value="option_select" disabled selected>Pilih Target</option>
                            <option value="latih">Pelatih</option>
                            <option value="main">Pemain</option>
                            <option value="pssi">Federasi</option>
                        </select>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" value="CARI" class="btn btn-add">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="text_align-center">
                        <div class="stat-heading">Opini negatif tentang <b>{{ $cari }}</b> </div>
                        <div class="stat-text">Total Dokumen : <b>{{ $datasetsneg->total() }}</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="text_align-center">
                        <div class="stat-heading">Opini positif tentang <b>{{$cari}}</b> </div>
                        <div class="stat-text">Total Dokumen : <b>{{ $datasetspos->total() }}</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Hasil Target Negatif</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tweet</th>
                            <th scope="col">Hasil Algoritma</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datasetsneg as $p)
                        <tr>
                            <td>{{ $p->text }}</td>
                            <td>{{ $p->label }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Hasil Target Positif</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tweet</th>
                            <th scope="col">Hasil Algoritma</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datasetspos as $p)
                        <tr>
                            <td>{{ $p->text }}</td>
                            <td>{{ $p->label }}</td>
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