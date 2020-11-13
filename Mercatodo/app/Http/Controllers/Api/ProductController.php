<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

  

    /**
     * Response at Json whit products resource
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Product::all());
    }
  
    /**
     * @param $file
     */
    private function uploadFile($file)
    {
        $name = time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $name);
        return $name;
    }

   /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $input = $request->all();
        if($request->has('image')){
            $input['image'] = $this->uploadFile($request->image);
        }
        Product::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Producto creado correctamente', 

        ], 200);

    }

    /**
     * @param  Product $product
     * @param int $id
     * @return JsonResponse
     */
    public function show(Product $product, int $id): JsonResponse
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * @param  ProductRequest $request
     * @param  Product  $product
     * @param  int $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        if($request->has('image')){
            $img = public_path() . '/images/'. $product->image;
            File::delete($img);
            $input['image'] = $this->uploadFile($request->image);
            
        }
        $input = $request->all();
        $product->update($input);
        return response()->json([
            'res' => true,
            'message' => 'Producto actualizado correctamente', 

        ], 200);
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Product::destroy($id);
        return response()->json([
            'res' => true,
            'message' => 'Producto inhabilitado correctamente', 

        ], 200);

    }

}
