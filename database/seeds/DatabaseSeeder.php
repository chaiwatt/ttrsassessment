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
        $this->call(BusinessPlanActiveStatusesTableSeeder::class);
        $this->call(WebsiteLayoutsTableSeeder::class);
        $this->call(EmployPositionsTableSeeder::class);
        $this->call(StockHoldersTableSeeder::class);
        $this->call(BankTypesTableSeeder::class);
        $this->call(BankAccountsTableSeeder::class);
        $this->call(SlideStatusesTableSeeder::class);
        $this->call(LayoutstylesTableSeeder::class);
        $this->call(UserPositionsTableSeeder::class);
        $this->call(SocialLoginStatusesTableSeeder::class);
        $this->call(EvTypesTableSeeder::class);
        $this->call(PillarsTableSeeder::class);
        $this->call(SubPillarsTableSeeder::class);
        $this->call(SubPillarIndicesTableSeeder::class); 
        $this->call(IndexTypesTableSeeder::class);
        $this->call(SignatureStatusesTableSeeder::class);
        $this->call(PaymentStatusesSeeder::class);
        $this->call(ExpertAssignmentStatusesTableSeeder::class);
        $this->call(UserGroupsTableSeeder::class);
        $this->call(MessagePrioritiesTableSeeder::class);
        $this->call(FeeTypesTableSeeder::class);
        $this->call(AllowAssessmentsTableSeeder::class);
        $this->call(NoneLegalEntityTypesTableSeeder::class);
        $this->call(MessageReadStatusesTableSeeder::class);
        $this->call(FriendStatusesTableSeeder::class);
        $this->call(FrontPagStatusesTableSeeder::class);
        $this->call(ThaiBanksTableSeeder::class);
        $this->call(FrontPagesTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(UserAlertStatusesTableSeeder::class);
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
        $this->call(IndustryGroupByIsicsTableSeeder::class);
        $this->call(RegisteredCapitalTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CriteriaGroupsTableSeeder::class);
        $this->call(CriteriaGroupTransactionsTableSeeder::class);
        $this->call(ClustersTableSeeder::class);
        $this->call(SubClustersTableSeeder::class);
        $this->call(ExtraFactorsTableSeeder::class);
        $this->call(SubExtraFactorsTableSeeder::class);
        
        // $this->call(FriendRequestsTableSeeder::class);
        // $this->call(FriendsTableSeeder::class);
        // $this->call(MessageBoxesTableSeeder::class);
        // $this->call(MessageReceivesTableSeeder::class);
        // $this->call(MessageBoxAttachmentsTableSeeder::class);
    }
}

