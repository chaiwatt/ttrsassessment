<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/term', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('generate','PDFController@Generate')->name('generate');

Route::get('', 'HomeController@Index')->name('landing.index');
Route::get('front', 'HomeController@Front')->name('landing.front');
Route::get('page/{slug}', 'HomeController@Page')->name('landing.page');
Route::get('tag/{slug}', 'HomeController@Tag')->name('landing.tag');
Route::get('cate/{slug}', 'HomeController@Category')->name('landing.cate');
Route::get('search', 'HomeController@Search')->name('landing.search');
Route::get('change/{locale}', 'LanguageController@Change')->name('change');

Route::group(['prefix' => 'email'], function(){
    Route::get('send','MailController@Send')->name('mail.send');
});

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
    Route::group(['prefix' => 'tinpin'], function(){
        Route::post('companyinfo','Api\TinPinController@CompanyInfo')->name('api.tinpin.companyinfo');            
    });  
    Route::group(['prefix' => 'sms'], function(){
        Route::post('send','Api\SMSController@Send')->name('api.sms.send');           
        Route::post('saveotp','Api\SMSController@SaveOtp')->name('api.sms.saveotp'); 
    }); 
    Route::group(['prefix' => 'profile'], function(){
        Route::post('uploadcanvassignature','Api\ProfileController@UploadCanvasSignature')->name('api.profile.uploadcanvassignature');           
        Route::post('uploadsignature','Api\ProfileController@UploadSignature')->name('api.profile.uploadsignature');           
    }); 
}); 

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'api'], function(){
        Route::group(['prefix' => 'message'], function(){
            Route::post('getmessage','Api\MessageController@GetMessage')->name('api.message.getmessage');   
            Route::post('uploadattachment','Api\MessageController@UploadAttachment')->name('api.message.uploadattachment');   
            Route::post('deleteattachment','Api\MessageController@DeleteAttachment')->name('api.message.deleteattachment');       
        });
        Route::group(['prefix' => 'menu'], function(){
            Route::post('getmenu','Api\MenuController@GetMenu')->name('api.menu.getmenu');           
        });
        Route::group(['prefix' => 'category'], function(){
            Route::post('getcategory','Api\CategoryController@GetCategory')->name('api.category.getcategory');           
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
        Route::group(['prefix' => 'gallery'], function(){
            Route::post('upload','Api\GalleryController@Upload')->name('api.gallery.upload');    
            Route::post('delete','Api\GalleryController@Delete')->name('api.gallery.delete');         
        });
        Route::group(['prefix' => 'feature'], function(){
            Route::post('upload','Api\FeatureController@Upload')->name('api.feature.upload');    
            Route::post('delete','Api\FeatureController@Delete')->name('api.feature.delete');         
        });
        Route::group(['prefix' => 'expert'], function(){
            Route::post('deleteexperience','Api\ExpertController@DeleteExperience')->name('api.expert.deleteexperience');    
            Route::post('deleteeducation','Api\ExpertController@DeleteEducation')->name('api.expert.deleteeducation');         
        });
        Route::group(['prefix' => 'businessplan'], function(){
            Route::group(['prefix' => 'status'], function(){
                Route::post('update','Api\BusinessPlanController@Update')->name('api.businessplan.update');          
            });
        });
        Route::group(['prefix' => 'coverimage'], function(){
            Route::post('add','Api\CoverImageController@Add')->name('api.coverimage.add');          
        });
        Route::group(['prefix' => 'friend'], function(){
            Route::post('addrequest','Api\FriendController@AddRequest')->name('api.friend.addrequest');   
            Route::post('deleterequest','Api\FriendController@DeleteRequest')->name('api.friend.deleterequest');        
            Route::post('acceptrequest','Api\FriendController@AcceptRequest')->name('api.friend.acceptrequest'); 
            Route::post('rejectrequest','Api\FriendController@RejectRequest')->name('api.friend.rejectrequest'); 
            Route::post('deletefriend','Api\FriendController@DeleteFriend')->name('api.friend.deletefriend'); 
        });
        Route::group(['prefix' => 'assessment'], function(){
            Route::post('add','Api\AssessmentController@Add')->name('api.assessment.add');          
        });
        Route::group(['prefix' => 'hid'], function(){
            Route::post('check','Api\HidController@Check')->name('api.hid.check');           
        }); 
        Route::group(['prefix' => 'fulltbp'], function(){
            Route::group(['prefix' => 'companyprofile'], function(){
                Route::post('add','Api\FullTbpCompanyProfileController@CompanyprofileAdd')->name('api.fulltbp.companyprofile.add');           
                Route::group(['prefix' => 'attachement'], function(){
                    Route::post('add','Api\FullTbpCompanyProfileAttachmentController@Add')->name('api.fulltbp.companyprofile.attachement.add');           
                    Route::post('delete','Api\FullTbpCompanyProfileAttachmentController@Delete')->name('api.fulltbp.companyprofile.attachement.delete');           
                });  
            }); 
            Route::group(['prefix' => 'ceo'], function(){
                Route::post('add','Api\FullTbpCompanyCEOController@Add')->name('api.fulltbp.ceo.add');           
                Route::post('get','Api\FullTbpCompanyCEOController@Get')->name('api.fulltbp.ceo.get');  
                Route::post('edit','Api\FullTbpCompanyCEOController@Edit')->name('api.fulltbp.ceo.edit');  
            });
            Route::group(['prefix' => 'employ'], function(){
                Route::post('add','Api\FullTbpCompanyEmployController@Add')->name('api.fulltbp.employ.add');    
                Route::post('delete','Api\FullTbpCompanyEmployController@Delete')->name('api.fulltbp.employ.delete');       
                Route::post('get','Api\FullTbpCompanyEmployController@Get')->name('api.fulltbp.employ.get');  
                Route::post('edit','Api\FullTbpCompanyEmployController@Edit')->name('api.fulltbp.employ.edit'); 
                Route::post('getlist','Api\FullTbpCompanyEmployController@GetList')->name('api.fulltbp.employ.getlist'); 

                Route::group(['prefix' => 'education'], function(){
                    Route::post('add','Api\FullTbpCompanyEmployEducationController@Add')->name('api.fulltbp.employ.education.add');           
                    Route::post('delete','Api\FullTbpCompanyEmployEducationController@Delete')->name('api.fulltbp.employ.education.delete'); 
                }); 
                Route::group(['prefix' => 'experience'], function(){
                    Route::post('add','Api\FullTbpCompanyEmployExperienceController@Add')->name('api.fulltbp.employ.experience.add');           
                    Route::post('delete','Api\FullTbpCompanyEmployExperienceController@Delete')->name('api.fulltbp.employ.experience.delete'); 
                }); 
                Route::group(['prefix' => 'training'], function(){
                    Route::post('add','Api\FullTbpCompanyEmployTrainingController@Add')->name('api.fulltbp.employ.training.add');  
                    Route::post('delete','Api\FullTbpCompanyEmployTrainingController@Delete')->name('api.fulltbp.employ.training.delete');          
                });
                Route::group(['prefix' => 'quantity'], function(){
                    Route::post('edit','Api\FullTbpCompanyEmployQuantityController@Edit')->name('api.fulltbp.employ.quantity.edit');  
                });
            }); 
            
            Route::group(['prefix' => 'stockholder'], function(){
                Route::post('add','Api\FullTbpCompanyStockHolderController@Add')->name('api.fulltbp.stockholder.add');           
                Route::post('delete','Api\FullTbpCompanyStockHolderController@Delete')->name('api.fulltbp.stockholder.delete');  
            });
            Route::group(['prefix' => 'project'], function(){
                Route::group(['prefix' => 'abtract'], function(){
                    Route::post('add','Api\FullTbpProjectAbtractController@Add')->name('api.fulltbp.project.abtract.add');           
                });
                Route::group(['prefix' => 'product'], function(){
                    Route::post('add','Api\FullTbpProjectProductController@Add')->name('api.fulltbp.project.product.add');           
                });
                Route::group(['prefix' => 'productdetail'], function(){
                    Route::post('add','Api\FullTbpProductDetailController@Add')->name('api.fulltbp.project.productdetail.add');           
                });
                Route::group(['prefix' => 'techdev'], function(){
                    Route::post('add','Api\FullTbpProjectTechDevController@Add')->name('api.fulltbp.project.techdev.add');           
                });
                Route::group(['prefix' => 'techdevlevel'], function(){
                    Route::post('add','Api\FullTbpProjectTechDevLevelController@Add')->name('api.fulltbp.project.techdevlevel.add');           
                    Route::post('delete','Api\FullTbpProjectTechDevLevelController@Delete')->name('api.fulltbp.project.techdevlevel.delete');           
                });
                Route::group(['prefix' => 'techdevproblem'], function(){
                    Route::post('add','Api\FullTbpProjectTechDevProblemController@Add')->name('api.fulltbp.project.techdevproblem.add');           
                });
                Route::group(['prefix' => 'projectcertify'], function(){
                    Route::post('edit','Api\FullTbpProjectCertifyController@Edit')->name('api.fulltbp.project.projectcertify.edit');           
                    Route::group(['prefix' => 'upload'], function(){
                        Route::post('add','Api\FullTbpProjectCertifyUploadController@Add')->name('api.fulltbp.project.projectcertify.upload.add');           
                        Route::post('delete','Api\FullTbpProjectCertifyUploadController@Delete')->name('api.fulltbp.project.projectcertify.upload.delete');  
                    });
                });
                Route::group(['prefix' => 'projectaward'], function(){
                    Route::post('add','Api\FullTbpProjectAwardController@Add')->name('api.fulltbp.project.projectaward.add');           
                    Route::post('delete','Api\FullTbpProjectAwardController@Delete')->name('api.fulltbp.project.projectaward.delete');
                });
                Route::group(['prefix' => 'standard'], function(){
                    Route::post('add','Api\FullTbpProjectStandardController@Add')->name('api.fulltbp.project.standard.add');
                    Route::post('edit','Api\FullTbpProjectStandardController@Edit')->name('api.fulltbp.project.standard.edit');           
                    Route::post('delete','Api\FullTbpProjectStandardController@Delete')->name('api.fulltbp.project.standard.delete');
                });
                Route::group(['prefix' => 'plan'], function(){
                    Route::post('add','Api\FullTbpProjectPlanController@Add')->name('api.fulltbp.project.plan.add');
                    Route::post('get','Api\FullTbpProjectPlanController@Get')->name('api.fulltbp.project.plan.get'); 
                    Route::post('edit','Api\FullTbpProjectPlanController@Edit')->name('api.fulltbp.project.plan.edit');           
                    Route::post('delete','Api\FullTbpProjectPlanController@Delete')->name('api.fulltbp.project.plan.delete');
                });
            }); 
            Route::group(['prefix' => 'market'], function(){
                Route::group(['prefix' => 'need'], function(){
                    Route::post('add','Api\FullTbpMarketNeedController@Add')->name('api.fulltbp.market.need.add');           
                });
                Route::group(['prefix' => 'size'], function(){
                    Route::post('add','Api\FullTbpMarketSizeController@Add')->name('api.fulltbp.market.size.add');           
                });
                Route::group(['prefix' => 'share'], function(){
                    Route::post('add','Api\FullTbpMarketShareController@Add')->name('api.fulltbp.market.share.add');           
                });
                Route::group(['prefix' => 'competitive'], function(){
                    Route::post('add','Api\FullTbpMarketCompetitiveController@Add')->name('api.fulltbp.market.competitive.add');           
                });
                Route::group(['prefix' => 'attachment'], function(){
                    Route::post('add','Api\FullTbpMarketAttachmentController@Add')->name('api.fulltbp.market.attachment.add');           
                    Route::post('delete','Api\FullTbpMarketAttachmentController@Delete')->name('api.fulltbp.market.attachment.delete');            
                });
            });
            Route::group(['prefix' => 'sell'], function(){
                Route::post('add','Api\FullTbpSellController@Add')->name('api.fulltbp.sell.add');           
                Route::post('delete','Api\FullTbpSellController@Delete')->name('api.fulltbp.sell.delete'); 
                Route::post('get','Api\FullTbpSellController@Get')->name('api.fulltbp.sell.get'); 
                Route::post('edit','Api\FullTbpSellController@Edit')->name('api.fulltbp.sell.edit');
            });
            Route::group(['prefix' => 'sellstatus'], function(){
                Route::post('get','Api\FullTbpSellStatusController@Get')->name('api.fulltbp.sellstatus.get'); 
                Route::post('edit','Api\FullTbpSellStatusController@Edit')->name('api.fulltbp.sellstatus.edit');
            });
            Route::group(['prefix' => 'debtpartner'], function(){
                Route::post('add','Api\FullTbpDebtPartnerController@Add')->name('api.fulltbp.debtpartner.add'); 
                Route::post('get','Api\FullTbpDebtPartnerController@Get')->name('api.fulltbp.debtpartner.get'); 
                Route::post('delete','Api\FullTbpDebtPartnerController@Delete')->name('api.fulltbp.debtpartner.delete'); 
                Route::post('edit','Api\FullTbpDebtPartnerController@Edit')->name('api.fulltbp.debtpartner.edit');
            });
            Route::group(['prefix' => 'creditpartner'], function(){
                Route::post('add','Api\FullTbpCreditPartnerController@Add')->name('api.fulltbp.creditpartner.add'); 
                Route::post('get','Api\FullTbpCreditPartnerController@Get')->name('api.fulltbp.creditpartner.get'); 
                Route::post('delete','Api\FullTbpCreditPartnerController@Delete')->name('api.fulltbp.creditpartner.delete'); 
                Route::post('edit','Api\FullTbpCreditPartnerController@Edit')->name('api.fulltbp.creditpartner.edit');
            });
            Route::group(['prefix' => 'asset'], function(){
                Route::post('get','Api\FullTbpAssetController@Get')->name('api.fulltbp.asset.get'); 
                Route::post('edit','Api\FullTbpAssetController@Edit')->name('api.fulltbp.asset.edit');
            });
            Route::group(['prefix' => 'investment'], function(){
                Route::post('get','Api\FullTbpInvestmentController@Get')->name('api.fulltbp.investment.get'); 
                Route::post('edit','Api\FullTbpInvestmentController@Edit')->name('api.fulltbp.investment.edit');
            });
            Route::group(['prefix' => 'cost'], function(){
                Route::post('get','Api\FullTbpCostController@Get')->name('api.fulltbp.cost.get'); 
                Route::post('edit','Api\FullTbpCostController@Edit')->name('api.fulltbp.cost.edit');
            });
            Route::group(['prefix' => 'roi'], function(){
                Route::post('edit','Api\FullTbpROIController@Edit')->name('api.fulltbp.roi.edit');
            });
            Route::group(['prefix' => 'companydoc'], function(){
                Route::post('add','Api\FullTbpCompanyDocController@Add')->name('api.fulltbp.companydoc.add');
                Route::post('delete','Api\FullTbpCompanyDocController@Delete')->name('api.fulltbp.companydoc.delete');
            });
        }); 
        Route::group(['prefix' => 'googlecalendar'], function(){
            Route::post('getevents','Api\GoogleCalendarController@GetEvents')->name('api.googlecalendar.getevents');
        });
    }); 
    Route::group(['prefix' => 'dashboard'], function(){
        Route::group(['prefix' => 'admin'], function(){
            Route::group(['prefix' => 'report'], function(){
                Route::get('','DashboardAdminReportController@Index')->name('dashboard.admin.report');           
                Route::post('getevent','DashboardAdminReportController@GetEvent')->name('dashboard.admin.getevent'); 
            }); 
            Route::group(['prefix' => 'assessment'], function(){
                Route::group(['prefix' => 'fee'], function(){
                    Route::get('','DashboardAdminAssessmentFeeController@Index')->name('dashboard.admin.assessment.fee');           
                });       
                Route::group(['prefix' => 'businessplan'], function(){
                    Route::get('','DashboardAdminAssessmentBusinessPlanController@Index')->name('dashboard.admin.assessment.businessplan');           
                    Route::get('view/{id}','DashboardAdminAssessmentBusinessPlanController@View')->name('dashboard.admin.assessment.businessplan.view'); 
                    Route::get('delete/{id}','DashboardAdminAssessmentBusinessPlanController@Delete')->name('dashboard.admin.assessment.businessplan.delete'); 
                });     
                Route::group(['prefix' => 'minitbp'], function(){
                    Route::get('','DashboardAdminAssessmentMiniTbpController@Index')->name('dashboard.admin.assessment.minitbp');           
                    Route::get('view/{id}','DashboardAdminAssessmentMiniTbpController@View')->name('dashboard.admin.assessment.minitbp.view');  
                    Route::get('approve/{id}','DashboardAdminAssessmentMiniTbpController@Approve')->name('dashboard.admin.assessment.minitbp.approve');    
                    Route::get('delete/{id}','DashboardAdminAssessmentMiniTbpController@Delete')->name('dashboard.admin.assessment.minitbp.delete');  
                });  
                Route::group(['prefix' => 'fulltbp'], function(){
                    Route::get('','DashboardAdminAssessmentFullTbpController@Index')->name('dashboard.admin.assessment.fulltbp');            
                    Route::get('view/{id}','DashboardAdminAssessmentFullTbpController@View')->name('dashboard.admin.assessment.fulltbp.view');  
                    Route::post('delete/{id}','DashboardAdminAssessmentFullTbpController@Delete')->name('dashboard.admin.assessment.fulltbp.delete');  
                    Route::get('assigngroup/{id}','DashboardAdminAssessmentFullTbpController@AssignGroup')->name('dashboard.admin.assessment.fulltbp.assigngroup');           
                    Route::post('assigngroupsave/{id}','DashboardAdminAssessmentFullTbpController@AssignGroupSave')->name('dashboard.admin.assessment.fulltbp.assigngroupsave');                     
                    Route::get('assignexpert/{id}','DashboardAdminAssessmentFullTbpController@AssignExpert')->name('dashboard.admin.assessment.fulltbp.assignexpert');           
                    Route::post('assignexpertsave','DashboardAdminAssessmentFullTbpController@AssignExpertSave')->name('dashboard.admin.assessment.fulltbp.assignexpertsave');                     
                    Route::post('assignexpertdelete','DashboardAdminAssessmentFullTbpController@AssignExpertDelete')->name('dashboard.admin.assessment.fulltbp.assignexpertdelete');   
                    Route::post('editassignexpert','DashboardAdminAssessmentFullTbpController@EditAssignExpert')->name('dashboard.admin.assessment.fulltbp.editassignexpert');   
                }); 
                Route::group(['prefix' => 'projectassignment'], function(){
                    Route::get('','DashboardAdminAssessmentProjectAssignmentController@Index')->name('dashboard.admin.assessment.projectassignment');           
                    Route::get('edit/{id}','DashboardAdminAssessmentProjectAssignmentController@Edit')->name('dashboard.admin.assessment.projectassignment.edit');  
                    Route::post('editsave/{id}','DashboardAdminAssessmentProjectAssignmentController@EditSave')->name('dashboard.admin.assessment.projectassignment.editsave');    
                }); 
            });  
            Route::group(['prefix' => 'calendar'], function(){
                Route::get('','DashboardAdminCalendarController@Index')->name('dashboard.admin.calendar');           
                Route::get('create','DashboardAdminCalendarController@Create')->name('dashboard.admin.calendar.create'); 
                Route::post('createsave','DashboardAdminCalendarController@CreateSave')->name('dashboard.admin.calendar.createsave');
                Route::get('edit/{id}','DashboardAdminCalendarController@Edit')->name('dashboard.admin.calendar.edit'); 
                Route::post('editsave/{id}','DashboardAdminCalendarController@EditSave')->name('dashboard.admin.calendar.editsave'); 
                Route::get('delete/{id}','DashboardAdminCalendarController@Delete')->name('dashboard.admin.calendar.delete'); 
            }); 
        }); 
        Route::group(['prefix' => 'expert'], function(){
            Route::get('','DashboardExpertController@Index')->name('dashboard.expert');    
            Route::group(['prefix' => 'fulltbp'], function(){
                Route::get('','DashboardExpertFullTbpController@Index')->name('dashboard.expert.fulltbp');   
                Route::get('view/{id}','DashboardExpertFullTbpController@View')->name('dashboard.expert.fulltbp.view');      
            });        
        }); 
        Route::group(['prefix' => 'company'], function(){
            Route::group(['prefix' => 'report'], function(){
                Route::get('','DashboardCompanyReportController@Index')->name('dashboard.company.report');           
            });      
            Route::group(['prefix' => 'assessment'], function(){
                Route::group(['prefix' => 'assessment'], function(){
                    Route::get('','DashboardCompanyAssessmentAssessmentController@Index')->name('dashboard.company.assessment');           
                }); 
                Route::group(['prefix' => 'minitbp'], function(){
                    Route::get('','DashboardCompanyAssessmentMiniTBPController@Index')->name('dashboard.company.assessment.minitbp'); 
                    Route::get('edit/{id}','DashboardCompanyAssessmentMiniTBPController@Edit')->name('dashboard.company.assessment.minitbp.edit');           
                    Route::post('editsave/{id}','DashboardCompanyAssessmentMiniTBPController@EditSave')->name('dashboard.company.assessment.minitbp.editsave');   
                    Route::get('downloadpdf/{id}','DashboardCompanyAssessmentMiniTBPController@DownloadPDF')->name('dashboard.company.assessment.minitbp.downloadpdf'); 
                    Route::get('submit/{id}','DashboardCompanyAssessmentMiniTBPController@Submit')->name('dashboard.company.assessment.minitbp.submit'); 
                    Route::post('submitsave/{id}','DashboardCompanyAssessmentMiniTBPController@SubmitSave')->name('dashboard.company.assessment.minitbp.submitsave'); 
                }); 
                Route::group(['prefix' => 'fee'], function(){
                    Route::get('','DashboardCompanyAssessmentFeeController@Index')->name('dashboard.company.assessment.fee');           
                    Route::get('invoice/{id}','DashboardCompanyAssessmentFeeController@Invoice')->name('dashboard.company.assessment.fee.invoice');  
                    Route::get('payment/{id}','DashboardCompanyAssessmentFeeController@Payment')->name('dashboard.company.assessment.fee.payment'); 
                    Route::post('paymentsave/{id}','DashboardCompanyAssessmentFeeController@PaymentSave')->name('dashboard.company.assessment.fee.paymentsave'); 
                });  
                Route::group(['prefix' => 'fulltbp'], function(){
                    Route::get('','DashboardCompanyAssessmentFullTbpController@Index')->name('dashboard.company.assessment.fulltbp');  
                    Route::get('edit/{id}','DashboardCompanyAssessmentFullTbpController@Edit')->name('dashboard.company.assessment.fulltbp.edit');   
                    Route::post('editsave/{id}','DashboardCompanyAssessmentFullTbpController@EditSave')->name('dashboard.company.assessment.fulltbp.editsave');   
                    Route::get('downloadpdf/{id}','DashboardCompanyAssessmentFullTbpController@DownloadPDF')->name('dashboard.company.assessment.fulltbp.downloadpdf'); 
                    Route::get('submit/{id}','DashboardCompanyAssessmentFullTbpController@Submit')->name('dashboard.company.assessment.fulltbp.submit'); 
                    Route::post('submitsave/{id}','DashboardCompanyAssessmentFullTbpController@SubmitSave')->name('dashboard.company.assessment.fulltbp.submitsave');        
                }); 
            });       

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
                Route::group(['prefix' => 'banktype'], function(){
                    Route::get('','SettingAdminDashboardBankTypeController@Index')->name('setting.admin.dashboard.banktype');           
                    Route::get('create','SettingAdminDashboardBankTypeController@Create')->name('setting.admin.dashboard.banktype.create'); 
                    Route::post('createsave','SettingAdminDashboardBankTypeController@CreateSave')->name('setting.admin.dashboard.banktype.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBankTypeController@Edit')->name('setting.admin.dashboard.banktype.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBankTypeController@EditSave')->name('setting.admin.dashboard.banktype.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBankTypeController@Delete')->name('setting.admin.dashboard.banktype.delete'); 
                });
                Route::group(['prefix' => 'bankaccount'], function(){
                    Route::get('','SettingAdminDashboardBankAccountController@Index')->name('setting.admin.dashboard.bankaccount');           
                    Route::get('create','SettingAdminDashboardBankAccountController@Create')->name('setting.admin.dashboard.bankaccount.create'); 
                    Route::post('createsave','SettingAdminDashboardBankAccountController@CreateSave')->name('setting.admin.dashboard.bankaccount.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBankAccountController@Edit')->name('setting.admin.dashboard.bankaccount.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBankAccountController@EditSave')->name('setting.admin.dashboard.bankaccount.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBankAccountController@Delete')->name('setting.admin.dashboard.bankaccount.delete'); 
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
                    Route::get('create','SettingAdminWebsitePageCategoryController@Create')->name('setting.admin.website.pagecategory.create'); 
                    Route::post('crud','SettingAdminWebsitePageCategoryController@Crud')->name('setting.admin.website.pagecategory.crud');
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
                Route::group(['prefix' => 'frontpage'], function(){     
                    Route::get('','SettingAdminWebsiteFrontPageController@Index')->name('setting.admin.website.frontpage'); 
                    Route::post('save','SettingAdminWebsiteFrontPageController@Save')->name('setting.admin.website.frontpage.save'); 
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
                    Route::get('editweight/{id}','SettingAdminAssessmentCriteriaGroupController@EditWeight')->name('setting.admin.assessment.criteriagroup.editweight');  
                    Route::post('editweightsave/{id}','SettingAdminAssessmentCriteriaGroupController@EditWeightSave')->name('setting.admin.assessment.criteriagroup.editweightsave');  
                    Route::get('delete/{id}','SettingAdminAssessmentCriteriaGroupController@Delete')->name('setting.admin.assessment.criteriagroup.delete'); 
                });
                Route::group(['prefix' => 'criteria'], function(){
                    Route::get('','SettingAdminAssessmentCriteriaController@Index')->name('setting.admin.assessment.criteria');           
                    Route::get('create','SettingAdminAssessmentCriteriaController@Create')->name('setting.admin.assessment.criteria.create');           
                    Route::post('createsave','SettingAdminAssessmentCriteriaController@CreateSave')->name('setting.admin.assessment.criteria.createsave');           
                    Route::get('edit/{id}','SettingAdminAssessmentCriteriaController@Edit')->name('setting.admin.assessment.criteria.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentCriteriaController@EditSave')->name('setting.admin.assessment.criteria.editsave'); 
                    Route::get('delete/{id}','SettingAdminAssessmentCriteriaController@Delete')->name('setting.admin.assessment.criteria.delete');  
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
            // Route::group(['prefix' => 'businessplan'], function(){
            //     Route::get('edit/{userid}','SettingUserBusinessPlanController@Edit')->name('setting.user.businessplan.edit');           
            //     Route::post('editsave/{id}','SettingUserBusinessPlanController@EditSave')->name('setting.user.businessplan.editsave'); 
            // });
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


