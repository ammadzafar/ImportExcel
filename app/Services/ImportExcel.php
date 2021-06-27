<?php


namespace App\Services;


use App\Http\Requests\ImportExcelRequest;
use App\Jobs\ExcelRecordJob;
use App\Model\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel
{
    public function uploadFile(ImportExcelRequest $request){

        try {
            $path = $request->file('select_file')->getRealPath();
            $original_path = $request->file('select_file')->getClientOriginalName();

            $file = new File();
            $file->path = $path;
            $file->unique_name = time().'_'.$path;
            $file->original_name = time().'_'.$original_path;
            $file->save();

            $record = Excel::load($path)->get();
            if ($record){
                ExcelRecordJob::dispatch($record->toArray(),$file->id);
            }
            return redirect()->route('index')->with('success', 'your file is being imported. we will inform you once it is done.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
}
