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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource("requests", "RequestsController");
Route::get("approvals/{headerId}/create", "ApprovalsController@create")->name("approvals.create");
Route::get("approvals", "ApprovalsController@index")->name("approvals.index");
Route::post("approvals", "ApprovalsController@store")->name("approvals.store");
Route::get("materialTypes/{id}", "RequestsController@approvers")->name("requests.approvers");
Route::get("matGroups2/{id}", "ApprovalsController@matGroups2")->name("approvals.matGroups2");
Route::get("matGroups3/{id}", "ApprovalsController@matGroups3")->name("approvals.matGroups3");
