<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\ProductsTags;
use Illuminate\Http\Request;
use App\Models\Tags as TagsModel;
use App\Models\Products as ProductsModel;
use DB;
/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
       if(\Auth::user()->isAdmin())
       {
           $tags = DB::table('tags')->select(DB::raw('tags.tag_name, products.created_at, count(*) as CountProd'))->join('products-tags','tags.id','=','products-tags.tag_id')
               ->join('products','products.id','=','products-tags.product_id')->groupBy('tags.tag_name','products.created_at')->get();

       }else{
           $tags = DB::table('tags')->select(DB::raw('tags.tag_name, products.created_at, count(*) as CountProd'))->join('products-tags','tags.id','=','products-tags.tag_id')
               ->join('products','products.id','=','products-tags.product_id')->where('user_id','=',\Auth::user()->id)->groupBy('tags.tag_name','products.created_at')->get();

       }


        return view('adminlte::home',['tags'=> $tags]);

    }
}