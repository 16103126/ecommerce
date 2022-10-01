<?php

namespace App\Http\Controllers\Admin;

use Faker\Guesser\Name;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
            'image' => 'required|mimes:jpg,png|max:1000'
        ]);

        $input = $request->all();

        $data = new Category();

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/category', $imageName);
            $input['image'] = $imageName;
        }

        $input['slug'] = str::slug($request->slug);

        $data->fill($input)->save();

        return back()->with('success', 'Category added successfully.');
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
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
            'name' => 'required|unique:categories,name,'.$id,
            'slug' => 'required|unique:categories,slug,'.$id,
            'image' => 'mimes:jpg,png|max:1000'
        ]);

        $input = $request->all();

        $data = Category::findOrFail($id);

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/category', $imageName);

            if($data->image){
                if(file_exists('assets/admin/image/category/'.$data->image)){
                    @unlink('assets/admin/image/category/'.$data->image);
                }
            }

            $input['image'] = $imageName;
        }

        $input['slug'] = str::slug($request->slug);

        $data->fill($input)->update();

        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->subcategories()->count() > 0)
        {
            return back()->with('message', 'Delete SubCategory First.');
        }

        if($category->products()->count() > 0)
        {
            return back()->with('message', 'Delete Product First.');
        }

        $category->delete();

        if($category->image){

            if(file_exists('assets/admin/image/category/'.$category->image)){
                @unlink('assets/admin/image/category/'.$category->image);
            }
        }

        return back()->with('success', 'Category delete successfully.');

    }

    public function delete($id)
    {

        $category = Category::findOrFail($id);

        if($category->subcategories()->count() > 0)
        {
            return back()->with('message', 'Delete SubCategory First.');
        }

        if($category->products()->count() > 0)
        {
            return back()->with('message', 'Delete Product First.');
        }

        $category->delete();

        if($category->image){

            if(file_exists('assets/admin/image/category/'.$category->image)){
                @unlink('assets/admin/image/category/'.$category->image);
            }
        }

        return back()->with('success', 'Category delete successfully.');

    }

    public function status($id1, $id2)
    {
        $category = Category::findOrFail($id1);

        $category->status = $id2;
        $category->update();

        return back()->with('success', 'Status update successfully.');
    }
}
