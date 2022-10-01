<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childcats = ChildCategory::with('subcategory')->paginate(5);

        return view('admin.childcategory.index', compact('childcats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $subcategories = SubCategory::where('status', 1)->get();

        return view('admin.childcategory.create', compact('categories', 'subcategories'));
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
            'name' => 'required|unique:child_categories',
            'subcategory_id' => 'required',
            'slug' => 'required|unique:child_categories',
            'image' => 'required|mimes:jpg,png|max:1000'
        ]);

        $input = $request->all();

        $data = new ChildCategory();

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/childcategory', $imageName);
            $input['image'] = $imageName;
        }

        $input['slug'] = Str::slug($request->slug);

        $data->fill($input)->save();

        return back()->with('success', 'ChildCategory added successfully.');
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
        $subcategories = SubCategory::where('status', 1)->get();
        $childcategory = ChildCategory::findOrFail($id);

        return view('admin.childcategory.edit', compact('childcategory', 'categories', 'subcategories'));
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
            'name' => 'required|unique:child_categories,name,'.$id,
            'subcategory_id' => 'required',
            'slug' => 'required|unique:child_categories,slug,'.$id,
            'image' => 'mimes:jpg,png|max:1000'
        ]);

        $input = $request->all();

        $data = ChildCategory::findOrFail($id);

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/childcategory', $imageName);

            if($data->image){
                if(file_exists('assets/admin/image/childcategory/'.$data->image)){
                    @unlink('assets/admin/image/childcategory/'.$data->image);
                }
            }

            $input['image'] = $imageName;
        }

        $input['slug'] = str::slug($request->slug);

        $data->fill($input)->update();

        return back()->with('success', 'Child Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $childcategory = ChildCategory::findOrFail($id);

        if($childcategory->image){

            if(file_exists('assets/admin/image/childcategory/'.$childcategory->image)){
                @unlink('assets/admin/image/childcategory/'.$childcategory->image);
            }
        }

        if($childcategory->products()->count() > 0)
        {
            return back()->with('message', 'Delete Product First.');
        }

        $childcategory->delete();

        return back()->with('success', 'Child category delete successfully.');
    }


    public function delete($id)
    {
        $childcategory = ChildCategory::findOrFail($id);

        if($childcategory->image){

            if(file_exists('assets/admin/image/childcategory/'.$childcategory->image)){
                @unlink('assets/admin/image/childcategory/'.$childcategory->image);
            }
        }

        if($childcategory->products()->count() > 0)
        {
            return back()->with('message', 'Delete Product First.');
        }

        $childcategory->delete();

        return back()->with('success', 'Child category delete successfully.');
    }

    public function status($id1, $id2)
    {
        $childcategory = ChildCategory::findOrFail($id1);

        $childcategory->status = $id2;
        $childcategory->update();

        return back()->with('success', 'Status update successfully.');
    }

    public function load($id)
    {
        $subcategory = SubCategory::where('status', 1)->findOrFail($id);

        return view('admin.load.childcategory', compact('subcategory'));
    }
}
