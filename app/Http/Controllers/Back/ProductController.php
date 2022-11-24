<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate('10');
        return view('cms.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'details' => 'required|string',
            'summary' => 'required|string',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'images.*' => 'required|image|max:5120',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:Active,Inactive',
            'featured' => 'required|in:Yes,No'
        ]);

        $filelist = [];

        $files = $request->files->all('images');

        foreach ($files as $file) {
            $img = Image::make($file);
            $filename = "IMG" . date('YmdHis') . rand(1000, 9999) . ".jpg";

            $img->resize(1280, 720, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path("images/{$filename}"));

            $filelist[] = $filename;
        }

        $validated['images'] = $filelist;

        Product::create($validated);

        flash('Product Created.')->success();

        return redirect()->route('cms.products.index');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('cms.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'details' => 'required|string',
            'summary' => 'required|string',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|max:5120',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:Active,Inactive',
            'featured' => 'required|in:Yes,No'
        ]);

        if ($request->hasFile('images')) {
            $filelist = $product->images;

            $files = $request->files->all('images');

            foreach ($files as $file) {
                $img = Image::make($file);
                $filename = "IMG" . date('YmdHis') . rand(1000, 9999) . ".jpg";

                $img->resize(1280, 720, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path("images/{$filename}"));

                $filelist[] = $filename;
            }

            $validated['images'] = $filelist;
        }

        $product->update($validated);

        flash('Product updated.')->success();

        return redirect()->route('cms.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image){
            @unlink('images/'.$image);
        }

        $product->delete();

        return redirect()->route('cms.products.index');
    }

    public function destroyImage(Product $product, $filename)
    {
        if(count($product->images) > 1){

            @unlink('images/'.$filename);

            $newlist = [];

            foreach ($product->images as $image){
                if($image != $filename){
                    $newlist[] = $image;
                }
            }

            $product->update([
                'images' => $newlist
            ]);

            flash('Image removed.')->success();

        }else{
            flash('Atleast one image is needed for product')->error();
        }

        return redirect()->route('cms.products.edit', $product->id);
    }
}
