<?php

namespace App\Http\Controllers;

use App\Imports\DatasetsImport;
use App\Exports\DatasetsExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Session;
use App\Datasets;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DatasetsController extends Controller
{
    public function datasets_index()
    {
        $datasets = Datasets::all();
        return view('admin.datasets', ['data'=>$datasets]);
    }

    public function export_excel()
	{
		return Excel::download(new DatasetsExport, 'datasets.xlsx');
    }

    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_datasets di dalam folder public
		$file->move('file_datasets',$nama_file);

		// import data
		Excel::import(new DatasetsImport, public_path('/file_datasets/'.$nama_file));

		// notifikasi dengan session
		Session::flash('sukses','Datasets Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('/datasets');
	}

	public function clear_data(){
		DB::table('datasets')->truncate();
		DB::table('preprocessing')->truncate();
		DB::table('pengujian')->truncate();
		DB::table('testing')->truncate();
		DB::table('text_analysis')->truncate();
		DB::table('tf_testing')->truncate();
		DB::table('training')->truncate();

		Session::flash('sukses','Clear Data Successfully');
        return back();
	}

}
