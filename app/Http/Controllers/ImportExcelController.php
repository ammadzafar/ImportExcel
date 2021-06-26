<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportExcelRequest;
use App\Model\File;
use App\Services\ImportExcel;

class ImportExcelController extends Controller
{
    public $import;

    public function __construct(ImportExcel $import){
        $this->import = $import;
    }

    public function index(){
        $files = File::all();
        return view('import_record.record',compact('files'));
    }

    public function import(ImportExcelRequest $request){
        $this->import->uploadFile($request);
    }

    public function detail($id){
        try {
            //        dd($id);
            $data = File::findOrFail($id);
            return view('import_record.single_record',compact('data'));

        }catch(\Exception $e){
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
}
