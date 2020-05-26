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
        $this->call(SlideStylesTableSeeder::class);
        $this->call(AssessmentStatusesTableSeeder::class);
        $this->call(WebsiteLayoutsTableSeeder::class);
        $this->call(SlideStatusesTableSeeder::class);
        $this->call(LayoutstylesTableSeeder::class);
        $this->call(UserPositionsTableSeeder::class);
        $this->call(MessagePrioritiesTableSeeder::class);
        $this->call(MessageReadStatusesTableSeeder::class);
        $this->call(FriendStatusesTableSeeder::class);
        $this->call(CriteriasTableSeeder::class);
        $this->call(ReligionsTableSeeder::class);
        $this->call(ExpertPositionsTableSeeder::class);
        $this->call(SlideTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(IntroSectionsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
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
        $this->call(CriteriaGroupsTableSeeder::class);
        $this->call(CriteriaGroupTransactionsTableSeeder::class);
        $this->call(FriendRequestsTableSeeder::class);
        $this->call(FriendsTableSeeder::class);
        $this->call(MessageBoxesTableSeeder::class);
        $this->call(MessageReceivesTableSeeder::class);
        $this->call(MessageBoxAttachmentsTableSeeder::class);
    }
}

