<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/term', function () {
//     return view('welcome');
// });

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('', 'HomeController@Index')->name('landing.index');
Route::get('page/{slug}', 'HomeController@Page')->name('landing.page');
Route::get('change/{locale}', 'LanguageController@Change')->name('change');

Route::group(['prefix' => 'social'], function(){       
    Route::get('/{provider}', 'Auth\LoginController@Redirect')->name('social.login');
    Route::get('callback/{provider}', 'Auth\LoginController@Callback')->name('social.callback');
});


Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => 'location'], function(){
        Route::post('province','Api\LocationController@Province')->name('api.location.province');           
        Route::post('amphur','Api\LocationController@Amphur')->name('api.location.amphur'); 
        Route::post('tambol','Api\LocationController@Tambol')->name('api.location.tambol'); 
    });  
}); 

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'api'], function(){
        Route::group(['prefix' => 'message'], function(){
            Route::post('getmessage','Api\MessageController@GetMessage')->name('api.message.getmessage');           
        });
        Route::group(['prefix' => 'menu'], function(){
            Route::post('getmenu','Api\MenuController@GetMenu')->name('api.menu.getmenu');           
        });
        Route::group(['prefix' => 'pagecategory'], function(){
            Route::post('add','Api\PageCategoryController@Add')->name('api.pagecategory.add');           
            Route::post('edit','Api\PageCategoryController@Edit')->name('api.pagecategory.edit');  
            Route::post('delete','Api\PageCategoryController@Delete')->name('api.pagecategory.delete');  
        });
        Route::group(['prefix' => 'pagetag'], function(){
            Route::post('add','Api\PagetagController@Add')->name('api.pagetag.add');           
            Route::post('edit','Api\PagetagController@Edit')->name('api.pagetag.edit');  
            Route::post('delete','Api\PagetagController@Delete')->name('api.pagetag.delete');  
        });
        Route::group(['prefix' => 'layout'], function(){
            Route::post('edit','Api\LayoutController@Edit')->name('api.layout.edit');           
        });
    }); 
    Route::group(['prefix' => 'dashboard'], function(){
        Route::group(['prefix' => 'admin'], function(){
            Route::get('','DashboardAdminController@Index')->name('dashboard.admin');           
        }); 
        Route::group(['prefix' => 'expert'], function(){
            Route::get('','DashboardExpertController@Index')->name('dashboard.expert');           
        }); 
        Route::group(['prefix' => 'company'], function(){
            Route::get('','DashboardCompanyController@Index')->name('dashboard.company');           
        }); 
    });   
    Route::group(['prefix' => 'sms'], function(){
        Route::get('','SmsController@Index')->name('sms');  
        Route::get('send','SmsController@Send')->name('sms.send');           
        Route::get('credit','SmsController@Credit')->name('sms.credit');  
        Route::post('verify','SmsController@Verify')->name('sms.verify');
    });    
    Route::group(['prefix' => 'setting'], function(){
        Route::group(['prefix' => 'admin'], function(){
            Route::group(['prefix' => 'dashboard'], function(){
                Route::group(['prefix' => 'prefix'], function(){
                    Route::get('','SettingAdminDashboardPrefixController@Index')->name('setting.admin.dashboard.prefix');           
                    Route::get('create','SettingAdminDashboardPrefixController@Create')->name('setting.admin.dashboard.prefix.create'); 
                    Route::post('createsave','SettingAdminDashboardPrefixController@CreateSave')->name('setting.admin.dashboard.prefix.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardPrefixController@Edit')->name('setting.admin.dashboard.prefix.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardPrefixController@EditSave')->name('setting.admin.dashboard.prefix.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardPrefixController@Delete')->name('setting.admin.dashboard.prefix.delete'); 
                }); 
                Route::group(['prefix' => 'religion'], function(){
                    Route::get('','SettingAdminDashboardReligionController@Index')->name('setting.admin.dashboard.religion');           
                    Route::get('create','SettingAdminDashboardReligionController@Create')->name('setting.admin.dashboard.religion.create'); 
                    Route::post('createsave','SettingAdminDashboardReligionController@CreateSave')->name('setting.admin.dashboard.religion.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardReligionController@Edit')->name('setting.admin.dashboard.religion.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardReligionController@EditSave')->name('setting.admin.dashboard.religion.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardReligionController@Delete')->name('setting.admin.dashboard.religion.delete'); 
                });
                Route::group(['prefix' => 'country'], function(){
                    Route::get('','SettingAdminDashboardCountryController@Index')->name('setting.admin.dashboard.country');           
                    Route::get('create','SettingAdminDashboardCountryController@Create')->name('setting.admin.dashboard.country.create'); 
                    Route::post('createsave','SettingAdminDashboardCountryController@CreateSave')->name('setting.admin.dashboard.country.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardCountryController@Edit')->name('setting.admin.dashboard.country.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardCountryController@EditSave')->name('setting.admin.dashboard.country.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardCountryController@Delete')->name('setting.admin.dashboard.country.delete'); 
                });
                Route::group(['prefix' => 'educationbranch'], function(){
                    Route::get('','SettingAdminDashboardEducationBranchController@Index')->name('setting.admin.dashboard.educationbranch');           
                    Route::get('create','SettingAdminDashboardEducationBranchController@Create')->name('setting.admin.dashboard.educationbranch.create'); 
                    Route::post('createsave','SettingAdminDashboardEducationBranchController@CreateSave')->name('setting.admin.dashboard.educationbranch.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardEducationBranchController@Edit')->name('setting.admin.dashboard.educationbranch.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardEducationBranchController@EditSave')->name('setting.admin.dashboard.educationbranch.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardEducationBranchController@Delete')->name('setting.admin.dashboard.educationbranch.delete'); 
                });
                Route::group(['prefix' => 'educationlevel'], function(){
                    Route::get('','SettingAdminDashboardEducationLevelController@Index')->name('setting.admin.dashboard.educationlevel');           
                    Route::get('create','SettingAdminDashboardEducationLevelController@Create')->name('setting.admin.dashboard.educationlevel.create'); 
                    Route::post('createsave','SettingAdminDashboardEducationLevelController@CreateSave')->name('setting.admin.dashboard.educationlevel.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardEducationLevelController@Edit')->name('setting.admin.dashboard.educationlevel.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardEducationLevelController@EditSave')->name('setting.admin.dashboard.educationlevel.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardEducationLevelController@Delete')->name('setting.admin.dashboard.educationlevel.delete'); 
                });
                Route::group(['prefix' => 'businesstype'], function(){
                    Route::get('','SettingAdminDashboardBusinessTypeController@Index')->name('setting.admin.dashboard.businesstype');           
                    Route::get('create','SettingAdminDashboardBusinessTypeController@Create')->name('setting.admin.dashboard.businesstype.create'); 
                    Route::post('createsave','SettingAdminDashboardBusinessTypeController@CreateSave')->name('setting.admin.dashboard.businesstype.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBusinessTypeController@Edit')->name('setting.admin.dashboard.businesstype.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBusinessTypeController@EditSave')->name('setting.admin.dashboard.businesstype.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBusinessTypeController@Delete')->name('setting.admin.dashboard.businesstype.delete'); 
                });
                Route::group(['prefix' => 'industrygroup'], function(){
                    Route::get('','SettingAdminDashboardIndustryGroupController@Index')->name('setting.admin.dashboard.industrygroup');           
                    Route::get('create','SettingAdminDashboardIndustryGroupController@Create')->name('setting.admin.dashboard.industrygroup.create'); 
                    Route::post('createsave','SettingAdminDashboardIndustryGroupController@CreateSave')->name('setting.admin.dashboard.industrygroup.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardIndustryGroupController@Edit')->name('setting.admin.dashboard.industrygroup.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardIndustryGroupController@EditSave')->name('setting.admin.dashboard.industrygroup.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardIndustryGroupController@Delete')->name('setting.admin.dashboard.industrygroup.delete'); 
                });
                Route::group(['prefix' => 'registeredcapitaltype'], function(){
                    Route::get('','SettingAdminDashboardRegisteredCapitalTypeController@Index')->name('setting.admin.dashboard.registeredcapitaltype');           
                    Route::get('create','SettingAdminDashboardRegisteredCapitalTypeController@Create')->name('setting.admin.dashboard.registeredcapitaltype.create'); 
                    Route::post('createsave','SettingAdminDashboardRegisteredCapitalTypeController@CreateSave')->name('setting.admin.dashboard.registeredcapitaltype.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardRegisteredCapitalTypeController@Edit')->name('setting.admin.dashboard.registeredcapitaltype.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardRegisteredCapitalTypeController@EditSave')->name('setting.admin.dashboard.registeredcapitaltype.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardRegisteredCapitalTypeController@Delete')->name('setting.admin.dashboard.registeredcapitaltype.delete'); 
                });
                Route::group(['prefix' => 'businessplanstatus'], function(){
                    Route::get('','SettingAdminDashboardBusinessPlanStatusController@Index')->name('setting.admin.dashboard.businessplanstatus');           
                    Route::get('create','SettingAdminDashboardBusinessPlanStatusController@Create')->name('setting.admin.dashboard.businessplanstatus.create'); 
                    Route::post('createsave','SettingAdminDashboardBusinessPlanStatusController@CreateSave')->name('setting.admin.dashboard.businessplanstatus.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBusinessPlanStatusController@Edit')->name('setting.admin.dashboard.businessplanstatus.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBusinessPlanStatusController@EditSave')->name('setting.admin.dashboard.businessplanstatus.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBusinessPlanStatusController@Delete')->name('setting.admin.dashboard.businessplanstatus.delete'); 
                });
                Route::group(['prefix' => 'userposition'], function(){
                    Route::get('','SettingAdminDashboardUserPositionController@Index')->name('setting.admin.dashboard.userposition');           
                    Route::get('create','SettingAdminDashboardUserPositionController@Create')->name('setting.admin.dashboard.userposition.create'); 
                    Route::post('createsave','SettingAdminDashboardUserPositionController@CreateSave')->name('setting.admin.dashboard.userposition.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardUserPositionController@Edit')->name('setting.admin.dashboard.userposition.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardUserPositionController@EditSave')->name('setting.admin.dashboard.userposition.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardUserPositionController@Delete')->name('setting.admin.dashboard.userposition.delete'); 
                });
                Route::group(['prefix' => 'expertposition'], function(){
                    Route::get('','SettingAdminDashboardExpertPositionController@Index')->name('setting.admin.dashboard.expertposition');           
                    Route::get('create','SettingAdminDashboardExpertPositionController@Create')->name('setting.admin.dashboard.expertposition.create'); 
                    Route::post('createsave','SettingAdminDashboardExpertPositionController@CreateSave')->name('setting.admin.dashboard.expertposition.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardExpertPositionController@Edit')->name('setting.admin.dashboard.expertposition.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardExpertPositionController@EditSave')->name('setting.admin.dashboard.expertposition.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardExpertPositionController@Delete')->name('setting.admin.dashboard.expertposition.delete'); 
                });
                Route::group(['prefix' => 'pageimage'], function(){
                    Route::get('delete/{id}','SettingAdminDashboardPageImageController@Delete')->name('setting.admin.dashboard.pageimage.delete');           
                });
            }); 
            Route::group(['prefix' => 'website'], function(){
                Route::group(['prefix' => 'pagestatus'], function(){
                    Route::get('','SettingAdminWebsitePageStatusController@Index')->name('setting.admin.website.pagestatus');           
                    Route::get('create','SettingAdminWebsitePageStatusController@Create')->name('setting.admin.website.pagestatus.create'); 
                    Route::post('createsave','SettingAdminWebsitePageStatusController@CreateSave')->name('setting.admin.website.pagestatus.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsitePageStatusController@Edit')->name('setting.admin.website.pagestatus.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsitePageStatusController@EditSave')->name('setting.admin.website.pagestatus.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsitePageStatusController@Delete')->name('setting.admin.website.pagestatus.delete'); 
                });
                Route::group(['prefix' => 'pagecategory'], function(){
                    Route::get('','SettingAdminWebsitePageCategoryController@Index')->name('setting.admin.website.pagecategory');           
                    Route::get('create','SettingAdminWebsitePageCategoryController@Create')->name('setting.admin.website.pagecategory.create'); 
                    Route::post('createsave','SettingAdminWebsitePageCategoryController@CreateSave')->name('setting.admin.website.pagecategory.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsitePageCategoryController@Edit')->name('setting.admin.website.pagecategory.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsitePageCategoryController@EditSave')->name('setting.admin.website.pagecategory.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsitePageCategoryController@Delete')->name('setting.admin.website.pagecategory.delete'); 
                });
                Route::group(['prefix' => 'faqcategory'], function(){
                    Route::get('','SettingAdminWebsiteFaqCategoryController@Index')->name('setting.admin.website.faqcategory');           
                    Route::get('create','SettingAdminWebsiteFaqCategoryController@Create')->name('setting.admin.website.faqcategory.create'); 
                    Route::post('createsave','SettingAdminWebsiteFaqCategoryController@CreateSave')->name('setting.admin.website.faqcategory.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteFaqCategoryController@Edit')->name('setting.admin.website.faqcategory.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteFaqCategoryController@EditSave')->name('setting.admin.website.faqcategory.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteFaqCategoryController@Delete')->name('setting.admin.website.faqcategory.delete'); 
                });
                Route::group(['prefix' => 'tag'], function(){
                    Route::get('','SettingAdminWebsiteTagController@Index')->name('setting.admin.website.tag');           
                    Route::get('create','SettingAdminWebsiteTagController@Create')->name('setting.admin.website.tag.create'); 
                    Route::post('createsave','SettingAdminWebsiteTagController@CreateSave')->name('setting.admin.website.tag.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteTagController@Edit')->name('setting.admin.website.tag.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteTagController@EditSave')->name('setting.admin.website.tag.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteTagController@Delete')->name('setting.admin.website.tag.delete'); 
                });
    
                Route::group(['prefix' => 'slide'], function(){
                    Route::get('','SettingAdminWebsiteSlideController@Index')->name('setting.admin.website.slide');           
                    Route::get('create','SettingAdminWebsiteSlideController@Create')->name('setting.admin.website.slide.create'); 
                    Route::post('createsave','SettingAdminWebsiteSlideController@CreateSave')->name('setting.admin.website.slide.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteSlideController@Edit')->name('setting.admin.website.slide.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteSlideController@EditSave')->name('setting.admin.website.slide.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteSlideController@Delete')->name('setting.admin.website.slide.delete'); 
                });
                Route::group(['prefix' => 'introsection'], function(){
                    Route::get('','SettingAdminWebsiteIntroSectionController@Index')->name('setting.admin.website.introsection');           
                    Route::get('create','SettingAdminWebsiteIntroSectionController@Create')->name('setting.admin.website.introsection.create'); 
                    Route::post('createsave','SettingAdminWebsiteIntroSectionController@CreateSave')->name('setting.admin.website.introsection.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteIntroSectionController@Edit')->name('setting.admin.website.introsection.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteIntroSectionController@EditSave')->name('setting.admin.website.introsection.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteIntroSectionController@Delete')->name('setting.admin.website.introsection.delete'); 
                });
                Route::group(['prefix' => 'page'], function(){
                    Route::get('','SettingAdminWebsitePageController@Index')->name('setting.admin.website.page');           
                    Route::get('create','SettingAdminWebsitePageController@Create')->name('setting.admin.website.page.create'); 
                    Route::post('createsave','SettingAdminWebsitePageController@CreateSave')->name('setting.admin.website.page.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsitePageController@Edit')->name('setting.admin.website.page.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsitePageController@EditSave')->name('setting.admin.website.page.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsitePageController@Delete')->name('setting.admin.website.page.delete'); 
                });
                Route::group(['prefix' => 'menu'], function(){     
                    Route::get('create','SettingAdminWebsiteMenuController@Create')->name('setting.admin.website.menu.create'); 
                    Route::post('crud','SettingAdminWebsiteMenuController@Crud')->name('setting.admin.website.menu.crud');
                });
                Route::group(['prefix' => 'layout'], function(){     
                    Route::get('','SettingAdminWebsiteLayoutController@Index')->name('setting.admin.website.layout'); 
                });
            }); 
            Route::group(['prefix' => 'user'], function(){
                Route::get('','SettingAdminUserController@Index')->name('setting.admin.user');           
                Route::get('create','SettingAdminUserController@Create')->name('setting.admin.user.create'); 
                Route::post('createsave','SettingAdminUserController@CreateSave')->name('setting.admin.user.createsave'); 
                Route::get('edit/{id}','SettingAdminUserController@Edit')->name('setting.admin.user.edit'); 
                Route::post('editsave/{id}','SettingAdminUserController@EditSave')->name('setting.admin.user.editsave'); 
                Route::get('delete/{id}','SettingAdminUserController@Delete')->name('setting.admin.user.delete'); 
            });
            Route::group(['prefix' => 'assessment'], function(){
                Route::group(['prefix' => 'criteriagroup'], function(){
                    Route::get('','SettingAdminAssessmentCriteriaGroupController@Index')->name('setting.admin.assessment.criteriagroup');           
                    Route::get('create','SettingAdminAssessmentCriteriaGroupController@Create')->name('setting.admin.assessment.criteriagroup.create'); 
                    Route::post('createsave','SettingAdminAssessmentCriteriaGroupController@CreateSave')->name('setting.admin.assessment.criteriagroup.createsave'); 
                    Route::get('edit/{id}','SettingAdminAssessmentCriteriaGroupController@Edit')->name('setting.admin.assessment.criteriagroup.edit'); 
                    Route::post('editsave/{id}','SettingAdminAssessmentCriteriaGroupController@EditSave')->name('setting.admin.assessment.criteriagroup.editsave'); 
                    Route::get('delete/{id}','SettingAdminAssessmentCriteriaGroupController@Delete')->name('setting.admin.assessment.criteriagroup.delete'); 
                });
            });
        });
        Route::group(['prefix' => 'expert'], function(){

        });
        Route::group(['prefix' => 'user'], function(){
            Route::group(['prefix' => 'company'], function(){
                Route::get('edit/{userid}','SettingUserCompanyController@Edit')->name('setting.user.company.edit');           
                Route::post('editsave/{id}','SettingUserCompanyController@EditSave')->name('setting.user.company.editsave'); 
            });
        });
        Route::group(['prefix' => 'profile'], function(){
            Route::get('edit/{userid}','SettingProfileController@Edit')->name('setting.profile.edit'); 
            Route::post('editsave/{userid}','SettingProfileController@EditSave')->name('setting.profile.editsave'); 
        });
    });   
});  

Route::group(['prefix' => 'line'], function(){
    Route::get('','LineSubScribeController@Index')->name('line');        
    Route::get('linesubscribe/{id}', 'LineSubScribeController@LineSubcribe')->name('line.subcribe');
    Route::get('linecallback', 'LineSubScribeController@LineCallback')->name('line.callback');
    Route::get('linesend', 'LineSubScribeController@LineSend')->name('line.send');           
}); 


