<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportEmployeeData;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command used to fetch the employees from API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'http://dummy.restapiexample.com/api/v1/employees');
            $response_obj = json_decode($response->getBody());
            if($response_obj->status == 'success' && count($response_obj->data) > 0) {
                $employees = $response_obj->data;
                dispatch(new ImportEmployeeData($employees));
            }

        } catch (\Exception $e) {
            \Log::error($e);
        }
    }
}
