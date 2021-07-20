<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            [
                'modality' => 'Presencial',
                'shift' => 'Mañanas',
                'days' => 'Luneas a Viernes' ,
                'time' => '8am - 2pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Semiprecencial',
                'shift' => 'Mañanas',
                'days' => 'Luneas a Viernes' ,
                'time' => '9am - 1pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Online',
                'shift' => 'Mañanas',
                'days' => 'Luneas a Viernes' ,
                'time' => '10am - 2pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Presencial',
                'shift' => 'Tardes',
                'days' => 'Luneas a Viernes' ,
                'time' => '2pm - 6pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Semipresencial',
                'shift' => 'Tardes',
                'days' => 'Luneas a Viernes' ,
                'time' => '2pm - 6pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Online',
                'shift' => 'Tardes',
                'days' => 'Luneas a Viernes' ,
                'time' => '2pm - 6pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Presencial',
                'shift' => 'Noches',
                'days' => 'Luneas a Viernes' ,
                'time' => '6pm - 10pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Semipresencial',
                'shift' => 'Noches',
                'days' => 'Luneas a Viernes' ,
                'time' => '6pm - 10pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'modality' => 'Online',
                'shift' => 'Noches',
                'days' => 'Luneas a Viernes' ,
                'time' => '6pm - 10pm' ,
                'active' => '1',
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
