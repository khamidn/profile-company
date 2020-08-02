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

Route::get('/', 'globalHomeController@index')->name('home.index');

Route::prefix('services')->group(function(){
	Route::get('/', 'globalServiceController@index')->name('services.index');
	Route::get('{services}', 'globalServiceController@slug')->name('services.slug');	
});

Route::prefix('projects')->group(function(){
	Route::get('/', 'globalProjectController@index')->name('projects.index');
	Route::get('{projects}', 'globalProjectController@slug')->name('projects.slug');
});

Route::get('about', 'globalAboutController@index')->name('about.index');

Route::get('contact', 'globalContactController@index')->name('contact.index');

Route::get('testimonials', 'globalTestimonialController@index')->name('testimonials.index');

Route::prefix('admin')->group(function(){
	Auth::routes();
	
	Route::match(["GET", "POST"], "/register", function(){
		return redirect("/admin/login");
	})->name("register");

	Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');

	Route::prefix('manage-home-slider')->middleware('auth')->group(function(){
		Route::get('trash', 'adminHomeSliderController@trash')
				->name('manage-home-slider.trash');
		Route::post('{id}/restore', 'adminHomeSliderController@restore')
				->name('manage-home-slider.restore');
		Route::delete('{id}/delete-permanent', 'adminHomeSliderController@deletePermanent')
				->name('manage-home-slider.delete-permanent');
	});
	Route::resource('manage-home-slider', 'adminHomeSliderController')
			->except('show')->middleware('auth');

	Route::prefix('manage-services')->middleware('auth')->group(function(){
		Route::get('trash', 'adminServicesController@trash')
				->name('manage-services.trash');
		Route::post('{id}/restore', 'adminServicesController@restore')
				->name('manage-services.restore');
		Route::delete('{id}/delete-permanent', 'adminServicesController@deletePermanent')
				->name('manage-services.delete-permanent');
	});
	Route::resource('manage-services', 'adminServicesController')->middleware('auth');

	Route::prefix('manage-projects')->middleware('auth')->group(function(){
		Route::get('trash', 'adminProjectsController@trash')
				->name('manage-projects.trash');
		Route::post('{id}/restore', 'adminProjectsController@restore')
				->name('manage-projects.restore');
		Route::delete('{id}/delete-permanent', 'adminProjectsController@deletePermanent')
				->name('manage-projects.delete-permanent');	
	});
	Route::resource('manage-projects', 'adminProjectsController')->middleware('auth');

	Route::prefix('manage-about')->middleware('auth')->group(function(){
		Route::get('trash', 'adminAboutController@trash')
				->name('manage-about.trash');
		Route::post('m{id}/restore', 'adminAboutController@restore')
				->name('manage-about.restore');
		Route::delete('{id}/delete-permanent', 'adminAboutController@deletePermanent')
				->name('manage-about.delete-permanent');
	});
	Route::resource('manage-about', 'adminAboutController')->middleware('auth');

	Route::resource('manage-contact', 'adminContactController')
				->only(['index', 'update'])->middleware('auth');

	Route::prefix('manage-testimonials')->middleware('auth')->group(function(){
		Route::get('trash', 'adminTestimonialsController@trash')
				->name('manage-testimonials.trash');
		Route::post('{id}/restore', 'adminTestimonialsController@restore')
				->name('manage-testimonials.restore');
		Route::delete('{id}/delete-permanent', 'adminTestimonialsController@deletePermanent')
				->name('manage-testimonials.delete-permanent');
	});
	Route::resource('manage-testimonials','adminTestimonialsController')->middleware('auth');

	Route::prefix('manage-sosmeds')->middleware('auth')->group(function(){
		Route::get('trash', 'adminSosmedsController@trash')
				->name('manage-sosmeds.trash');
		Route::post('{id}/restore', 'adminSosmedsController@restore')
				->name('manage-sosmeds.restore');
		Route::delete('{id}/delete-permanent', 'adminSosmedsController@deletePermanent')
				->name('manage-sosmeds.delete-permanent');
	});
	Route::resource('manage-sosmeds', 'adminSosmedsController')->middleware('auth');

	Route::resource('profile', 'adminProfileController')
				->only(['index', 'edit', 'update'])
				->middleware('auth');
});






