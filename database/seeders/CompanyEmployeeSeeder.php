<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class CompanyEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
//    public function run(): void
//    {
//        {
//            // 50 şirket oluştur
//            Company::factory(50)->create()->each(function ($company) {
//                // Her şirket için 1 ila 10 arasında çalışan oluştur
//                Employee::factory(rand(1,5))->create(['company_id' => $company->id]);
//            });
//        }
//    }

    public function run(): void
    {
        $faker = Faker::create();

        // Fake logoların saklanacağı dizin
        $logoDirectory = 'public/logos';
        Storage::makeDirectory($logoDirectory);

        for ($i = 0; $i < 50; $i++) {
            // Şirket oluştur
            $logoFileName = $faker->image(storage_path("app/{$logoDirectory}"), 100, 100, null, false);
            $company = Company::create([
                'name' => $faker->company,
                'email' => $faker->unique()->companyEmail,
                'logo' => $logoFileName,
                'website' => $faker->url,
            ]);

            // Her şirket için 1 ila 5 arasında çalışan oluştur
            $employeeCount = rand(1, 5);
            for ($j = 0; $j < $employeeCount; $j++) {
                Employee::create([
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'company_id' => $company->id,
                ]);
            }
        }
    }

}
