<?php

use App\Events\PodcastProcessed;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\select;

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

// Route::resource('customers',CustomerController::class);
// Route::delete('customers/{customer}/forceDestroy',[CustomerController::class,'forceDestroy'])->name('customers.forceDestroy');
// Route::resource('employees',EmployeeController::class);
// Route::get('/', function () {
//     // // Bài 1
//     // DB::table('users', 'u')
//     //     ->select('u.name', DB::raw('SUM(o.amount) as total_spent'))
//     //     ->join('orders as o', 'u.id', '=', 'o.user_id')
//     //     ->groupBy('u.name')
//     //     ->having('total_spent', '>', 1000)
//     //     ->ddRawSql();

//     // //Bai 2
//     // DB::table('orders')
//     //     ->selectRaw('DATE(order_date) as date,COUNT(*) as orders_count,SUM(total_amount) as total_sales')
//     //     ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
//     //     ->groupByRaw('DATE(order_date)')
//     //     ->ddRawSql();



//     // //Bai 3
//     // DB::table('products')
//     //     ->select('product_name')
//     //     ->whereNotExists(function (Builder $query) {
//     //         $query
//     //             ->from('orders')
//     //             ->select(1)
//     //             ->where('orders.prduct_id', 'products.id');
//     //     })
//     //     ->ddRawSql();


//     // //Bài 4
//     // $sql = DB::table('sales')
//     //     ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
//     //     ->groupBy('product_id');

//     // DB::table('products', 'p')
//     //     ->select('p.product_id', 's.total_sold')
//     //     ->joinSub($sql, 's', function ($join) {
//     //         $join->on('p.id', '=', 's.product_id');
//     //     })
//     //     ->where('s.total_sold', '>', 100)
//     //     ->ddRawSql();


        


//     // // Bài 5
//     // DB::table('users', 'u')
//     //     ->select('u.name', 'products.product_name', 'o.order_date')
//     //     ->join('orders as o', 'u.id', '=', 'o.user_id')
//     //     ->join('order_items', 'o.id', '=', 'order_items.order_id')
//     //     ->join('products', 'order_items.product_id', '=', 'product.id')
//     //     ->where('o.order_date', '>=', DB::raw('Now() - INTERVAL 30 DAY'))
//     //     ->ddRawSql();


//     // //Bài 6
//     // DB::table('orders')
//     //     ->join('order_items', 'orders.id', '=', 'order_items.order_id')
//     //     ->select(DB::raw("DATE_FORMAT(orders.order_date, '%Y-%m') as order_month, SUM(order_items.quantity * order_items.price) as total_revenue"))
//     //     ->where('orders.status', 'completed')
//     //     ->groupBy('order_month')
//     //     ->orderBy('order_month', 'desc')
//     //     ->ddRawSql();







//     // //Bài 7 
//     // DB::table('products')
//     //     ->select('products.product_name')
//     //     ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
//     //     ->whereNull('order_items.product_id')
//     //     ->ddRawSql();


//     // //Bài 8
//     // $sql = DB::table('order_items')
//     //     ->select('product_id')
//     //     ->selectRaw('SUM(quantity * price) as total')
//     //     ->groupBy('product_id');

//     // DB::table('products')
//     //     ->select('category_id', 'name')
//     //     ->joinSub($sql, 'revenue', function ($join) {
//     //         $join->on('products.id', '=', 'revenue.product_id');
//     //     })
//     //     ->groupBy('category_id', 'name')
//     //     ->orderByDesc('revenue.total')
//     //     ->ddRawSql();





//     // // Bài 9
//     // DB::table('orders')
//     //     ->select('orders.id', 'users.name', 'orders.order_date', DB::raw('SUM(order_items.quantity * order_items.price) as total_value'))
//     //     ->join('users', 'users.id', '=', 'orders.user_id')
//     //     ->join('order_items', 'orders.id', '=', 'order_items.order_id')
//     //     ->groupBy('orders.id', 'users.name', 'orders.order_date')
//     //     ->havingRaw('total_value > (SELECT AVG(total) FROM (SELECT SUM(order_items.quantity * order_items.price) as total FROM order_items GROUP BY order_id) as averages)')
//     //     ->ddRawSql();



        
//     // //Bài 10 


//     // DB::table('products as p')
//     //     ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
//     //     ->select('p.category_id', 'p.product_name', DB::raw('SUM(oi.quantity) as total_sold'))
//     //     ->groupBy('p.category_id', 'p.product_name')
//     //     ->havingRaw('SUM(oi.quantity) = (
//     //     SELECT MAX(sub.total_sold) FROM (
//     //         SELECT SUM(oi2.quantity) as total_sold
//     //         FROM order_items oi2
//     //         JOIN products p2 ON p2.id = oi2.product_id
//     //         WHERE p2.category_id = p.category_id
//     //         GROUP BY p2.product_name
//     //     ) as sub
//     // )')
//     //     ->ddRawSql();








//     // event(new PodcastProcessed('hello'));
//     // return view('welcome');










//     // echo 1;
//     // return 0;
// });
Route::get('start',[SessionController::class,'start'])->name('session.start');
Route::post('khoitao',[SessionController::class,'khoitaosession'])->name('session.khoitao');
Route::get('edit',[SessionController::class,'edit'])->name('session.edit');
Route::post('capnhat',[SessionController::class,'capnhat'])->name('session.capnhat');
Route::get('confirm',[SessionController::class,'confirm'])->name('session.confirm');
Route::post( 'thanhcong',[SessionController::class,'thanhcong'])->name('session.thanhcong');


Route::resource('students',StudentController::class); 
Route::post('search',[StudentController::class,'search'])->name('search');

