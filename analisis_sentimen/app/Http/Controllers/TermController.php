<?php

namespace App\Http\Controllers;

use Session;
use App\TermFreq;
use App\Diff;
use App\Testing;
use App\TermTesting;
use App\Preprocessing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermController extends Controller
{
    // ========================  TERM FREQUENCY ============================
    // =========== TRAINING ===========

    public function tf_training_index(){
        $tf_training = TermFreq::all();
        return view('tf.tf_training',['tf'=>$tf_training]);
    }

    public function tf_training_proses(){
        $call_training = DB::table('preprocessing')->where('keterangan', '=', 'training')->get();
        $semuaKata = "";

        foreach($call_training as $data){
            $term_data = $data->stemming;

            $semuaKata .= $term_data . ' ';
        }

        // echo "<pre> semuakata : ";print_r($semuaKata);
        $tf_training = array_count_values(str_word_count($semuaKata,1));
        // echo "<pre>";print_r($tf_training);echo count($tf_training);

        set_time_limit(600);
        foreach($tf_training as $key => $value){
            DB::table('training')->insert(
                array(
                    'kata'     =>   $key, 
                    'jum_kata'   =>   $value
                )
            );
        }
        Session::flash('tftrain_sukses','Term Frequency Successfully');
        return back();
    }

    // ========================  TERM FREQUENCY ============================
    // =========== TESTING ===========

    public function tf_testing_index(){
        $tf_testing = TermTesting::all();
        return view('tf.tf_testing',['tft'=>$tf_testing]);
    }

    public function tf_testing_proses(){
        $call_testing = DB::table('preprocessing')->where('keterangan', '=', 'testing')->get();
        $semuaKata = "";

        foreach($call_testing as $data){
            $term_data = $data->stemming;

            $semuaKata.=$term_data . ' ';
        }

        // echo "<pre> semuakata : ";print_r($semuaKata);
        $tf_testing = array_count_values(str_word_count($semuaKata, 1));
        // echo "<pre>";print_r($tf_testing);echo count($tf_testing);

        set_time_limit(600);
        // foreach($tf_testing as $key => $value){
        //     DB::table('tf_testing')->insert(
        //         array(
        //             'kata'     =>   $key, 
        //             'jum_kata'   =>   $value
        //         )
        //     );
        // }

        // tf negatif
        $call_testing_neg = DB::table('preprocessing')->where('keterangan', '=', 'testing')
        ->where('label', '=', 'negatif')->get();
        $semuaKataNeg = "";

        foreach($call_testing_neg as $data){
            $term_data_neg = $data->stemming;

            $semuaKataNeg.=$term_data_neg . ' ';
        }

        // echo "<pre> semuakata : ";print_r($semuaKata);
        $tf_testing_neg = array_count_values(str_word_count($semuaKataNeg, 1));
        foreach($tf_testing_neg as $key => $value){
            DB::update('update tf_testing set jum_kata_neg = ? where kata = ?',
            [$value, $key]);
        }

        // tf positif
        $call_testing_pos = DB::table('preprocessing')->where('keterangan', '=', 'testing')
        ->where('label', '=', 'positif')->get();
        $semuaKataPos = "";

        foreach($call_testing_pos as $data){
            $term_data_pos = $data->stemming;

            $semuaKataPos.=$term_data_pos . ' ';
        }

        $tf_testing_pos = array_count_values(str_word_count($semuaKataPos, 1));
        foreach($tf_testing_pos as $key => $value){
            DB::update('update tf_testing set jum_kata_pos = ? where kata = ?',
            [$value, $key]);
        }

        Session::flash('tftest_sukses','Term Frequency Successfully');
        return back();
    }


    // ========================  CLASSIFICATION ============================
    // =========== TRAINING ===========

    public function classification_training_index(){
        $cf_training = TermFreq::all();
        return view('classification.classification_training',['cf'=>$cf_training]);
    }

    public function classification_proses(){
        set_time_limit(600);
        // ================= TF TRAINING POSITIF =========================
        $training_pos = DB::table('preprocessing')->where('keterangan', '=', 'training')->where('label', '=', 'positif')->get();
        
        $filedokpos = array();
        $PosString = "";
        
        foreach($training_pos as $data){
            $teks = $data->stemming;

            $PosString.=$teks . ' ';
            array_push($filedokpos, $teks);
        }
        $jumlahFileDokPos = count($filedokpos);
        $TFpositif = array_count_values(str_word_count($PosString, 1));
        $jumlahPositif = array_sum($TFpositif);
        // echo "<pre> Jumlah Pos : ";print_r($jumlahPositif);
        // echo "<pre> TF Pos ";print_r($TFpositif);echo "<pre> jumlahkatapos : ";echo count($TFpositif);
        
        // ================= TF TRAINING NEGATIF =========================
        $training_neg = DB::table('preprocessing')->where('keterangan', '=', 'training')->where('label', '=', 'negatif')->get();
        $filedokneg = array();
        $NegString = "";

        foreach($training_neg as $data){
            $teks = $data->stemming;

            $NegString.=$teks . ' ';
            array_push($filedokneg, $teks);
        }
        $jumlahFileDokNeg = count($filedokneg);
        $TFnegatif = array_count_values(str_word_count($NegString, 1));
        $jumlahNegatif = array_sum($TFnegatif);
        // echo "<pre> TF Neg ";print_r($TFnegatif);echo "<pre> jumlahkataneg : ";echo count($TFnegatif);
        // echo "<pre> Jumlah Neg : ";print_r($jumlahNegatif);

        // ================= BOBOT KATEGORI POS / NEG =========================
        $Bbt_pos = $jumlahFileDokPos / ($jumlahFileDokPos + $jumlahFileDokNeg);
        $Bbt_neg = $jumlahFileDokNeg / ($jumlahFileDokPos + $jumlahFileDokNeg);
            // echo "<pre> Bobot Positif : ";print_r($Bbt_pos);
            // echo "<pre> Bobot Negatif : ";print_r($Bbt_neg);
            // echo "<pre> Jumlah FIle Positif : ";print_r($jumlahFileDokPos);
            // echo "<pre> Jumlah File Negatif : ";print_r($jumlahFileDokNeg);
        
        // ================= TF TRAINING ALL =========================
        $term_process = DB::table('preprocessing')->where('keterangan', '=', 'training')->get();
        $filedok = array();
        $kataFull = "";
        $TF = [];

        foreach($term_process as $data){
            $term_data = $data->stemming;
            $kataFull.=$term_data . ' ';
            array_push($filedok, $term_data);
        }

        $jumlahdok = count($filedok);
        $katasaja = array();    
        // echo "<pre>";print_r($filedok);
        // echo "<pre> jumlahdokTraining : ";print_r($jumlahdok);
        $TF = array_count_values(str_word_count($kataFull, 1));
        $jumlahTotal = array_sum($TF);
        // echo "<pre> jumlah semua kata ";print_r($jumlahTotal);
        // echo "<pre> TF training all ";print_r($TF);echo count($TF);
        
        
        // ================= P(kata) , P(W|+), P(W|-) =========================
        $P_kata = array();
        $PWPos = array();
        $PWNeg = array();
        
        foreach ($TF as $key => $value) {
            $P_kata[] = ($value/($jumlahFileDokPos+$jumlahFileDokNeg));
            if (empty($TFpositif[$key])) {
                $PWPos[] = (0+1)/($jumlahPositif + $jumlahTotal);
            }else{
                $PWPos[] = ($TFpositif[$key]+1) / ($jumlahPositif + $jumlahTotal);
            }

            echo "<pre> TF key :";print_r($key);
            
            if (empty($TFnegatif[$key])) {
                $PWNeg[] = (0+1)/ ($jumlahNegatif + $jumlahTotal);
            } else{
                $PWNeg[] = ($TFnegatif[$key]+1)/ ($jumlahNegatif + $jumlahTotal);
            }
            // echo "<pre> TF key :";print_r($key); 
        }
        echo "<pre> TFNegatif :";print_r($TFnegatif);
        // echo "<pre> TFpositif :";print_r($TFpositif);
        // echo count($TFpositif); 
        // echo "<pre> PKata :";print_r($P_kata);
        // echo count($P_kata);
        // echo "<pre> PWpos :";print_r($PWPos);echo count($PWPos);
        // echo "<pre> PWneg :";print_r($PWNeg);echo count($PWNeg);

        $increment = 0;
        foreach ($TF as $key => $value) {
            DB::update('update training set p_kata = ?, p_wpos=?, p_wneg=? where kata = ?',
            [$P_kata[$increment],$PWPos[$increment],$PWNeg[$increment],$key]);
            $increment++;
        }

        // =========== Pencarian nilai P(+|W) dan P(-|W) ========================
        // $PPosW = array();
        // $PNegW = array();

        // for ($i=0; $i <count($TF); $i++) { 
        //     $PPosW[] = ($PWPos[$i]*$Bbt_pos)/$P_kata[$i];
        //     $PNegW[] = ($PWNeg[$i]*$Bbt_neg)/$P_kata[$i];
        // }

        // $increment = 0;
        // foreach ($TF as $key => $value) {
        //     DB::update('update training set p_posw=?, p_negw=? where kata = ?',
        //     [$PPosW[$increment],$PNegW[$increment],$key]);
        //     $increment++;
        // }
        // print_r($PPosW);
        
        Session::flash('train_sukses','Training Process Successfully');
        return back();
    
    }

    // CLASSIFICATION TESTING ============================

    public function classification_testing_index(){
        $testing_view =  DB::table('testing')
            ->join('preprocessing', 'testing.id_preprocessing', '=', 'preprocessing.id_preprocessing')
            ->join('datasets', 'testing.id_datasets', '=', 'datasets.ID')
            ->select('testing.*', 'preprocessing.*', 'datasets.*')
            ->get();
        
        $pengujian = DB::table('pengujian')->get();

        return view('classification.classification_testing',['tst'=>$testing_view, 'pgn'=>$pengujian]);
    }

    public function classification_testing_proses(){
        // ================= CLASSIFICATION DATA TESTING =========================
        // =========== PROSES TESTING ===========

        // ================= TF TRAINING POSITIF =========================
        set_time_limit(600);
        $training_pos = DB::table('preprocessing')->where('keterangan', '=', 'training')->where('label', '=', 'positif')->get();
        $filedokpos = array();
        
        foreach($training_pos as $data){
            $teks = $data->stemming;
            array_push($filedokpos, $teks);
        }
        $jumlahFileDokPos = count($filedokpos);
        
        // ================= TF TRAINING NEGATIF =========================
        $training_neg = DB::table('preprocessing')->where('keterangan', '=', 'training')->where('label', '=', 'negatif')->get();
        $filedokneg = array();

        foreach($training_neg as $data){
            $teks = $data->stemming;
            array_push($filedokneg, $teks);
        }
        $jumlahFileDokNeg = count($filedokneg);
        
        // ================= BOBOT KATEGORI POS / NEG =========================
        $Bbt_pos = $jumlahFileDokPos / ($jumlahFileDokPos + $jumlahFileDokNeg);
        $Bbt_neg = $jumlahFileDokNeg / ($jumlahFileDokPos + $jumlahFileDokNeg);
        // echo "<pre> Bobot Positif : ";print_r($Bbt_pos);
        // echo "<pre> Bobot Negatif : ";print_r($Bbt_neg);

        $db_training = TermFreq::all();

        foreach ($db_training as $data) {
            $kata = $data->kata;
            $p_pos = $data->p_wpos; //p_wpos | p_posw
            $p_neg = $data->p_wneg; //p_wneg | p_negw

            DB::update('update tf_testing set p_pos = ?,p_neg=? where kata = ?',
            [$p_pos,$p_neg,$kata]);
        }
        // echo "<pre> kata training";print_r($kata);

        $term_freq = TermFreq::all(); // training
        $list_kata_tst = TermTesting::all(); // tf testing

        foreach ($list_kata_tst as $data) {
            $tf_testKu[]= '/\b'.''.$data->kata.''.'\b/u';
            $P_posTest[] = ''.$data->p_pos.'';
            $P_negTest[] = ''.$data->p_neg.'';
        }

        $call_tf_testing = DB::table('preprocessing')->where('keterangan', '=', 'testing')->get();

        foreach($call_tf_testing as $data){
            $id_preprocessing = $data->id_preprocessing;
            $id_datasets = $data->id_datasets;

            $preg_replace_positif = preg_replace($tf_testKu, $P_posTest, $data->stemming);
            $preg_replace_pos_array = explode(' ', $preg_replace_positif);

            // echo "<pre> Lihat Replace :";print_r($tf_testKu);
            // echo "<pre> Lihat Replace :";print_r($preg_replace_positif);
            // echo "<pre> Lihat Explode :";print_r($preg_replace_pos_array);

            $finalPos = [];
            for ($i=0; $i <count($preg_replace_pos_array); $i++) { 

                if ($preg_replace_pos_array[$i] != "") {
                    if ($preg_replace_pos_array[$i] != '-') {
                        if(preg_match('/[a-zA-Z]/', $preg_replace_pos_array[$i])){
                            $finalPos[] = '1';
                        } else {
                            $finalPos[] = $preg_replace_pos_array[$i];
                        }
                    }
                } else{

                }
            }
            $final_array_pos = implode(" ", $finalPos);
            // echo "<pre> Final Array Neg :";print_r($final_array_neg);
            // echo "<pre> Final Array Pos :";print_r($final_array_pos);

            Testing::create([
                'id_preprocessing' => $id_preprocessing,
                'id_datasets' => $id_datasets,
                'hsl_pos' => $final_array_pos
                ]);

            // ==========================
            $preg_replace_negatif = preg_replace($tf_testKu, $P_negTest, $data->stemming);
            $preg_replace_neg_array = explode(' ', $preg_replace_negatif);
            
            // echo "<pre> Lihat Replace Neg :";print_r($preg_replace_negatif);
            // echo "<pre> Lihat Explode :";print_r($preg_replace_neg_array);

            $finalNeg = [];
            for ($i=0; $i <count($preg_replace_neg_array); $i++) { 

                if ($preg_replace_neg_array[$i] != "") {
                    if ($preg_replace_neg_array[$i] != '-') {
                        if(preg_match('/[a-zA-Z]/', $preg_replace_neg_array[$i])){
                            $finalNeg[] = '1';
                        } else {
                            $finalNeg[] = $preg_replace_neg_array[$i];
                        }
                    }
                } else{

                }
            }
            $final_array_neg = implode(" ", $finalNeg);

            // echo "<pre> Final Array Neg :";print_r($final_array_neg);
            // echo "<pre> Final Array Pos :";print_r($final_array_pos);

            DB::update('update testing set hsl_neg = ? where id_datasets = ?',
                [$final_array_neg,$id_datasets]);

        }

        $testing_call = Testing::all(); // testing
        foreach ($testing_call as $data) {
            $id_datasets = $data->id_datasets;

            $hsl_seleksi_pos = explode(' ',$data->hsl_pos);
            $arg_Pos = array_product($hsl_seleksi_pos);
            $argMaxPos = ($arg_Pos * $Bbt_pos);

            $hsl_seleksi_neg = explode(' ',$data->hsl_neg);
            $arg_Neg = array_product($hsl_seleksi_neg);
            $argMaxNeg = ($arg_Neg * $Bbt_neg);

            echo "<pre> Tanpa bobot :";print_r($arg_Pos);
            echo "<pre> ArgMaxPos :";print_r($argMaxPos);
            
            DB::update('update testing set argmaxPos = ?, argmaxNeg = ? where id_datasets = ?',
            [$argMaxPos,$argMaxNeg,$id_datasets]);

            if ($argMaxPos > $argMaxNeg) {
                DB::table('testing')
                ->where('id_datasets', $id_datasets)
                ->update(['hasil_nb' => 'positif']);
            } else {
                DB::table('testing')
                ->where('id_datasets', $id_datasets)
                ->update(['hasil_nb' => 'negatif']);
            }

        }

        // ============ PENGUJIAN =====================
        $call_nilai = DB::table('preprocessing')->where('keterangan', '=', 'testing')->get();
        $call_nilai2 = Testing::all();

        foreach ($call_nilai as $data) {
            $data_nilai[] = $data->label;
        }

        foreach ($call_nilai2 as $data) {
            $data_nilai2[] = $data->hasil_nb;
        }

        // Accuraccy
        $jml_p = 0;
        $jml_n = 0;
        for ($i=0; $i <count($data_nilai); $i++) { 
            if($data_nilai[$i]==$data_nilai2[$i]){
                $jml_p = $jml_p+1;
            } else{
                $jml_n = $jml_n+1;
            }
        }
        $hasil_acc = ($jml_p/($jml_p+$jml_n))*100;
        echo "<pre> Jumlah Pos :";print_r($jml_p);
        echo "<pre> Jumlah Neg :";print_r($jml_n);
        echo "<pre> Hasil AKurasi :";print_r($hasil_acc);

        // Precision
        $tp = 0;
        $fp = 0;
        for ($i=0; $i <count($data_nilai); $i++) {
            if ($data_nilai[$i]=='positif' && $data_nilai2[$i]=='positif') {
                $tp = $tp+1;
            }elseif ($data_nilai2[$i]=='positif' && $data_nilai[$i]!='positif') {
                $fp = $fp+1;
            }
        }
        $hasil_pos_prec = ($tp/($tp+$fp))*100;
        echo "<pre> TP Pos :";print_r($tp);
        echo "<pre> FP Pos :";print_r($fp);
        echo "<pre> Hasil Prec Pos :";print_r($hasil_pos_prec);

        $tn = 0;
        $fn = 0;
        for ($i=0; $i <count($data_nilai); $i++) {
            if ($data_nilai[$i]=='negatif' && $data_nilai2[$i]=='negatif') {
                $tn = $tn+1;
            }elseif ($data_nilai2[$i]=='negatif' && $data_nilai[$i]!='negatif') {
                $fn = $fn+1;
            }
        }
        $hasil_neg_prec = ($tn/($tn+$fn))*100;
        echo "<pre> TP Neg :";print_r($tn);
        echo "<pre> FP Neg :";print_r($fn);
        echo "<pre> Hasil Prec Neg :";print_r($hasil_neg_prec);

        // Recall
        $tp_r = 0;
        $fp_r = 0;
        for ($i=0; $i <count($data_nilai); $i++) {
            if ($data_nilai[$i]=='positif' && $data_nilai2[$i]=='positif') {
                $tp_r = $tp_r+1;
            }elseif ($data_nilai2[$i]!='positif' && $data_nilai[$i]=='positif') {
                $fp_r = $fp_r+1;
            }
        }
        $hasil_pos_recc = ($tp_r/($tp_r+$fp_r))*100;
        echo "<pre> True Pos :";print_r($tp_r);
        echo "<pre> False Pos :";print_r($fp_r);
        echo "<pre> Hasil Recall Pos :";print_r($hasil_pos_recc);

        $tn_r = 0;
        $fn_r = 0;
        for ($i=0; $i <count($data_nilai); $i++) {
            if ($data_nilai[$i]=='negatif' && $data_nilai2[$i]=='negatif') {
                $tn_r = $tn_r+1;
            }elseif ($data_nilai2[$i]!='negatif' && $data_nilai[$i]=='negatif') {
                $fn_r = $fn_r+1;
            }
        }
        $hasil_neg_recc = ($tn_r/($tn_r+$fn_r))*100;
        echo "<pre> True Neg :";print_r($tn_r);
        echo "<pre> False Neg :";print_r($fn_r);
        echo "<pre> Hasil Recall Neg :";print_r($hasil_neg_recc);

        DB::table('pengujian')->insert([
            'accuracy' => $hasil_acc,
            'prec_pos' => $hasil_pos_prec,
            'prec_neg' => $hasil_neg_prec,
            'rec_pos' => $hasil_pos_recc,
            'rec_neg' => $hasil_neg_recc
        ]);

        Session::flash('class_sukses','Classification Process Successfully');
        return back();
    }

}
