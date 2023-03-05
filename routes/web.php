<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicineController;


Auth::routes(['verify' => true]);

Route::resource('appointments','\App\Http\Controllers\AppointmentController');
Route::resource('prescriptions','\App\Http\Controllers\PrescriptionController');

Route::resource('accounting',AccountingController::class);
Route::resource('invoices',InvoiceController::class);
Route::get('finished',[InvoiceController::class,'finished'])->name('finished');

Route::resource('manage','\App\Http\Controllers\ManageController');

Route::resource('messages','\App\Http\Controllers\MessagesController');
Route::get('sent',[MessagesController::class,'sent'])->name('sent');
Route::post('/starred/{id}',[MessagesController::class,'starred'])->name('starred');

Route::resource('medicine',MedicineController::class);
Route::post('managemedic',[MedicineController::class,'managemedic'])->name('managemedic');



Route::get('/', function () {
    return view('index');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/readpdf/{file}',[HomeController::class,'readpdf'])->name('readpdf');

Route::get('/userappointment',[HomeController::class,'userappointment'])->name('userappointment');
Route::post('/storeUserAppoint',[HomeController::class,'storeUserAppoint'])->name('storeUserAppoint');
Route::post('/updateUserAppoint/{id}',[HomeController::class,'updateUserAppoint'])->name('updateUserAppoint');
Route::get('/deleteOwnAppoint/{id}',[HomeController::class,'deleteOwnAppoint'])->name('deleteOwnAppoint');
Route::get('/cancelAppoint/{id}',[HomeController::class,'cancelAppoint'])->name('cancelAppoint');
Route::post('/emergencyAppoint',[HomeController::class,'emergencyAppoint'])->name('emergencyAppoint');
Route::get('/bookRoom',[HomeController::class,'bookRoom'])->name('bookRoom');
Route::put('/updateRoom',[HomeController::class,'updateRoom'])->name('updateRoom');
Route::get('/getDoctor/{id}',[HomeController::class,'getDoctor'])->name('getDoctor');
Route::get('/getAppoints/{id}',[HomeController::class,'getAppoints'])->name('getAppoints');
Route::get('/getroom/{id}',[HomeController::class,'getroom'])->name('getroom');
Route::get('/getMedicine/{text}',[HomeController::class,'getMedicine'])->name('getMedicine');
Route::get('/getMedicineid/{id}',[HomeController::class,'getMedicineid'])->name('getMedicineid');
Route::get('/getUser/{text}',[HomeController::class,'getUser'])->name('getUser');
Route::get('/getMailCount/{id}',[HomeController::class,'getMailCount'])->name('getMailCount');
Route::post('/sendMail',[HomeController::class,'sendMail'])->name('sendMail');
Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('profile');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/diagnosis/{type}/{id}', [DashboardController::class, 'diagnosis'])->name('diagnosis');
Route::post('/dashboard/setdiagnosis', [DashboardController::class, 'setdiagnosis'])->name('setdiagnosis');
Route::get('/dashboard/gettests', [DashboardController::class, 'gettests'])->name('gettests');
Route::post('/dashboard/settests', [DashboardController::class, 'settests'])->name('settests');
Route::get('/dashboard/donetests/{id}', [DashboardController::class, 'donetests'])->name('donetests');
Route::post('/dashboard/updateTest/{id}', [DashboardController::class, 'updateTest'])->name('updateTest');
Route::get('/dashboard/doctorAppointment', [DashboardController::class, 'doctorAppointment'])->name('doctorAppointment');
Route::get('/dashboard/bookedappointment', [DashboardController::class, 'bookedappointment'])->name('bookedappointment');
Route::get('/dashboard/addpatient', [DashboardController::class, 'addpatient'])->name('addpatient');
Route::get('/dashboard/book4patient', [DashboardController::class, 'book4patient'])->name('book4patient');
Route::get('/dashboard/emergency', [DashboardController::class, 'emergency'])->name('emergency');
Route::get('/dashboard/profile/{id}', [DashboardController::class, 'profileSetting'])->name('profileSetting');
Route::post('/dashboard/profile/{id}/edit', [DashboardController::class, 'editprofile'])->name('editprofile');
Route::post('/dashboard/savepatient', [DashboardController::class, 'savepatient'])->name('savepatient');
Route::post('/dashboard/cancleAppoint', [DashboardController::class, 'cancleAppoint'])->name('cancleAppoint');
Route::get('limits',[DashboardController::class,'limits'])->name('limits');

Route::post('/update', [UserController::class, 'update'])->name('active');
Route::post('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');


Route::get('patientAppoints',[PatientController::class,'appoints'])->name('patientAppoints');
Route::get('prescription',[PatientController::class,'prescription'])->name('patientprescription');
Route::get('preshow/{id}',[PatientController::class,'preshow'])->name('preshow');
Route::get('bills',[PatientController::class,'bills'])->name('bills');
Route::get('Tests',[PatientController::class,'tests'])->name('tests');
Route::get('diagnosing/{id}',[PatientController::class,'diagnosing'])->name('diagnosing');

