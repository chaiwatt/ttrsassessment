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
        $this->call(UseTypesTableSeeder::class);
        $this->call(PrefixsTableSeeder::class);
        $this->call(GeneralInfosTableSeeder::class);
        $this->call(ReligionsTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(BusinessPlanStatusSeeder::class);
        $this->call(PageStatusesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(EducationBranchesTableSeeder::class);
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(IndustryGroupsTableSeeder::class);
        $this->call(RegisteredCapitalTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
