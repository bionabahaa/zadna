<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('logout',"HomeController@logout");

/*
|----------------------------------------------------------------------------
| Admin Panel
|----------------------------------------------------------------------------
*/
//Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');


Route::namespace('Admin')->group(function () {
    Route::get('/',"SignController@index");
    Route::post('/login',"SignController@Login");
    Route::get('logout',"SignController@Logout");
    //route for download excel
    Route::get('downloadExcel/{type}/{model?}/{view?}/{arr?}', 'AdminController@downloadExcel');
    //route for create pdf
    Route::get('pdf/{modelName?}/{viewName?}','AdminController@pdf');


});



Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('main')->group(function () {
// Route::namespace('Admin')->prefix('main')->group(function () {
    Route::get('/',"MainController@index");
    Route::get('/profile','MainController@profile');
    Route::get('/tasks','MainController@get_tasks');
});
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('setting')->group(function () {
// Route::namespace('Admin')->prefix('setting')->group(function () {
    Route::get('/', function () {
        return view('pages.backEnd.settings.index');
    });

//////////////// ////////     Fixedasset routes ////////////////////////////// / /  /
    Route::resource('fixedasset',"Fixedassetcontroller");
    Route::get('data_fixedasset',"Fixedassetcontroller@dataTable");
    Route::post('fixedasset/add_type',"Fixedassetcontroller@typeStore");
    Route::delete('fixedasset/delete_type/{id}',"Fixedassetcontroller@typeDestroy");
//////////////////////////////////////// //////////////////////////////// //////////

//////////////// ////////     Farms routes ////////////////////////////// / /  /
    Route::resource('farm',"FarmController");
    Route::post('farm/upload','FarmController@upload');

//////////////////////////////////////// //////////////////////////////// //////////

//////////////// ////////     Boxes routes ////////////////////////////// / /  /
    Route::resource('boxes',"BoxesController");
    Route::get('data_boxes',"BoxesController@dataTable");
    Route::post('boxes/upload','BoxesController@upload');
    Route::post('boxes/add_soil_analysis','BoxesController@soilanalysisStore');
    Route::delete('boxes/delete_soil_analysis/{id}',"BoxesController@soilanalysisDestroy");

    Route::get('getCrop/{id}','BoxesController@get_crops');


    Route::post('importExcel', 'BoxesController@importExcel');


//////////////////////////////////////// //////////////////////////////// //////////

//////////////// ////////     Crops routes ////////////////////////////// / /  /
    Route::resource('crops',"CropsController");
    Route::get('data_crops',"CropsController@dataTable");
//////////////////////////////////////// //////////////////////////////// //////////


//////////////// ////////     Equipments routes ////////////////////////////// / /  /
    Route::resource('equipments',"EquipmentsController");
    Route::get('data_equipments',"EquipmentsController@dataTable");
    Route::post('equipments/add_type',"EquipmentsController@typeStore");
    Route::delete('equipments/delete_type/{id}',"EquipmentsController@typeDestroy");
    Route::post('equipments/add_test',"EquipmentsController@testStore");
    Route::delete('equipments/delete_test/{id}',"EquipmentsController@testDestroy");
//////////////////////////////////////// //////////////////////////////// //////////


//////////////// ////////     Wells routes ////////////////////////////// / /  /
    Route::resource('wells',"WellsController");
    Route::get('data_wells',"WellsController@dataTable");
    Route::post('wells/add_test',"WellsController@testStore");
    Route::post('wells/upload','WellsController@upload');
    Route::delete('wells/delete_test/{id}',"WellsController@testDestroy");
    Route::post('wells/add_Tec',"WellsController@tecStore");
    Route::delete('wells/delete_Tec/{id}',"WellsController@tecDestroy");
    Route::post('wells/add_tec_test',"WellsController@tecTestStore");
    Route::delete('wells/delete_tec_test/{id}',"WellsController@tecTestDestroy");
    Route::post('wells/upload','WellsController@upload');
    Route::get('get_tec_test',"WellsController@test_dataTable");
    Route::post('wells/add_statistics_water','WellsController@statisticsWaterStore');
    Route::delete('wells/delete_statistics_water/{id}',"WellsController@statisticsWaterDestroy");
    Route::get('generator_mainentance/{id}','WellsController@generator_mainentance');


    Route::get('/well', 'WellsController@index');

    Route::get('/well/excel', 'WellsController@excel')->name('well.excel');


//    Route::post('filter/{modelName}','WellsController@filter');
//////////////////////////////////////// //////////////////////////////// //////////




 //////////////// ////////     Material routes ////////////////////////////// / /  /
    Route::resource('material',"MaterialController");
    Route::get('data_material',"MaterialController@dataTable");
    Route::post('material/add_type',"MaterialController@typeStore");
    Route::post('material/unit_type',"MaterialController@unitStore");
    Route::delete('material/delete_type/{id}',"MaterialController@typeDestroy");
    Route::delete('material/delete_unit/{id}',"MaterialController@unitDestroy");
//////////////////////////////////////// //////////////////////////////// //////////


//////////////// ////////     Irrigation routes ////////////////////////////// / /  /

    Route::resource('irrigation',"IrrigationController");
    Route::get('data_irrigation',"IrrigationController@dataTable");
    Route::get('irrigation/mahbasDatatable/{id}',"IrrigationController@mahbasDatatable");
    Route::get('irrigation/editMahbas/{id}',"IrrigationController@editMahbas");
    Route::post('irrigation/upload','IrrigationController@upload');
    Route::post('irrigation/addMahbas','IrrigationController@addMahbas');
    Route::get('mahbas_coordinate/{id}','IrrigationController@mahbasCoordinate');

    Route::get('line/{id}','IrrigationController@get_lines');
//////////////////////////////////////// //////////////////////////////// //////////

    Route::resource('role',"RoleController");
    Route::get('data_role',"RoleController@dataTable");

    Route::resource('users',"UsersController");

//////////////// ////////     Seasons routes ////////////////////////////// / /  /
    Route::resource('seasons',"SeasonController");
    Route::get('data_seasons/{view_name?}',"SeasonController@dataTable");
    Route::get('season/{name}','SeasonController@getview');
    Route::post('season/import_data','SeasonController@import');
//////////////////////////////////////// //////////////////////////////// //////////



//////////////// ////////     Crew routes ////////////////////////////// / /  /
    Route::resource('crews',"CrewController");
    Route::get('data_crews',"CrewController@dataTable");
    Route::get('dataTableTemporery',"CrewController@dataTableTemporery");
    Route::get('data_crewnote/{user_id?}',"CrewController@dataTable_Usernote");

//    Route::get('temporaryUserNote/{user_id?}',"CrewController@dataTable_Usernote");

    Route::get('data_crew',"CrewController@dataTable");
    Route::get('crew/{crew_type}','CrewController@getview');
    Route::post('crews/block_user',"CrewController@block");
    /////////   user_notes url  /////////////////
    Route::post('temporaryUser/store',"CrewController@addTemoraryUser");
    Route::post('/editcrew/add_note',"CrewController@add_note");
    Route::get('temporary_user/{id}/edit','CrewController@edit_temporary_user');
    Route::post('temporaryUser/update','CrewController@updateTemporaryUser');
    Route::get('note/{id?}/edit',"CrewController@editNote");
 //////////////////////////////////////// //////////////////////////////// //////////







});
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('Disease')->group(function () {
// Route::namespace('Admin')->prefix('Disease')->group(function () {
    //////////////// ////////     Diseases routes ////////////////////////////// / /  /
    Route::resource('diseases',"DiseasesController");
    Route::get('disease/{disease_view}','DiseasesController@getview');
    Route::post('addNewDisease',"DiseasesController@add_new_disease");
    Route::get('data_diseases/{disease_type?}',"DiseasesController@dataTable");
    Route::get('diseaseFollow/{code}',"DiseasesController@dataTable_disease_folow");
    Route::get('diseasePlan/{id}',"DiseasesController@dataTable_disease_plan");
    Route::post('diseasePlan',"DiseasesController@addDiseasePlan");
    Route::get('diseasePlan/{id}/edit',"DiseasesController@editDiseasePlan");
    Route::post('diseasePlan/{id}/store',"DiseasesController@updateDiseasePlan");
    Route::post('diseaseFollow',"DiseasesController@addDiseaseFollow");
    Route::get('diseaseRecord','DiseasesController@dataTable_disease_record');
    Route::get('loosesDisease','DiseasesController@dataTable_disease_looses');
    Route::get('loosesDisease_reason','DiseasesController@showLoosesDisease_reason');
    //////////////////////////////////////// //////////////////////////////// //////////

});

