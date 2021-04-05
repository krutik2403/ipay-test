<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Employee;
use Log;

class ImportEmployeeData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $employees;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->employees as $key => $employee) {
            Employee::updateorcreate(['id' => $employee->id], [
                'name' => $employee->employee_name,
                'age' => $employee->employee_age,
                'salary' => $employee->employee_salary,
                'profile_picture' => $employee->profile_image,
            ]);
        }     
    }
}
