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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth'] ], function()
{   
    
    Route::get('/home', 'HomeController@index')->name('home');
    //Invoices
    Route::get('/UpdaloadExcel', 'ExcelController@CargarExcel')->name('UpdaloadExcel');    
    Route::post('/UpdaloadExcel', 'ExcelController@UpdaloadExcel')->name('UpdaloadExcel');
    Route::post('checkInvoices', 'EnviarController@checkInvoices')->name('checkInvoices');
    Route::post('/SendInvoices', 'EnviarController@enviarFacturas')->name('SendInvoices');
    
    //ndc
    Route::get('/UpdaloadNdcExcel', 'ExcelController@CargarNdcExcel')->name('UpdaloadNdcExcel');    
    Route::post('/UpdaloadNdcExcel', 'ExcelController@UpdaloadNdcExcel')->name('UpdaloadNdcExcel');
    Route::post('checkNdc', 'EnviarController@checkNdc')->name('checkNdc');
    Route::post('/SendNdc', 'EnviarController@enviarNdc')->name('SendNdc');
    Route::get('/razones', 'EnviarController@refsrazones')->name('razones');

    //endpoints de lioren
    Route::get('/regiones', 'EnviarController@regiones')->name('regiones');
    Route::get('/ciudades', 'EnviarController@ciudades')->name('ciudades');
    Route::get('/comunas', 'EnviarController@comunas')->name('comunas');

    //reporte de facturas
    Route::get('/ListaFacturas', 'InvoiceController@listadoFacturas')->name('ListaFacturas');
    //ver facturas cargadas
    Route::get('/FacturasCargadas', 'InvoiceController@FacturasCargadas')->name('FacturasCargadas');
    Route::post('/findRefs', 'InvoiceController@findRefs')->name('findRefs');
    Route::post('/findDets', 'InvoiceController@findDets')->name('findDets');
    

    //descargar los documentos facturas/boletas
    Route::get('XML/{id}', 'DownloadController@DownloadXml');
    Route::get('PDF/{id}', 'DownloadController@DownloadPdf');
    
});
