<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Stemmer\StemmerFactory;
use Illuminate\Support\Facades\DB;
use App\TextAnalysis;
use App\TermTesting;
use App\Normalisasi;
use App\Stopword;
use App\TermFreq;
use App\Testing;
use Session;

class TextAnalysisController extends Controller
{
    public function index(){
        $text_analysis = TextAnalysis::all();
        return view('textanalysis.text_analysis', ['text_analysis' => $text_analysis]);
    }

    public function text_analysis_tambah()
    {
        return view('textanalysis.text_analysis_tambah');
    }

    public function text_analysis_store(Request $request)
    {
        $this->validate($request,[
            'text_input' => 'required'
            ]);

        TextAnalysis::create([
            'text_input' => $request->text_input
            ]);

            Session::flash('tambah_sukses','Input Data Successfully');
            return redirect('/text_analysis');
    }

    public function text_analysis_edit($id){
        $txt_edit_index = TextAnalysis::find($id);
        return view('textanalysis.text_analysis_edit', ['text_analysis' => $txt_edit_index]);
    }

    public function text_analysis_update(Request $request, $id)
    {
        $this->validate($request,[
            'text_input' => 'required'
            ]);
            
        $txt_edit = TextAnalysis::find($id);
        $txt_edit->text_input = $request->text_input;
        $txt_edit->save();

        Session::flash('edit_sukses','Edit Data Successfully');
        return redirect('/text_analysis');
    }

    public function text_analysis_delete($id){
        $txt_delete = TextAnalysis::find($id);
        $txt_delete->delete();

        Session::flash('delete_sukses','Delete Data Successfully');
        return back();
    }

    public function text_analysis_proses(){
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
        
        set_time_limit(600);
        $call_txt = TextAnalysis::all();
        $norm_call = Normalisasi::all();
        $kata_gaul = [];
        $normalisasi = [];

        foreach ($call_txt as $data) {
            $hapus_hashtag = preg_replace('/(\#)([^\s]+)/', '', $data->text_input);
            $hapus_mention = preg_replace('/(\@\w+)/', '', $hapus_hashtag);
            $urlRegex = '~(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|https\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))~';
            $hapus_url = preg_replace($urlRegex, '', $hapus_mention);
            $hapus_symbol = preg_replace('/[^\p{L}\p{N}\s]/u', '', $hapus_url);
            $hapus_angka = preg_replace('/[0-9]+/u', '', $hapus_symbol);
            $hsl_cleaning = trim(preg_replace('/\s\s+/', '  ', $hapus_angka));
            $hsl_casefolding = strtolower($hsl_cleaning);

            $casefolding_update = TextAnalysis::find($data->id);
            $casefolding_update->preprocessing = $hsl_casefolding;
            $casefolding_update->update();
        }

        set_time_limit(600);
        $norm_call = Normalisasi::all();
        $norm_proses = TextAnalysis::all();
        $kata_gaul = [];
        $normalisasi = [];

        foreach($norm_call as $data){
            $kata_gaul[] = '/\b'.''.$data->kata_gaul.''.'\b/u';
            $normalisasi[] = ''.$data->normalisasi.'';
        }
        
        foreach ($norm_proses as $data) {
            $id_prepro = $data->id;
            $hsl_normalisasi = preg_replace($kata_gaul, $normalisasi,$data->preprocessing);

            DB::update('update text_analysis set normalisasi = ? where id = ?',
            [$hsl_normalisasi,$id_prepro]);
        }
        
        set_time_limit(600);
        $list_stopword = array();
        $sw_proses = TextAnalysis::all();
        $sw_call = Stopword::all();

        foreach($sw_call as $data){
            $list_call = $data->kata;
            array_push($list_stopword, $list_call);
        }

        foreach($sw_proses as $data){
            $tweet_stopword = preg_replace('/\b('.implode('|',$list_stopword).')\b/','',$data->normalisasi);

            $stopword_update = TextAnalysis::find($data->id);
            $stopword_update->stopword = $tweet_stopword;
            $stopword_update->update();
        }

        set_time_limit(600);
        $stm_call = TextAnalysis::all();
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();

        foreach ($stm_call as $data) {
            $id_prepro = $data->id;
            $stm_proses = $data->stopword;
            
            $hsl_stem   = $stemmer->stem($stm_proses);

            DB::update('update text_analysis set stemming = ? where id = ?',
            [$hsl_stem,$id_prepro]);
        }
        
        // ================= BOBOT KATEGORI POS / NEG =========================
        $Bbt_pos = $jumlahFileDokPos / ($jumlahFileDokPos + $jumlahFileDokNeg);
        $Bbt_neg = $jumlahFileDokNeg / ($jumlahFileDokPos + $jumlahFileDokNeg);

        $list_kata_tst = TermFreq::all(); // tf training

        foreach ($list_kata_tst as $data) {
            $tf_testKu[]= '/\b'.''.$data->kata.''.'\b/u';
            $P_posTest[] = ''.$data->p_wpos.'';
            $P_negTest[] = ''.$data->p_wneg.'';
        }

        set_time_limit(600);
        $call_tf_testing = TextAnalysis::all();

        foreach($call_tf_testing as $data){
            $id_text_analysis = $data->id;

            $preg_replace_positif = preg_replace($tf_testKu, $P_posTest, $data->stemming);
            $preg_replace_pos_array = explode(' ', $preg_replace_positif);

            // echo "<pre> Lihat Replace :";print_r($id_text_analysis);
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
            DB::update('update text_analysis set hsl_pos = ? where id = ?',
                [$final_array_pos,$id_text_analysis]);
            
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

            DB::update('update text_analysis set hsl_neg = ? where id = ?',
                [$final_array_neg,$id_text_analysis]);
        }

        $txt_call = TextAnalysis::all(); // testing
        foreach ($txt_call as $data) {
            $id_text_analysis = $data->id;

            $hsl_seleksi_pos = explode(' ',$data->hsl_pos);
            $arg_Pos = array_product($hsl_seleksi_pos);
            $argMaxPos = ($arg_Pos * $Bbt_pos);

            $hsl_seleksi_neg = explode(' ',$data->hsl_neg);
            $arg_Neg = array_product($hsl_seleksi_neg);
            $argMaxNeg = ($arg_Neg * $Bbt_neg);

            // echo "<pre> Tanpa bobot :";print_r($arg_Pos);
            // echo "<pre> ArgMaxPos :";print_r($argMaxPos);
            DB::update('update text_analysis set argmaxPos = ?, argmaxNeg = ? where id = ?',
            [$argMaxPos,$argMaxNeg,$id_text_analysis]);

            if ($argMaxPos > $argMaxNeg) {
                DB::table('text_analysis')
                ->where('id', $id_text_analysis)
                ->update(['hasil_nb' => 'positif']);
            } else {
                DB::table('text_analysis')
                ->where('id', $id_text_analysis)
                ->update(['hasil_nb' => 'negatif']);
            }
        }

        Session::flash('class_sukses','Text Analysis Process Successfully');
        return back();
    }

}
