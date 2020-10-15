<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Preprocessing;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $term_process = DB::table('preprocessing')->get();
        $filedok = array();
        $kataFull = "";

        foreach($term_process as $data){
            $term_data = $data->stemming;
            $kataFull.=$term_data . ' ';
            array_push($filedok, $term_data);
        }
        $jumlahdok = count($filedok);
        // echo "<pre> jumlahdokTest : ";print_r($jumlahdokTest);
        $TF = array_count_values(str_word_count($kataFull, 1));
        $jumlah_TF = count($TF);
        // echo "Jumlah Semua Kata : ";print_r($jumlah_TF);
        
        //====================================
        $term_test = DB::table('preprocessing')->where('keterangan', '=', 'testing')->get();
        $filedokTest = array();
        $kataTest = "";
        foreach($term_test as $data){
            $term_testing = $data->stemming;
            $kataTest.=$term_testing . ' ';
            array_push($filedokTest, $term_testing);
        }
        $jumlahdokTest = count($filedokTest);
        // echo "<pre> jumlahdokTest : ";print_r($jumlahdokTest);

        //====================================
        $term_train = DB::table('preprocessing')->where('keterangan', '=', 'training')->get();
        $filedokTrain = array();
        $kataTrain = "";
        foreach($term_train as $data){
            $term_training = $data->stemming;
            $kataTrain.=$term_training . ' ';
            array_push($filedokTrain, $term_training);
        }
        $jumlahdokTrain = count($filedokTrain);
        // echo "<pre> jumlahdokTrain : ";print_r($jumlahdokTrain);

        // return view('admin.dashboard',['hasil' => $jumlahdok, 'jml_train' => $jumlahdokTrain, 'jml_test' => $jumlahdokTest, 'words' => $jumlah_TF]);
        return view('admin.dashboard');
    }
}
