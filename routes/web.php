<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartClassController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SpecializedController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Models\Classroom;
use App\Models\Specialized;
use App\Models\Teacher_subject;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class,'FormLogin'])->name('FormLogin');
Route::post('/login', [UserController::class,'PostLogin'])->name('PostLogin');
Route::get('/home', [HomeController::class,'Home'])->name('home');
Route::get('/logout', [UserController::class,'Logout'])->name('Logout');
// Route::resource('faculty', FacultyController::class);

Route::group(['prefix' => 'faculty'], function () {

    Route::resource('faculty', FacultyController::class);

    Route::get('/destroy/{faculty}', [FacultyController::class, 'destroy'])->name('faculty.destroy');
    Route::get('/destroy_all/{faculty}', [FacultyController::class, 'destroy_all'])->name('faculty.destroy_all');
});

Route::group(['prefix' => 'ajax'], function () {

    Route::post('/showSpecialized', [AjaxController::class, 'showSpecialized'])->name('faculty.showSpecialized');
    Route::post('/showClass', [AjaxController::class, 'showClass'])->name('specialized.showClass');
    Route::post('/teacher_subject', [AjaxController::class, 'teacher_subject'])->name('teacher_subject');
    Route::post('/showTeacher', [AjaxController::class, 'showTeacher'])->name('subject.showTeacher');
    Route::post('/showSubject', [AjaxController::class, 'showSubject'])->name('specialized.showSubject');
    Route::post('/ClassShowSubject', [AjaxController::class, 'ClassShowSubject'])->name('ClassShowSubject');
});

Route::resource('role', RoleController::class);

Route::resource('permission', PermissionController::class);


Route::group(['prefix' => 'part_class'], function () {

    Route::resource('part_class', PartClassController::class);


    Route::get('/destroy/{part_class}', [PartClassController::class, 'destroy'])->name('part_class.destroy');
});

Route::group(['prefix' => 'specialized'], function () {

    Route::resource('specialized', SpecializedController::class);


    Route::get('/destroy/{specialized}', [SpecializedController::class, 'destroy'])->name('specialized.destroy');
});

Route::group(['prefix' => 'classroom'], function () {

    Route::resource('classroom', ClassroomController::class);

    Route::get('/destroy/{classroom}', [classroomController::class, 'destroy'])->name('classroom.destroy');
});
Route::group(['prefix' => 'student'], function () {

    Route::resource('student', StudentController::class);

    Route::get('/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
});

Route::group(['prefix' => 'teacher_subject'], function () {

    Route::resource('teacher_subject', TeacherSubjectController::class);

    Route::get('/destroy/{teacher_subject}', [TeacherSubjectController::class, 'destroy'])->name('teacher_subject.destroy');
});

Route::group(['prefix' => 'subject'], function () {

    Route::resource('subject', SubjectController::class);


    Route::get('/destroy/{subject}', [subjectController::class, 'destroy'])->name('subject.destroy');
});



Route::group(['prefix' => 'teacher'], function () {

    Route::resource('teacher', TeacherController::class);


    Route::get('/destroy/{teacher}', [teacherController::class, 'destroy'])->name('teacher.destroy');
});


Route::resource('user_role', UserRoleController::class);

Route::resource('role_permission', RolePermissionController::class);
