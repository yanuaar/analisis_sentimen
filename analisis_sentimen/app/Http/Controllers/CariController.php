<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CariController extends Controller
{
    public function index(Request $request){
        $cari_index = DB::table('testing')
        ->join('preprocessing', 'testing.id_preprocessing', '=', 'preprocessing.id_preprocessing')
        ->join('datasets', 'testing.id_datasets', '=', 'datasets.ID')
        ->select('testing.*', 'preprocessing.*', 'datasets.*')
        ->paginate();

        $cari = $request->cari;

        $keyNeg = DB::table('testing')
        ->join('preprocessing', 'testing.id_preprocessing', '=', 'preprocessing.id_preprocessing')
        ->join('datasets', 'testing.id_datasets', '=', 'datasets.ID')
        ->select('testing.*', 'preprocessing.*', 'datasets.*')
        ->where('testing.hasil_nb', '=', 'negatif')
		->where('preprocessing.stemming','like',"%".$cari."%")
        ->paginate();
        
        $keyPos = DB::table('testing')
        ->join('preprocessing', 'testing.id_preprocessing', '=', 'preprocessing.id_preprocessing')
        ->join('datasets', 'testing.id_datasets', '=', 'datasets.ID')
        ->select('testing.*', 'preprocessing.*', 'datasets.*')
        ->where('testing.hasil_nb', '=', 'positif')
		->where('preprocessing.stemming','like',"%".$cari."%")
		->paginate();

        $tampil_latih = DB::table('tf_testing')->where('kata', '=', 'latih')->get();
        $tampil_main = DB::table('tf_testing')->where('kata', '=', 'main')->get();
        $tampil_pssi = DB::table('tf_testing')->where('kata', '=', 'pssi')->get();

		return view('cari.cari_key',['cari' => $cari,'datasetspos' => $keyPos, 'datasetsneg' => $keyNeg,'datasets' => $cari_index, 'latih' => $tampil_latih, 'main' => $tampil_main, 'pssi' => $tampil_pssi]);
    }

    public function cari(Request $request)
	{
        $tampil_latih = DB::table('tf_testing')->where('kata', '=', 'latih')->get();
        $tampil_main = DB::table('tf_testing')->where('kata', '=', 'main')->get();
        $tampil_pssi = DB::table('tf_testing')->where('kata', '=', 'pssi')->get();

		// menangkap data pencarian
		$cari = $request->cari;

    	// mengambil data dari table sesuai pencarian data
        $keyNeg = DB::table('testing')
        ->join('preprocessing', 'testing.id_preprocessing', '=', 'preprocessing.id_preprocessing')
        ->join('datasets', 'testing.id_datasets', '=', 'datasets.ID')
        ->select('testing.*', 'preprocessing.*', 'datasets.*')
        ->where('testing.hasil_nb', '=', 'negatif')
		->where('preprocessing.stemming','like',"%".$cari."%")
        ->paginate();
        
        $keyPos = DB::table('testing')
        ->join('preprocessing', 'testing.id_preprocessing', '=', 'preprocessing.id_preprocessing')
        ->join('datasets', 'testing.id_datasets', '=', 'datasets.ID')
        ->select('testing.*', 'preprocessing.*', 'datasets.*')
        ->where('testing.hasil_nb', '=', 'positif')
		->where('preprocessing.stemming','like',"%".$cari."%")
		->paginate();

    	// mengirim data pegawai ke view index
		return view('cari.cari_key',['cari' => $cari,'datasetspos' => $keyPos, 'datasetsneg' => $keyNeg, 'latih' => $tampil_latih, 'main' => $tampil_main, 'pssi' => $tampil_pssi]);
    }


    public function index_semua(Request $request){
        $cari_index = DB::table('preprocessing')
        ->join('datasets', 'preprocessing.id_datasets', '=', 'datasets.ID')
        ->select('datasets.*', 'preprocessing.*')
        ->paginate();

        $cari = $request->cari;

        $keyNeg = DB::table('preprocessing')
        ->join('datasets', 'preprocessing.id_datasets', '=', 'datasets.ID')
        ->select('datasets.*', 'preprocessing.*')
        ->where('preprocessing.label', '=', 'negatif')
		->where('preprocessing.stemming','like',"%".$cari."%")
        ->paginate();
        
        $keyPos = DB::table('preprocessing')
        ->join('datasets', 'preprocessing.id_datasets', '=', 'datasets.ID')
        ->select('datasets.*', 'preprocessing.*')
        ->where('preprocessing.label', '=', 'positif')
		->where('preprocessing.stemming','like',"%".$cari."%")
        ->paginate();

        // $tampil_latih = DB::table('tf_testing')->where('kata', '=', 'latih')->get();
        // $tampil_main = DB::table('tf_testing')->where('kata', '=', 'main')->get();
        // $tampil_pssi = DB::table('tf_testing')->where('kata', '=', 'pssi')->get();

		return view('cari.cari_semua',['cari' => $cari,'datasetspos' => $keyPos, 'datasetsneg' => $keyNeg,'datasets' => $cari_index]);
    }

    public function cari_semua(Request $request)
	{

		// menangkap data pencarian
		$cari = $request->cari;

    	// mengambil data dari table sesuai pencarian data
        $keyNeg = DB::table('preprocessing')
        ->join('datasets', 'preprocessing.id_datasets', '=', 'datasets.ID')
        ->select('datasets.*', 'preprocessing.*')
        ->where('preprocessing.label', '=', 'negatif')
		->where('preprocessing.stemming','like',"%".$cari."%")
        ->paginate();
        
        $keyPos = DB::table('preprocessing')
        ->join('datasets', 'preprocessing.id_datasets', '=', 'datasets.ID')
        ->select('datasets.*', 'preprocessing.*')
        ->where('preprocessing.label', '=', 'positif')
		->where('preprocessing.stemming','like',"%".$cari."%")
        ->paginate();

    	// mengirim data pegawai ke view index
		return view('cari.cari_semua',['cari' => $cari,'datasetspos' => $keyPos, 'datasetsneg' => $keyNeg]);
    }

}
