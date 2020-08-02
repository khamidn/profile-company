<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AboutsSeeder::class);
        $this-call(AdministratorSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ProjectsSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(TestimonialsSeeder::class);

        

    }
}
