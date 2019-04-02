<?php

Route::get('/','FrontController@index');
Route::get('/registracija','FrontController@registracija')->name('registracija');
Route::get('/404',function(){
    return view('pages.404');
});
Route::get('/category/{kontinent}','FrontController@drzave');
Route::get('/category/{kontinent}/{drzava}','FrontController@oblasti');
Route::get('/oblast/{oblast}','FrontController@smestaji');
Route::get('/oblast/{oblast}/ajax','FrontController@stranicenje');
Route::get('/smestaj/{id?}','FrontController@smestaj');

Route::get('/anketa/{id}','FrontController@anketa');
Route::get('/download/{id}','FrontController@cenovnik');

//registracija
Route::post('/login','RegistracijaController@login')->name('login');
Route::post('/register','RegistracijaController@registracija')->name('register');
Route::get('/logout','RegistracijaController@logout')->name('logout');

Route::get('/dokumentacija','FrontController@dokumentacija');

//Rezervacija
Route::post('/rezervacija/{id}','RezervacijaController@insert');
Route::get('/rezervacije','RezervacijaController@showForUser')->name('rezervacije');
Route::get('/rezervacija/delete/{id}','RezervacijaController@delete');

Route::get('/autor','FrontController@autor');
Route::get('/kontakt','FrontController@kontakt');
//admin panel

Route::group(['middleware'=>['admin']],function (){
    Route::get('/admin','AdminUsersController@index')->name('admin');

    Route::get('/admin/korisnici/{id?}','AdminUsersController@Users')->name('korisnici');
    Route::post('/admin/korisnici/add','AdminUsersController@storeUsers')->name('insert');
    Route::post('/admin/korisnici/{id}/update','AdminUsersController@updateUsers')->name('update');
    Route::get('/admin/korisnici/delete/{id}','AdminUsersController@deleteUsers');

    Route::get('/admin/slider','AdminSliderController@show')->name('slider');
    Route::post('/admin/slider/add','AdminSliderController@store')->name('dodajSlikuZaSlider');
    Route::get('/admin/slider/{id}/delete','AdminSliderController@delete');

    Route::get('/admin/meni/{id?}','AdminMeniController@show')->name('meni');
    Route::post('/admin/meni/add','AdminMeniController@add');
    Route::post('/admin/meni/{id}/edit','AdminMeniController@update');
    Route::get('/admin/meni/{id}/delete','AdminMeniController@delete');

    Route::get('/admin/kontinenti/{id?}','AdminKontinentiController@show')->name('kontineti');
    Route::post('/admin/kontinenti/add','AdminKontinentiController@add');
    Route::post('/admin/kontinenti/{id}/edit','AdminKontinentiController@edit');
    Route::get('/admin/kontinenti/{id}/delete','AdminKontinentiController@delete');

    Route::get('/admin/drzave/{id?}','AdminDrzavaController@show')->name('drzave');
    Route::post('/admin/drzave/add','AdminDrzavaController@add');
    Route::post('/admin/drzave/{id}/edit','AdminDrzavaController@edit');
    Route::get('/admin/drzave/{id}/delete','AdminDrzavaController@delete');

    Route::get('/admin/oblasti/{id?}','AdminOblastController@show')->name('oblasti');
    Route::post('/admin/oblasti/add','AdminOblastController@add');
    Route::post('/admin/oblasti/{id}/edit','AdminOblastController@edit');
    Route::get('/admin/oblasti/{id}/delete','AdminOblastController@delete');

    Route::get('/admin/smestaj/{id?}', 'AdminSmestajController@show')->name('smestaj');
    Route::post('/admin/smestaj/insert', 'AdminSmestajController@insert');
    Route::post('/admin/smestaj/{id}/edit', 'AdminSmestajController@edit');
    Route::get('/admin/smestaj/{id}/delete', 'AdminSmestajController@delete');

    Route::get('/admin/slike/{id?}','AdminSmestajController@showSlike')->name('slike');
    Route::post('/admin/slike/{id}/add','AdminSmestajController@addSlike');
    Route::post('/admin/slike/{id}/delete','AdminSmestajController@deleteSlike');

    Route::get('/admin/top','AdminSmestajController@showTop')->name('top');
    Route::get('/admin/top/add/{id}','AdminSmestajController@addTop');
    Route::get('/admin/top/delete/{id}','AdminSmestajController@deleteTop');

    Route::get('/admin/rezervacije','RezervacijaController@showAdmin');

    Route::get('/admin/poslovnice/{id?}','AdminPoslovniceController@show')->name('poslovnice');
    Route::post('/admin/poslovnice/add','AdminPoslovniceController@add');
    Route::post('/admin/poslovnice/edit/{id}','AdminPoslovniceController@edit');
    Route::get('/admin/poslovnice/{id}/delete','AdminPoslovniceController@delete');

    Route::get('/admin/pitanja/{id?}','AdminAnketaController@showPitanja')->name('pitanja');
    Route::post('/admin/pitanja/add','AdminAnketaController@addPitanja');
    Route::post('/admin/pitanja/{id}/edit','AdminAnketaController@editPitanja');
    Route::get('/admin/pitanja/{id}/delete','AdminAnketaController@deletePitanja');

    Route::get('/admin/odgovori/{id?}','AdminAnketaController@showOdgovori')->name('odgovori');
    Route::post('/admin/odgovori/add','AdminAnketaController@addOdgovor');
    Route::post('/admin/odgovori/{id}/edit','AdminAnketaController@editOdgovor');
    Route::get('/admin/odgovori/{id}/delete','AdminAnketaController@deleteOdgovor');
});


