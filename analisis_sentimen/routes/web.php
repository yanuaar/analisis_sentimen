<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', function () {
    return view('admin.dashboard'); 
});
Route::get('/dashboard', 'DashboardController@index');

// Datasets
Route::get('/datasets', 'DatasetsController@datasets_index');
Route::get('/datasets/export_excel', 'DatasetsController@export_excel');
Route::post('/datasets/import_excel', 'DatasetsController@import_excel');
Route::get('/datasets/clear_data', 'DatasetsController@clear_data');

// cari
Route::get('/cari_index','CariController@index');
Route::get('/cari_proses','CariController@cari');

Route::get('/cari_semua','CariController@index_semua');
Route::get('/cari_semua_proses','CariController@cari_semua');

// Keyword
//Keyword
Route::get('/data_keyword', 'KeywordController@keyword_index');
Route::get('/keyword_tambah', 'KeywordController@keyword_tambah');
Route::post('/keyword_store', 'KeywordController@keyword_store');
Route::get('/keyword_edit/{id}', 'KeywordController@keyword_edit');
Route::put('/keyword_update/{id}', 'KeywordController@keyword_update');
Route::get('/keyword_hapus/{id}', 'KeywordController@keyword_delete');

//Kategori
Route::get('/data_kategori', 'KeywordController@kategori_index');
Route::get('/kategori_tambah', 'KeywordController@kategori_tambah');
Route::post('/kategori_store', 'KeywordController@kategori_store');
Route::get('/kategori_edit/{id}', 'KeywordController@kategori_edit');
Route::put('/kategori_update/{id}', 'KeywordController@kategori_update');
Route::get('/kategori_hapus/{id}', 'KeywordController@kategori_delete');


// Forms
//Stopword
Route::get('/data_stopword', 'FormsController@stopword_index');
Route::get('/stopword_tambah', 'FormsController@stopword_tambah');
Route::post('/stopword_store', 'FormsController@stopword_store');
Route::get('/stopword_edit/{id}', 'FormsController@stopword_edit');
Route::put('/stopword_update/{id}', 'FormsController@stopword_update');
Route::get('/stopword_hapus/{id}', 'FormsController@stopword_delete');

//Normalisasi
Route::get('/data_normalisasi', 'FormsController@normalisasi_index');
Route::get('/normalisasi_tambah', 'FormsController@normalisasi_tambah');
Route::post('/normalisasi_store', 'FormsController@normalisasi_store');
Route::get('/normalisasi_edit/{id}', 'FormsController@normalisasi_edit');
Route::put('/normalisasi_update/{id}', 'FormsController@normalisasi_update');
Route::get('/normalisasi_delete/{id}', 'FormsController@normalisasi_delete');

// Preprocessing
Route::get('/casefolding', 'PreprocessingController@casefolding_index');
Route::get('/casefolding_proses', "PreprocessingController@casefolding_proses");
Route::get('/cleaning', 'PreprocessingController@cleaning_index');
Route::get('/cleaning_proses', "PreprocessingController@cleaning_proses");
Route::get('/stopword', 'PreprocessingController@stopword_index');
Route::get('/stopword_proses', "PreprocessingController@stopword_proses");
Route::get('/normalisasi', 'PreprocessingController@normalisasi_index');
Route::get('/normalisasi_proses', "PreprocessingController@normalisasi_proses");
Route::get('/stemming', 'PreprocessingController@stemming_index');
Route::get('/stemming_proses', "PreprocessingController@stemming_proses");

// TF
Route::get('/tf_training', 'TermController@tf_training_index');
Route::get('/tf_training_proses', "TermController@tf_training_proses");
Route::get('/tf_testing', 'TermController@tf_testing_index');
Route::get('/tf_testing_proses', "TermController@tf_testing_proses");

// Classification
Route::get('/classification_training', 'TermController@classification_training_index');
Route::get('/classification_proses', 'TermController@classification_proses');
Route::get('/classification_testing', 'TermController@classification_testing_index');
Route::get('/classification_testing_proses', 'TermController@classification_testing_proses');

// Text Analysis
Route::get('/text_analysis', 'TextAnalysisController@index');
Route::get('/text_analysis_tambah', 'TextAnalysisController@text_analysis_tambah');
Route::post('/text_analysis_store', 'TextAnalysisController@text_analysis_store');
Route::get('/text_analysis_edit/{id}', 'TextAnalysisController@text_analysis_edit');
Route::put('/text_analysis_update/{id}', 'TextAnalysisController@text_analysis_update');
Route::get('/text_analysis_hapus/{id}', 'TextAnalysisController@text_analysis_delete');

Route::get('/text_analysis_proses', 'TextAnalysisController@text_analysis_proses');
