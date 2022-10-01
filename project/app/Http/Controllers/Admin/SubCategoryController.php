<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcats = SubCategory::with('category')->paginate(5);

        return view('admin.subcategory.index', compact('subcats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories',
            'category_id' => 'required',
            'slug' => 'required|unique:sub_categories',
            'image' => 'required|mimes:jpg,png|max:1000'
        ]);

        $input = $request->all();

        $data = new SubCategory();

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/subcategory', $imageName);
            $input['image'] = $imageName;
        }

        $input['slug'] = Str::slug($request->slug);

        $data->fill($input)->save();

        return back()->with('success', 'SubCategory added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name,'.$id,
            'category_id' => 'required',
            'slug' => 'required|unique:sub_categories,slug,'.$id,
            'image' => 'mimes:jpg,png|max:1000'
        ]);

        $input = $request->all();

        $data = SubCategory::findOrFail($id);

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/subcategory', $imageName);

            if($data->image){
                if(file_exists('assets/admin/image/subcategory/'.$data->image)){
                    @unlink('assets/admin/image/subcategory/'.$data->image);
                }
            }

            $input['image'] = $imageName;
        }

        $input['slug'] = str::slug($request->slug);

        $data->fill($input)->update();

        return back()->with('success', 'SubCategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        if($subcategory->childcategories()->count() > 0)
        {
            return back()->with('message', 'Delete Child Category First.');
        }

        if($subcategory->products->count() > 0)
        {
            return back()->with('message', 'Delete Product First.');
        }

        $subcategory->delete();

        if($subcategory->image){

            if(file_exists('assets/admin/image/subcategory/'.$subcategory->image)){
                @unlink('assets/admin/image/subcategory/'.$subcategory->image);
            }
        }

        return back()->with('success', 'SubCategory delete successfully.');
    }

    public function delete($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        if($subcategory->childcategories()->count() > 0)
        {
            return back()->with('message', 'Delete Child Category First.');
        }

        if($subcategory->products->count() > 0)
        {
            return back()->with('message', 'Delete Product First.');
        }

        $subcategory->delete();

        if($subcategory->image){

            if(file_exists('assets/admin/image/subcategory/'.$subcategory->image)){
                @unlink('assets/admin/image/subcategory/'.$subcategory->image);
            }
        }

        return back()->with('success', 'SubCategory delete successfully.');
    }

    public function status($id1, $id2)
    {
        $subcategory = SubCategory::findOrFail($id1);

        $subcategory->status = $id2;
        $subcategory->update();

        return back()->with('success', 'Status update successfully.');
    }

    public function load($id)
    {
        $category = Category::where('status', 1)->findOrFail($id);

        return view('admin.load.subcategory', compact('category'));
    }
}
