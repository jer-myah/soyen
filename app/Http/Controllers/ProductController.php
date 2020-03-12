<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as ImageResize;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\ProductsAttribute;
use App\Category;
use App\Product;
use Session;
use Image;
use File;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        
        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $product = new Product;
            $product->category_id = $request['category_id'];
            $product->name = $request['product_name'];
            $product->code = $request['product_code'];
            $product->colour = $request['product_colour'];
            $product->description = $request['description'];
            $product->price = $request['price'];

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();            
            $img = ImageResize::make($image->path());

            // --------- [ Resize Image to small ] ---------------
            $small_image_path = public_path('/images/products/small');
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($small_image_path.'/'.$input['imagename']);

            // ----------- [ Resize Image to medium ] -----------
            $medium_image_path = public_path('/images/products/medium');
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($medium_image_path.'/'.$input['imagename']);

            // ----------- [ Uploads Image in Original Form ] ----------
            $large_image_path = public_path('/images/products/large');
            $image->move($large_image_path, $input['imagename']);

            // store into database table
            $product->image = $input['imagename'];

            $product->save();
            return redirect()->back()->with('flash_message_success', 'Product was added successfully!');
        }

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($categories as $category) {
            $categories_dropdown .= "<option value='".$category->id."'>".$category->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$category->id])->get();
            foreach($sub_categories as $sub_category) {
                $categories_dropdown .= "<option value='".$sub_category->id."'>&nbsp; --&nbsp;".$sub_category->name."</option>";
            }
        }

        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    
    public function viewProducts()
    {
        $products = Product::get();
        foreach($products as $key => $value) {
            $category_name = Category::where(['id' => $value->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with('products', $products);
    }

    public function editProduct(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time().'.'.$image->extension();            
                $img = ImageResize::make($image->path());

                // --------- [ Resize Image to small ] ---------------
                $small_image_path = public_path('/images/products/small');
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($small_image_path.'/'.$image_name);
                File::delete($small_image_path.'/'.$data['current_image']);

                // ----------- [ Resize Image to medium ] -----------
                $medium_image_path = public_path('/images/products/medium');
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($medium_image_path.'/'.$image_name);
                File::delete($medium_image_path.'/'.$data['current_image']);

                // ----------- [ Uploads Image in Original Form ] ----------
                $large_image_path = public_path('/images/products/large');
                $image->move($large_image_path, $image_name); 
                File::delete($large_image_path.'/'.$data['current_image']);               

            } else {
                $image_name = $data['current_image'];
            }

            Product::where(['id' => $id])->update([
                'category_id' => $data['category_id'],
                'name' => $data['product_name'],
                'code' => $data['product_code'],
                'colour' => $data['product_colour'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image' => $image_name
            ]);

            return redirect()->back()->with('flash_message_success', 'Product was successfully updated');
        }


        $product_details = Product::where(['id'=> $id])->first();

        // category dropdown
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $category) {
            if($category->id == $product_details->category_id) {
                $selected = "selected";
            } else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$category->id."' ".$selected.">".$category->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$category->id])->get();
            foreach($sub_categories as $sub_category) {
                if($sub_category->id == $product_details->category_id) {
                    $selected = "selected";
                } else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_category->id."' ".$selected.">&nbsp; --&nbsp;".$sub_category->name."</option>";
            }
        }  // end category dropdown

        return view('admin.products.edit_product')->with(compact('product_details', 'categories_dropdown'));
        
    }

    public function deleteProduct($id = null)
    {
        $image_name = Product::where('id', $id)->value('image');
        Product::where('id', $id)->delete();

        $small_image_path = public_path('/images/products/small');
        File::delete($small_image_path.'/'.$image_name);

        $medium_image_path = public_path('/images/products/medium');
        File::delete($medium_image_path.'/'.$image_name);

        $large_image_path = public_path('/images/products/large');
        File::delete($large_image_path.'/'.$image_name);

        return redirect()->back()->with('flash_message_success', 'Deleted operation completed successfully.');
    }


    public function addAttributes(Request $request, $id = null)
    {
        $product_details = Product::with('attributes')->where('id', $id)->first();
        
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                    //echo "<pre>"; print_r($attribute); die;
                }
            }
            return redirect('/admin/add-attributes/'.$product_details->id)->with('flash_message_success', 'Product attribute has been added successfully!');
        }

        return view('admin.products.add_attributes')->with('product_details', $product_details);
    }

    public function deleteAttribute($id = null)
    {
        ProductsAttribute::where('id', $id)->delete();

        return redirect()->back()->with('flash_message_success', 'Deleted operation completed successfully.');
    }
}
