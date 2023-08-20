<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'image' => 'example.jpg',
            'name_ar' => 'موقع الكترونى',
            'name_en' => 'New Website',
            'email' => 'email@example.com',
            'phone' => '0560258430',
            'facebook' => 'https://www.facebook.com',
            'twitter' => 'https://www.twitter.com',
            'instagram' => 'https://www.instagram.com',
            'linkedin' => 'https://www.linkedin.com',
            'address_ar' => 'السعودية - الرياض - السلى - وادى الغيل',
            'address_en' => 'KSA - ALSulay - Wadi Alghail St',
        ]);
    }
}
