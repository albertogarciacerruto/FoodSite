<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Allergen;
use App\Product;

class LandController extends Controller
{
    /*
        Para las categories, se consultan, se crean, y se eliminan de la base de datos
    */

    public function categories()
    {
        $categories = \DB::table('categories')->get();
        return view('list_category', compact('categories'));
    }

    public function category()
    {
        return view('category_create');
    }

    public function register_category(Request $request)
    {
        $name = $request->name;
        $description = $request->description;

        $category = Category::orderBy('id', 'desc')->first();

        if (is_null($category)) {
            $nuevo = Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        elseif($name === $category->name && $description === $category->description){
        return $this->categories();
        }
        else {
            $nuevo = Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }

        return redirect('categories');
    }

    public function destroy_category($id_category)
    {
        $category = \DB::table('categories')->where('id', '=', decrypt($id_category))->delete();
        return redirect('categories');
    }

    /*
        Para Los Alergenos, se consultan, se crean, y se eliminan de la base de datos
    */

    public function allergens()
    {
        $allergens = \DB::table('allergens')->get();
        return view('list_allergen', compact('allergens'));
    }

    public function allergen()
    {
        return view('allergen_create');
    }

    public function register_allergen(Request $request)
    {
        $name = $request->name;
        $description = $request->description;

        $allergen = Allergen::orderBy('id', 'desc')->first();

        if (is_null($allergen)) {
            $nuevo = Allergen::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        elseif($name === $allergen->name && $description === $allergen->description){
        return $this->allergens();
        }
        else {
            $nuevo = Allergen::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }

        return redirect('allergens');
    }

    public function destroy_allergen($id_allergen)
    {
        $allergen = \DB::table('allergens')->where('id', '=', decrypt($id_allergen))->delete();
        return redirect('allergens');
    }

    /*
        Para los platos, se consultan, se crean, y se eliminan de la base de datos
    */

    public function products()
    {
        $products = \DB::table('products')->get();
        return view('list_product', compact('products'));
    }

    public function product()
    {
        $list_allergens = Allergen::get();
        $list_categories = Category::get();
        return view('product_create', compact('list_allergens', 'list_categories'));
    }
    

    public function register_product(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $amount = $request->amount;
        $category_id = $request->category_id;
        $allergen = $request->allergen;
        $product = Product::orderBy('id', 'desc')->first();

        if (is_null($product)) {
            $nuevo = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'category_id' => (int)$request->category_id,
            ]);

            foreach ( $allergen as $item ) {     
                $new = \DB::table('allergen_product')->insert(
                    ['product_id' => $nuevo->id, 'allergen_id' => $item]
                );
            }

            if ($request->hasFile('image'))
            {
                $photo = $request->file('image')->store('public');
                $image = \DB::table('products')->where('id','=', $nuevo->id)->update(['image' => $photo]);
            }  
            if ($request->hasFile('video'))
            {
                $video = $request->file('video')->store('public');
                $image = \DB::table('products')->where('id','=', $nuevo->id)->update(['video' => $video]);
            }    
        }
        elseif($name === $product->name && $description === $product->description){
        return $this->products();
        }
        else {
            $nuevo = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'category_id' => (int)$request->category_id,
            ]);

            foreach ( $allergen as $item ) {     
                $new = \DB::table('allergen_product')->insert(
                    ['product_id' => $nuevo->id, 'allergen_id' => $item]
                );
            }

            if ($request->hasFile('image'))
            {
                $photo = $request->file('image')->store('public');
                $image = \DB::table('products')->where('id','=', $nuevo->id)->update(['image' => $photo]);
            }  
            if ($request->hasFile('video'))
            {
                $video = $request->file('video')->store('public');
                $image = \DB::table('products')->where('id','=', $nuevo->id)->update(['video' => $video]);
            } 
        }

        return redirect('products');
    }

    public function destroy_product($id_product)
    {
        $product = \DB::table('products')->where('id', '=', decrypt($id_product))->delete();
        return redirect('products');
    }

    public function status_product($id_product)
    {
        $current = \DB::table('products')->where('id', '=', decrypt($id_product))->first();
        $status = $current->view;
        if($status == 'true'){
            $status = 'false';
        }else{
            $status = 'true';
        }
        $product = \DB::table('products')->where('id', '=', decrypt($id_product))->update(['view' => $status]);
        return redirect('products');
    }
}

