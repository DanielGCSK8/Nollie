<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Model\Category;
use App\Model\Product;
use App\Model\User;
use App\http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('product');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories = Category::all();
        $Products = Product::withTrashed()->get();
        return view('products.index', compact('Products','Categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Categories = Category::all();
        return view('products.create', compact('Categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $Products = new Product();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $Products->image = $name;
            $file->move(public_path().'/images/', $name);
        }
   
        $Products->name = $request->get('name');
        $Products->price = $request->get('price');
        $Products->category_id = $request->get('category_id');
        $Products->description = $request->get('description');
        $Products->quantity = $request->get('quantity');
        
        
        $Products->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $Categories = Category::all();
        $Products = Product::findOrFail($id);

        return view('products.edit', compact('Products', 'Categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $Products = Product::findOrFail($id);
        
        if ($request->hasFile('image')) {
            $img = public_path() . '/images/'. $Products->image;
            File::delete($img);
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName();
            $Products->image = $name;
            $file->move(public_path().'/images/', $name);        
        }

        
        $validData = $request->validate([
            'name' => 'required|min:3|max:20',
            'price' => 'required|numeric|min:3|',
            'category_id' => 'required',
            
            
        ]);

        $Products->name = $request->get('name');
        $Products->price = $request->get('price');
        $Products->category_id = $request->get('category_id');
        $Products->description = $request->get('description');
        
        
        $Products->update();

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $Products = Product::findOrFail($id);
        $Products->delete();
        return redirect('/products');
    }

    public function restore(int $id)
    {
        Product::onlyTrashed()->where('id', $id)->restore();
        return redirect('/products');
    }

}
