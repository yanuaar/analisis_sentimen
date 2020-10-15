<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Stopword;
use App\Normalisasi;

class FormsController extends Controller
{
    public function stopword_index(){
        $stopword_index = Stopword::all();
        return view('forms.data_stopword', ['stopword' => $stopword_index]);
    }

    public function stopword_tambah()
    {
        return view('forms.data_stopword_tambah');
    }

    public function stopword_store(Request $request)
    {
        $this->validate($request,[
            'kata' => 'required'
            ]);

        Stopword::create([
            'kata' => $request->kata
            ]);

            Session::flash('tambah_sukses','Input Data Successfully');
            return redirect('/data_stopword');
    }

    public function stopword_edit($id){
        $stopword_edit_index = Stopword::find($id);
        return view('forms.data_stopword_edit', ['stopword' => $stopword_edit_index]);
    }

    public function stopword_update($id, Request $request)
    {
        $this->validate($request,[
            'kata' => 'required'
            ]);
            
        $stopword_edit = Stopword::find($id);
        $stopword_edit->kata = $request->kata;
        $stopword_edit->save();

        Session::flash('edit_sukses','Edit Data Successfully');
        return redirect('/data_stopword');
    }

    public function stopword_delete($id){
        $stopword_delete = Stopword::find($id);
        $stopword_delete->delete();

        Session::flash('delete_sukses','Delete Data Successfully');
        return back();
    }

    // Normalisasi
    public function normalisasi_index(){
        $normalisasi_index = Normalisasi::all();
        return view('forms.data_normalisasi', ['normalisasi' => $normalisasi_index]);
    }

    public function normalisasi_tambah()
    {
        return view('forms.data_normalisasi_tambah');
    }

    public function normalisasi_store(Request $request)
    {
        $this->validate($request,[
            'kata_gaul' => 'required',
            'normalisasi' => 'required'
            ]);

        Normalisasi::create([
            'kata_gaul' => $request->kata_gaul,
            'normalisasi' => $request->normalisasi
            ]);

            Session::flash('tambah_sukses','Input Data Successfully');
            return redirect('/data_normalisasi');
    }

    public function normalisasi_edit($id){
        $normalisasi_edit_index = Normalisasi::find($id);
        return view('forms.data_normalisasi_edit', ['normalisasi' => $normalisasi_edit_index]);
    }

    public function normalisasi_update($id, Request $request)
    {
        $this->validate($request,[
            'kata_gaul' => 'required',
            'normalisasi' => 'required'
            ]);
            
        $normalisasi_edit = Normalisasi::find($id);
        $normalisasi_edit->kata_gaul = $request->kata_gaul;
        $normalisasi_edit->normalisasi = $request->normalisasi;
        $normalisasi_edit->save();

        Session::flash('edit_sukses','Edit Data Successfully');
        return redirect('/data_normalisasi');
    }

    public function normalisasi_delete($id){
        $normalisasi_delete = Normalisasi::find($id);
        $normalisasi_delete->delete();

        Session::flash('delete_sukses','Delete Data Successfully');
        return back();
    }

}
