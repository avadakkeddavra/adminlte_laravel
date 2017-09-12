<?php

namespace App\Http\Controllers;


use App\Models\Products;
use App\Models\User;
use App\Models\Products as ProductsModel;
use App\Models\Tags as TagsModel;

use App\Jobs\Product\Create as CreateProductsJob;
use App\Jobs\Product\Update as UpdateProductsJob;
use App\Jobs\Product\Delete as DeleteProductsJob;

use App\Http\Requests\Product\Create as CreateProductRequest;
use App\Http\Requests\Product\Destroy as DestroyProductRequest;
use App\Http\Requests\Product\Update as UpdateProductRequest;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $lockManager;

    public function index()
    {
        if (\Auth::user()->isAdmin()) {
            $products_list = ProductsModel::orderBy('created_at', 'desc')->withTrashed()->paginate(10);
            $tags = TagsModel::all();
            $posts = ProductsModel::count();
            $postsUpdated = ProductsModel::where('updated_at', '!=', null)->count();

        } else {

            $products_list = ProductsModel::where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            $tags = TagsModel::all();

            $posts = ProductsModel::where('user_id', \Auth::user()->id)->count();

            /*
             * how many posts was been updated
             * */
            $postsUpdated = ProductsModel::where('user_id','=', \Auth::user()->id)->where('updated_at', '!=', null)->count();


        }

        $tagsCount = TagsModel::count();
        /*
             * time while user was created
             *
         */
        $userExisted = \Auth::user()->created_at;

        $today = date("Y-m-d H:i:s");
        $d1 = strtotime($userExisted);
        $d2 = strtotime($today);
        $diff = $d2 - $d1;
        $diff = $diff / (60 * 60 * 24 * 365);
        $years = floor($diff);

        $widgetData = array(
            'posts' => $posts,
            'tagsCount' => $tagsCount,
            'userExisted' => $years,
            'postsUpdated' => $postsUpdated
        );

        return view('adminlte::products', ['products' => $products_list, 'tags' => $tags, 'widgetData' => $widgetData]);
    }

    public function store(CreateProductRequest $request)
    {
        $this->dispatchNow(new CreateProductsJob($request->all()));

        return redirect()->route('products-page')
            ->with('success', 'Your product was successfully created');
    }

    public function destroy( ProductsModel $product )
    {

        $response =  $this->dispatchNow(new DeleteProductsJob($product));

        return (string)$response;
    }


    public function update(UpdateProductRequest $request, ProductsModel $product)
    {
        $this->dispatchNow(new UpdateProductsJob($product, $request->all()));

        return response()->json([
            'success' => 'Your product was successfully updated'
        ]);
    }

    public function getProductFields(Request $request)
    {
        $product = ProductsModel::where('id', '=', $request->productId)->firstOrFail();
        $tags = $product->tags;
        $response = array('tags' => $tags, 'product' => $product);

        return response()->json($response);
    }

}
