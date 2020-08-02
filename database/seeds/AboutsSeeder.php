<?php

use Illuminate\Database\Seeder;

class AboutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\About::class, 5)->create();
    }
}
