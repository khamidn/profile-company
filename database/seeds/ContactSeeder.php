<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = new \App\Contact;
        $contact->alamat = "Jl. Raya Soekarno Hatta No.20, Kec. Lowokwaru";
        $contact->kota_kabupaten = "Kota Malang";
        $contact->provinsi = "Jawa Timur";
        $contact->kode_pos = "12345";
        $contact->email1 = "email1@email.com";
        $contact->email2 = "email2@email.com";
        $contact->phone = "4353533";
        $contact->mobile = "12345678901";
        $contact->fax = "1212345123";
        $contact->save();
    }
}
