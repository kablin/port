<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Notifications\SendProductEmail;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rights');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderBy('id')->get();
        return view('products', compact('products'));
    }


    public function available()
    {
        $products = Product::available()->get();
        return view('products', compact('products'));
    }


    public function createproduct(Request $request)
    {
      if (!$request->ajax())
      return abort(403);

    $validated = $request->validate([
      'name' => 'required|min:10',
      'article' => 'required|unique:products|regex:/^[\w-]*$/',
    ]);

    $data=[];
    foreach ($request->input('attrnames') as $key => $value) {
         $data[$value]=$request->input('attrvals')[$key];
    }

    $product = Product::query()->create([
              'article' => $request->input('article'),
              'name' => $request->input('name'),
              'status' => $request->input('status'),
              'data'=>$data,
          ]);

      $resData = [
        'status' => 'ok',
        'product' =>$product->id,

      ];

      \Notification::route('mail', config('app.products.email'))->notify(new SendProductEmail($product));

      return response()->json($resData, Response::HTTP_OK);
    }



    public function getproduct(Request $request, $product_id)
    {
      if (!$request->ajax())
      return abort(403);

      $product = Product::find($product_id);

      $view = view('elements.product', ['product' => $product,])->render();
      $resData = [
        'content' => $view,
      ];

      return response()->json($resData, Response::HTTP_OK);
    }




    public function editproduct(Request $request, $product_id)
    {
      if (!$request->ajax())
      return abort(403);

      $product = Product::find($product_id);


      $view = view('elements.edit-product', ['product' => $product,])->render();
      $resData = [
        'content' => $view,
      ];

      return response()->json($resData, Response::HTTP_OK);
    }





    public function deleteproduct(Request $request, $product_id)
    {
      if (!$request->ajax())
      return abort(403);


      Product::find($product_id)->delete();

      $resData = [
        'status' => 'ok',
      ];

      return response()->json($resData, Response::HTTP_OK);
    }



    public function storeproduct(Request $request, $product_id)
    {
      if (!$request->ajax())
      return abort(403);

      $product = Product::findOrFail($product_id);

      $validated = $request->validate([
        'name' => 'required|min:10',
        'article' => ['required',  Rule::unique('products')->ignore($product_id),'regex:/^[\w-]*$/'],
      ]);

      $data=[];
      foreach ($request->input('attrnames') as $key => $value) {
        $data[$value]=$request->input('attrvals')[$key];
      }

      $user= Auth::user();
      if ($user->can('edit articles'))   $product->article = $request->input('article');

      $product->name = $request->input('name');
      $product->status = $request->input('status');
      $product->data = $data;

      $product->save();

      $resData = [
        'status' => 'ok',
        'product' =>$product->id,

      ];

      return response()->json($resData, Response::HTTP_OK);
    }





}