//////////////// ////////     Experiments routes ////////////////////////////// / /  /
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('Experiments')->group(function () {
// Route::namespace('Admin')->prefix('Experiments')->group(function () {
    Route::resource('experiments',"ExperimentController");
    Route::get('data_experiments/{name?}/{id?}',"ExperimentController@dataTable");
    Route::post('execution_step',"ExperimentController@add_execution_step");
    Route::get('getExperimentData/{id}',"ExperimentController@getExperimentData");
    Route::get('{experiment_view}','ExperimentController@getview');
    //////////////////////////////////////// //////////////////////////////// //////////
});

//////////////// ////////     Faults routes ////////////////////////////// / /  /
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('Faults')->group(function () {
// Route::namespace('Admin')->prefix('Faults')->group(function () {
    Route::resource('faults',"FaultController");
    Route::get('data_faults',"FaultController@dataTable");
    Route::get('faultType','FaultController@faultType');
    Route::get('editFault','FaultController@editFault');
    //////////////////////////////////////// //////////////////////////////// //////////
});



Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('operation')->group(function () {
// Route::namespace('Admin')->prefix('operation')->group(function () {
    Route::get('wells',"WellsController@operation_index");
    Route::get('boxes',"BoxesController@operation_index");
    Route::get('irrigation',"IrrigationController@operation_index");
    Route::post('wells/add_statistics_water','WellsController@statisticsWaterStore');
    Route::delete('wells/delete_statistics_water/{id}',"WellsController@statisticsWaterDestroy");
    Route::resource('jura',"JuraController");
    Route::get('data_jura',"JuraController@dataTable");
    Route::get('planting/get_crops',"PlantingController@box_crop");
    Route::get('planting/get_users',"PlantingController@box_user");
    Route::resource('planting',"PlantingController");
    Route::get('data_planting',"PlantingController@dataTable");
    Route::post('planting/add_plan',"PlantingController@PlanStore");
    Route::post('planting/add_plans',"PlantingController@store");
    Route::delete('planting/delete_plan/{id}',"PlantingController@PlanDestroy");

    Route::resource('clean',"CleaningController");
    Route::get('data_clean',"CleaningController@dataTable");
    Route::post('clean/add_planning_irrigation',"CleaningController@planningIrrigationStore");
    Route::delete('clean/delete_planning_irrigation/{id}',"CleaningController@planningIrrigationDestroy");
    Route::resource('protection',"ProtectionController");
    Route::get('data_protection',"ProtectionController@dataTable");
    Route::resource('nutria',"NutriaController");
    Route::get('data_nutria',"NutriaController@dataTable");
    Route::resource('harvest',"HarvestController");
    Route::get('data_harvest',"HarvestController@dataTable");
    Route::resource('sunstainable_operations',"SunstainableOperationsController");
    Route::get('data_sunstainable_operations',"SunstainableOperationsController@dataTable");
    Route::resource('fertilizing',"FertilizingsController");
    Route::get('data_fertilizing',"FertilizingsController@dataTable");
    Route::post('add_notes',"AdminController@notesStore");
    Route::delete('delete_notes/{id}',"AdminController@notesDestroy");
    Route::post('add_costs',"AdminController@operationresourceStore");
    Route::delete('delete_costs/{id}',"AdminController@operationresourceDestroy");
    Route::post('add_recommendtions',"AdminController@recommendationStore");
    Route::delete('delete_recommendtions/{id}',"AdminController@recommendatioDestroy");
    
    Route::resource('separation',"SeparationController");
    Route::get('data_separation',"SeparationController@dataTable");
    Route::get('get_palm_tree',"SeparationController@getPalmTree");

    
    
});
Route::get('operation/show_recommection_details/{id}',"BladeController@get_Recommendtions_Details");
Route::get('operation/get_palm_tree/{id}',"BladeController@getPalmTree");
//Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('operation')->group(function () {
    Route::namespace('Admin')->prefix('costs')->group(function () {
    });
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('stores')->group(function () {
    // Route::namespace('Admin')->prefix('stores')->group(function () {
        Route::get('/', function () {
            return view('pages.backEnd.Store.store');
        });
        Route::resource('stores',"StoreController");
        Route::get('data_stores',"StoreController@dataTable");
        Route::get('orders/',"StoreController@show_orders");
        Route::get('data_orders',"StoreController@dataTable_orders");
        Route::get('change_order_staus',"StoreController@update_status");
        Route::resource('requests',"StoreRequestController");
        Route::get('data_requests',"StoreRequestController@dataTable");
        Route::get('get_order/{id}','StoreController@get_order');
        Route::get('incomplete','StoreController@store_incomplete');
        Route::get('material_operation/{id}','StoreController@material_operation');
        Route::post('save_order/{id}','StoreController@save_order');


        
    });
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('missions')->group(function () {
    // Route::namespace('Admin')->prefix('missions')->group(function () {
        Route::resource('tasks',"TasksController");
        Route::get('data_tasks',"TasksController@dataTable");
        // Route::get('orders/',"StoreController@show_orders");
        // Route::get('data_orders',"StoreController@dataTable_orders");
        // Route::get('change_order_staus',"StoreController@update_status");
});
Route::namespace('Admin')->prefix('Noti')->group(function () {
    Route::get('get_noti',"AdminController@get_noti");
    Route::get('get_noti_count',"AdminController@get_count_noti");
    Route::get('update_seen',"AdminController@update_noti");
    // Route::get('orders/',"StoreController@show_orders");
    // Route::get('data_orders',"StoreController@dataTable_orders");
    // Route::get('change_order_staus',"StoreController@update_status");
});
Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('costs')->group(function () {
    // Route::namespace('Admin')->prefix('costs')->group(function () {
        Route::get('/', function () {
            return view('pages.backEnd.Costs.costs');
        });
        Route::resource('boxes',"CostsController");
        Route::get('data_boxes',"CostsController@dataTable");
        Route::get('palmTree/cost',"CostsController@palm_tree_cost");
        // http://localhost/zadna/costs/boxes
        Route::get('plamtree',"CostsController@plam_tree_index");
    });
    Route::middleware(['CheckLogin'])->namespace('Admin')->prefix('reports')->group(function () {
            Route::get('/', function () {
                return view('pages.backEnd.Reports.reports');
            });
            Route::get('show',"ReportController@index");
            Route::get('data_report/{type?}',"ReportController@dataTable");
            Route::get('show_report/{id?}/{view?}','ReportController@show_report');
    });