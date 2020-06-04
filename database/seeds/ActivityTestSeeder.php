<?php

use Illuminate\Database\Seeder;

class ActivityTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = factory(\App\Models\Lists::class)->times(10)->create([
            'user_id' => 1
        ]);

        foreach ($lists as $list){
            factory(\App\Models\Activities::class)->times(30)->create([
                'list_id' => $list->id
            ]);
        }

    }
}
