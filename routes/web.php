<?php

use App\Http\Controllers\EntryDataController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Entry_Data;
use App\Models\Guest;
use App\Models\Staff;
use App\Models\Teacher;
use Dotenv\Parser\Entry;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;




//login

Route::get('/login',[LoginController::class,'loginView']);
Route::post('/login',[LoginController::class,'loginStore']);
Route::get('/logout',[LoginController::class,'Logout']);

Route::middleware(AdminMiddleware::class)->group(function () {


Route::get('/',[HomeController::class,'index']);

// students 
Route::get('/student_register',[StudentController::class,'StudentForm']);
Route::post('/student_register',[StudentController::class,'createStudent']);
Route::get('/studentsDetail',[StudentController::class,'studentsDetailView']);
Route::get('/students/{student}/detail',[StudentController::class,'student_Detail']);
Route::get('/students/{student}/student_QRcode',[StudentController::class,'student_QRcodeView']);
Route::get('/students/{student}/send_email_student',[StudentController::class,'Email_View']);
Route::delete('/students/{student}/delete',[StudentController::class,'student_Detail_Delete']);
Route::get('/students/{student}/edit',[StudentController::class,'student_edit']);
Route::post('/students/{student}/update',[StudentController::class,'student_update']);


// entry
Route::get('/entryData',[EntryDataController::class,'indexx']);

//Teacher

Route::get('/teacher_register',[TeacherController::class,'teacherForm']);
Route::post('/teacher_register',[TeacherController::class,'createTeacher']);
Route::get('/teachersDetail',[TeacherController::class,'teachersDetailView']);
Route::get('/teachers/{teacher}/detail',[TeacherController::class,'teacher_Detail']);
Route::get('/teachers/{teacher}/send_email_teacher',[TeacherController::class,'Email_View']);
Route::get('/teachers/{teacher}/teacher_QRcode',[TeacherController::class,'teacher_QRcodeView']);
Route::get('/teachers/{teacher}/edit',[TeacherController::class,'teacher_edit']);
Route::post('/teachers/{teacher}/update',[TeacherController::class,'teacher_update']);
Route::delete('/teachers/{teacher}/delete',[TeacherController::class,'teacher_Detail_Delete']);





//Staff

Route::get('/staff_register',[StaffController::class,'staffForm']);
Route::post('/staff_register',[StaffController::class,'createStaff']);
Route::get('/staffsDetail',[StaffController::class,'staffsDetailView']);
Route::get('/staffs/{staff}/detail',[StaffController::class,'staff_Detail']);
Route::get('/staffs/{staff}/send_email_staff',[StaffController::class,'Email_View']);
Route::get('/staffs/{staff}/staff_QRcode',[StaffController::class,'staff_QRcodeView']);
Route::get('/staffs/{staff}/edit',[StaffController::class,'staff_edit']);
Route::post('/staffs/{staff}/update',[StaffController::class,'staff_update']);
Route::delete('/staffs/{staff}/delete',[StaffController::class,'staff_Detail_Delete']);


});



// mail
Route::get('/sendMail', [MailController::class, 'form'])->name('mail.form');
Route::post('/send-pdf', [MailController::class, 'send'])->name('mail.send');



//guest
Route::get('/guest_register', [GuestController::class, 'guestForm']);
Route::post('/guest_register', [GuestController::class, 'creatGuest']);
Route::get('/guestsDetail',[GuestController::class,'guestsDetailView']);
Route::get('/guests/{guest}/guest_QRcode',[GuestController::class,'guest_QRcodeView']);
Route::get('/guests/{guest}/send_email_guest',[GuestController::class,'Email_Views']);
Route::get('/send_email_guest',[GuestController::class,'Email_View']);
Route::get('/guest_entryData',[GuestController::class,'indexx']);





// Route::post('/save-qr', [GuestController::class, 'store']);