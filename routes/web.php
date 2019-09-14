<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/home', 'HomeController@index')->name('home');

//**************************  Crud Impressoras  *******************************//
Route::get('/nova_printer', 'PrintersController@cadastrar')->name('nova_printer');
Route::post('/store_printer', 'PrintersController@store')->name('store_printer');
Route::get('/consultar_printer', 'PrintersController@consulta')->name('consultar_printer');
Route::get('/editar_printer/{edtIdPrinter}', 'PrintersController@load')->name('editar_printer');
Route::post('/edit_printer/{edtIdPrinter}', 'PrintersController@edit')->name('edit_printer');
Route::get('/delete_printer/{edtIdPrinter}', 'PrintersController@destroy')->name('delete_printer');
//*************************  Fim Crud Impressoras  *****************************//


//**************************  Pesquisa Impressoras  *******************************//
Route::get('/buscar_printer', 'PrintersController@filtros')->name('buscar_printer');
Route::post('/redirecionamento', 'PrintersController@redirecionamento')->name('redirecionamento');

Route::get('/teste', 'PrintersController@index')->name('teste');




Auth::routes();
