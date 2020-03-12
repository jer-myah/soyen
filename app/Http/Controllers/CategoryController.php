<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    // function to add category
    public function addCategory(Request $request)
    {
        if($request->isMethod('post')) {
            //$data = $request->all();
            $category_name = $request->category_name;
            $category_details = Category::where('name', $category_name)->first();
            if($category_details) {
                // if $category_details equals $category_name, there exist such category already.
                return redirect('/admin/add-category')->with('flash_message_error', 'Category Name Exists Already!');
            } else {
                $category = new Category;
                $category->name = Str::ucfirst($request->category_name);
                $category->parent_id = $request->parent_id;
                $category->description = Str::ucfirst($request->description);
                $category->url = Str::ucfirst($request->url);

                $category->save();

                return redirect('/admin/add-category')->with('flash_message_success', 'Category Was Added Successfully!!!');
            }
            
        }
        $options = Category::where(['parent_id' => 0])->get();
        return view('admin.categories.add_category')->with('options', $options);
    }

    public function check_category(Request $request){
        //$data = $request->all();
        $category_data = $request->all();
        $category_name = $category_data['cat_name'];
        $category_details = Category::where('name', $category_name)->first();
        if(!($category_details)){
            return "false";         
            } else if ($category_name == $category_details->name) {
            return "true";
            }
            
        
        // if($category_name == $category_details->name) {
        //     return "true";
        // } else {
        //     return "false";
        // }        
    }

    public function viewCategories()
    {
        $categories = Category::get();

        //$categories = DB::categories()->get();
        return view('admin.categories.view_categories')->with('categories', $categories);
    }

    public function editCategory(Request $request, $id = null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id' => $id])->update(['name' => $data['category_name'], 'parent_id' => $data['parent_id'], 'description' => $data['description'], 'url' => $data['url']]);
            return redirect('/admin/view-categories')->with('flash_message_success', 'Successfully updated category!');
        }
        $category_details = Category::where(['id' => $id])->first();
        $options = Category::where(['parent_id' => 0])->get();
        return view('admin.categories.edit_category')->with(compact('category_details', 'options'));
    }

    public function deleteCategory($id = null)
    {
        if(!empty($id)){
            Category::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Delete operation was successful!');
        }
        
    }
}
