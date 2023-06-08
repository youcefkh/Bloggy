<?php

use App\Http\Controllers\Admin\FooterLinkController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'adminauth'], function () {
    // Admin Dashboard
    /* Categories */
    Route::get('categories',[\App\Http\Controllers\Admin\CategoryController::class,'index'])->name('categories');
    Route::post('categories',[\App\Http\Controllers\Admin\CategoryController::class,'store'])->name('categories.store');
    Route::post('categories/edit',[\App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('categories.edit');
    Route::post('categories/delete',[\App\Http\Controllers\Admin\CategoryController::class,'destroy'])->name('categories.delete');

    /* Sub-Categories */
    Route::get('subCategories',[\App\Http\Controllers\Admin\SubCategoryController::class,'index'])->name('subcategories');
    Route::get('subcategories/create',[\App\Http\Controllers\Admin\SubCategoryController::class,'create'])->name('subcategories.create');
    Route::post('subcategories/byCategory',[\App\Http\Controllers\Admin\SubCategoryController::class,'getAll'])->name('subcategories.byCategory');
    Route::post('subcategories',[\App\Http\Controllers\Admin\SubCategoryController::class,'store'])->name('subcategories.store');
    Route::post('subcategories/edit',[\App\Http\Controllers\Admin\SubCategoryController::class,'edit'])->name('subcategories.edit');
    Route::post('subcategories/delete',[\App\Http\Controllers\Admin\SubCategoryController::class,'destroy'])->name('subcategories.delete');

    /* Articles */
    Route::get('articles',[\App\Http\Controllers\Admin\ArticleController::class,'index'])->name('articles');
    Route::get('articles/create',[\App\Http\Controllers\Admin\ArticleController::class,'create'])->name('articles.create');
    Route::post('articles/image/upload',[\App\Http\Controllers\Admin\ArticleController::class,'upload'])->name('articles.image.upload');
    Route::post('articles',[\App\Http\Controllers\Admin\ArticleController::class,'store'])->name('articles.store');
    Route::get('articles/{id}',[\App\Http\Controllers\Admin\ArticleController::class,'edit'])->name('articles.edit');
    Route::post('articles/delete',[\App\Http\Controllers\Admin\ArticleController::class,'destroy'])->name('articles.delete');

    /* FAQs */
    Route::get('faqs',[\App\Http\Controllers\Admin\FaqController::class,'index'])->name('faqs');
    Route::post('faqs',[\App\Http\Controllers\Admin\FaqController::class,'store'])->name('faqs.store');
    Route::post('faqs/create',[\App\Http\Controllers\Admin\FaqController::class,'create'])->name('faqs.create');
    Route::post('faqs/edit',[\App\Http\Controllers\Admin\FaqController::class,'edit'])->name('faqs.edit');
    Route::post('faqs/delete',[\App\Http\Controllers\Admin\FaqController::class,'destroy'])->name('faqs.delete');

    /* Policies */
    Route::get('policies',[\App\Http\Controllers\Admin\Settings\PrivacyController::class,'index'])->name('policies');
    Route::post('policies',[\App\Http\Controllers\Admin\Settings\PrivacyController::class,'store'])->name('policies.store');

    /* Terms */
    Route::get('terms',[\App\Http\Controllers\Admin\Settings\TermsController::class,'index'])->name('terms');
    Route::post('terms',[\App\Http\Controllers\Admin\Settings\TermsController::class,'store'])->name('terms.store');

    /* About */
    Route::get('about',[\App\Http\Controllers\Admin\Settings\AboutUsController::class,'index'])->name('about');
    Route::post('about',[\App\Http\Controllers\Admin\Settings\AboutUsController::class,'store'])->name('about.store');

    /* Contacts */
    Route::get('contacts',[\App\Http\Controllers\Admin\ContactController::class,'index'])->name('contacts');
    Route::post('contacts/show',[\App\Http\Controllers\Admin\ContactController::class,'edit'])->name('contacts.show');
    Route::post('contacts/delete',[\App\Http\Controllers\Admin\ContactController::class,'destroy'])->name('contacts.delete');
    Route::get('contacts/notification',[\App\Http\Controllers\Admin\ContactController::class,'notification'])->name('contacts.notification');

    /* Settings */
    Route::get('settings',[\App\Http\Controllers\Admin\Settings\SettingController::class,'index'])->name('settings');
    Route::post('settings',[\App\Http\Controllers\Admin\Settings\SettingController::class,'store'])->name('settings.store');
    Route::post('settings/edit',[\App\Http\Controllers\Admin\Settings\SettingController::class,'edit'])->name('settings.edit');

    /* footer links */
    Route::get('footer-links',[FooterLinkController::class,'index'])->name('footer-links');
    Route::post('footer-links',[FooterLinkController::class,'store'])->name('footer-links.store');
    Route::post('footer-links/edit',[FooterLinkController::class,'edit'])->name('footer-links.edit');
    Route::post('footer-links/delete',[FooterLinkController::class,'destroy'])->name('footer-links.delete');

});