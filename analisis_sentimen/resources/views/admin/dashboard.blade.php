@extends('layouts.app')

@section('title')
    Sentiment Analysis
@endsection

@section('content')
<!-- Widgets  -->
<div class="row">
    <div class="col-sm-12 mb-4">
            <div class="card-group">
                <div class="card col-md-6 no-padding ">
                    <div class="card-body">
                        <div class="h1 text-muted text-right mb-4">
                            <!-- <i class="fa fa-users"></i> -->
                        </div>
                        <div class="h4 mb-0">
                            <span class="count">530</span>
                        </div>

                        <small class="text-muted text-uppercase font-weight-bold">Data Tweets</small>
                        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
                    </div>
                </div>
                <div class="card col-md-6 no-padding ">
                    <div class="card-body">
                        <div class="h1 text-muted text-right mb-4">
                            <!-- <i class="fa fa-user-plus"></i> -->
                        </div>
                        <div class="h4 mb-0">
                            <span class="count">477</span>
                        </div>
                        <small class="text-muted text-uppercase font-weight-bold">Data Training</small>
                        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-2" style="width: 40%; height: 5px;"></div>
                    </div>
                </div>
                <div class="card col-md-6 no-padding ">
                    <div class="card-body">
                        <div class="h1 text-muted text-right mb-4">
                            <!-- <i class="fa fa-cart-plus"></i> -->
                        </div>
                        <div class="h4 mb-0">
                            <span class="count">53</span>
                        </div>
                        <small class="text-muted text-uppercase font-weight-bold">Data Testing</small>
                        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-3" style="width: 40%; height: 5px;"></div>
                    </div>
                </div>
                <div class="card col-md-6 no-padding ">
                    <div class="card-body">
                        <div class="h1 text-muted text-right mb-4">
                            <!-- <i class="fa fa-pie-chart"></i> -->
                        </div>
                        <div class="h4 mb-0">
                            <span class="count">3038</span>
                        </div>
                        <small class="text-muted text-uppercase font-weight-bold">Words</small>
                        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-4" style="width: 40%; height: 5px;"></div>
                    </div>
                </div>
                <div class="card col-md-6 no-padding ">
                    <div class="card-body">
                        <div class="h1 text-muted text-right mb-4">
                            <!-- <i class="fa fa-pie-chart"></i> -->
                        </div>
                        <div class="h4 mb-0">
                            <span class="count">5</span>
                        </div>
                        <small class="text-muted text-uppercase font-weight-bold">Hashtag</small>
                        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-5" style="width: 40%; height: 5px;"></div>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-justify">
                <div class="card-header">
                    <strong class="card-title">Datasets</strong>
                </div>
                <div class="card-body">
                    <p class="card-text">Data yang digunakan dalam penelitian ini adalah tweet pada sosial media Twitter yakni opini atau argumen mengenai performa Timnas Sepak Bola Indonesia.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-justify">
                <div class="card-header">
                    <strong class="card-title">Metode Naive Bayes</strong>
                </div>
                <div class="card-body">
                    <p class="card-text">Algoritma Naive Bayes merupakan algoritma yang digunakan untuk mencari nilai probabilitas tertinggi untuk mengklasifikasi data uji pada kategori yang paling tepat. Dalam penelitian ini yang menjadi data uji adalah dokumen opini. Ada dua tahap pada klasifikasi dokumen. Tahap pertama adalah pelatihan terhadap dokumen yang sudah diketahui kategorinya. Sedangkan tahap kedua adalah proses klasifikasi dokumen yang belum diketauhi.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-justify">
                <div class="card-header">
                    <strong class="card-title">Analisa Sentimen</strong>
                </div>
                <div class="card-body">
                    <p class="card-text">Analisa Sentimen adalah proses memahami, mengekstrak, dan mengolah data tekstual secara otomatis untuk mendapatkan informasi sentimen yang terkandung dalam suatu kalimat opini. Analisa Sentimen digunakan untuk melihat pendapat atau kecenderungan opini terhadap sebuah masalah atau objek oleh seseorang menuju ke opini positif atau negatif.</p>
                </div>
            </div>
        </div>

    <!-- <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="text-center">
                        <div class="stat-heading">Datasets</div>
                    </div>
                    <div class="text-justify">
                        <div class="stat-text">Data yang digunakan dalam penelitian ini adalah tweet pada sosial media Twitter yakni opini atau argumen mengenai performa Timnas Sepak Bola Indonesia.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="text-center">
                      <div class="stat-heading">Metode Naive Bayes</div>
                    </div>
                    <div class="text-justify">
                        <div class="stat-text">Algoritma Naive Bayes merupakan algoritma yang digunakan untuk mencari nilai probabilitas tertinggi untuk mengklasifikasi data uji pada kategori yang paling tepat. Dalam penelitian ini yang menjadi data uji adalah dokumen opini. Ada dua tahap pada klasifikasi dokumen. Tahap pertama adalah pelatihan terhadap dokumen yang sudah diketahui kategorinya. Sedangkan tahap kedua adalah proses klasifikasi dokumen yang belum diketauhi.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="text-center">
                      <div class="stat-heading">Analisa Sentimen</div>
                    </div>
                    <div class="text-justify">
                        <div class="stat-text">Analisa Sentimen adalah proses memahami, mengekstrak, dan mengolah data tekstual secara otomatis untuk mendapatkan informasi sentimen yang terkandung dalam suatu kalimat opini. Analisa Sentimen digunakan untuk melihat pendapat atau kecenderungan opini terhadap sebuah masalah atau objek oleh seseorang menuju ke opini positif atau negatif </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection

@section('scripts')

@endsection