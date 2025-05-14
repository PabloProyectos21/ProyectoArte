<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['company_name' => 'NovaTech Solutions',     'nif' => 'A12345678', 'contact_email' => 'contact@novatech.com',     'phone_number' => '912345678'],
            ['company_name' => 'GreenWave Agency',       'nif' => 'B23456789', 'contact_email' => 'hello@greenwave.org',      'phone_number' => '912345679'],
            ['company_name' => 'PixelCraft Studios',     'nif' => 'C34567890', 'contact_email' => 'info@pixelcraft.net',      'phone_number' => '912345680'],
            ['company_name' => 'Bluehound Media',        'nif' => 'D45678901', 'contact_email' => 'team@bluehound.io',        'phone_number' => '912345681'],
            ['company_name' => 'Quantum Systems',        'nif' => 'E56789012', 'contact_email' => 'support@quantumsys.com',   'phone_number' => '912345682'],
            ['company_name' => 'Firefly Logistics',      'nif' => 'F67890123', 'contact_email' => 'contact@fireflylog.com',   'phone_number' => '912345683'],
            ['company_name' => 'Orbit Commerce',         'nif' => 'G78901234', 'contact_email' => 'sales@orbitcommerce.com',  'phone_number' => '912345684'],
            ['company_name' => 'Zenith Apparel Co.',     'nif' => 'H89012345', 'contact_email' => 'hello@zenithapparel.com',  'phone_number' => '912345685'],
        ];

        foreach ($companies as $data) {
            Company::create($data);
        }
    }
}

