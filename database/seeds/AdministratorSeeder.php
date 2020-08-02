<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administator = new \App\User;
        $administator->name ="sekretaris";
        $administator->username = "sekretaris";
        $administator->email = "mid@email.com";
        $administator->email_verified_at = now();
        $administator->avatar = "belum-ada-avatar.jpg";
        $administator->password = \Hash::make("123456");
        $administator->roles = json_encode(["ADMIN"]);
        $administator->save();
    }
}
