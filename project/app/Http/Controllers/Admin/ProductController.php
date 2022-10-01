<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'subcategory', 'childcategory')->paginate(10);
        
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->where('status', 1)->get();
        
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'category_id' => 'required',
            'image' => 'required|mimes:jpg,png|max:1000',
            'slug' => 'required|unique:products,slug',
            'small_details' => 'required',
            'details' => 'required',
            'tag' => 'required',
            'tax' => 'required|numeric',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'meta_title' => 'required',
            'quantity' => 'required|numeric', 
            'selling_price' => 'required|numeric',
            'orginal_price' => 'required|numeric',
        ]);

        $input = $request->all();

        $data = new Product();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/products', $imageName);
            $input['image'] = $imageName;
        }

        $input['slug'] = Str::slug($request->slug);

        if($request->trending)
        {
            $input['trending'] = 1;
        }else{
            $data->trending = 0;
        }

        $data->fill($input)->save();

        return back()->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', '1')->get();
        $subcategories = SubCategory::where('status', 1)->get();
        $childcategories = ChildCategory::where('status', 1)->get();
        return view('admin.product.edit', compact('product','categories', 'subcategories', 'childcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$id,
            'category_id' => 'required',
            'image' => 'mimes:jpg,png|max:1000',
            'slug' => 'required|unique:products,slug,'.$id,
            'small_details' => 'required',
            'details' => 'required',
            'tag' => 'required',
            'tax' => 'required|numeric',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'meta_title' => 'required',
            'quantity' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'orginal_price' => 'required|numeric',
        ]);

        $input = $request->all();

        $data = Product::findOrFail($id);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/products', $imageName);

            if($data->image){
                $path = 'assets/admin/image/products/'.$data->image;
                if(file_exists($path)){
                    @unlink($path);
                }
            }
            
            $input['image'] = $imageName;
        }

        $input['slug'] = Str::slug($request->slug);

        if($request->trending)
        {
            $input['trending'] = 1;
        }else{
            $data->trending = 0;
        }

        $data->fill($input)->update();

        return back()->with('success', 'Product updated successfully!');

    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if($product->image){
            $path = 'assets/admin/image/products/'.$product->image;
            if(file_exists($path)){
                @unlink($path);
            }
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully!');

    }

    public function status($id1, $id2)
    {
        $product = Product::findOrFail($id1);

        $product->status = $id2;
        $product->update();

        return back()->with('success', 'Status updated successfully!');
    }

    public function show($id)
    {
        $product = Product::with('category', 'childcategory', 'subcategory')->findOrFail($id);
        
        return view('admin.product.show', compact('product'));
    }


}
