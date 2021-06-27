<?php


namespace App\Services;


use App\Http\Requests\ImportExcelRequest;
use App\Model\Data;
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

            if($record->count() > 0)
            {
                foreach($record->toArray() as $key => $row)
                {
                        $insert_data[] = array(
                            'file_id'  => $file->id,
                            'name'   => $row['name'],
                            'roll_number'   => $row['roll_number'],
                            'tester'    => $row['tester'],
                        );
//                        dd($insert_data);

                }
//                dd($insert_data);
                if(!empty($insert_data))
                {
                    foreach ($insert_data as $data){
                        $store = new Data();
                        $store->file_id = $data['file_id'];
                        $store->name = $data['name'];
                        $store->roll_number = $data['roll_number'];
                        $store->tester = $data['tester'];
                        $store->save();
                    }
                }
                return back()->with('success', 'Excel Data Imported successfully.');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
}
