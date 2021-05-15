<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

// Route::get('/{any}', function($any){
//     redirect('/')
// })->where('any', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout');

//Departments
Route::resource('/department', 'DepartmentController');
Route::get('departments/add', 'DepartmentController@departmentadd');

Route::resource('/doctor', 'DoctorController');
Route::get('doctors/add', 'DoctorController@DoctorAdd');
// Route::post('doctors/post', 'DoctorController@DoctorPost');