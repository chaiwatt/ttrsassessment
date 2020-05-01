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
        $this->call(ProvincesTableSeeder::class);
        $this->call(AmphursTableSeeder::class);
        $this->call(TambolsTableSeeder::class);
        $this->call(UseTypesTableSeeder::class);
        $this->call(PrefixsTableSeeder::class);
        $this->call(GeneralInfosTableSeeder::class);
        $this->call(UserPositionsTableSeeder::class);
        $this->call(ReligionsTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(UserStatusesTableSeeder::class);
        $this->call(BusinessPlanStatusSeeder::class);
        $this->call(PageStatusesTableSeeder::class);
        $this->call(VerifyStatusesTableSeeder::class);
        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(PageCategoriesTableSeeder::class);
        $this->call(EducationBranchesTableSeeder::class);
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(IndustryGroupsTableSeeder::class);
        $this->call(RegisteredCapitalTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
