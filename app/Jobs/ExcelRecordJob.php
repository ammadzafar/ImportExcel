<?php

namespace App\Jobs;

use App\Model\Data;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExcelRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public $file_id;
    public function __construct(array $record,$file_id)
    {
        $this->file_id = $file_id;
        $this->data = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(isset($this->data) && !empty($this->data))
        {
            foreach($this->data as $key => $row)
            {
                $insert_data[] = array(
                    'file_id'  => $this->file_id,
                    'name'   => $row['name'],
                    'roll_number'   => $row['roll_number'],
                    'tester'    => $row['tester'],
                );
            }
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
        }
    }
}
