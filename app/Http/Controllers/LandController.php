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
    //Metodo que muestra todas las categorias registradas
    public function categories()
    {
        $categories = \DB::table('categories')->get();
        return view('list_category', compact('categories'));
    }
    //Metodo que redirige al formulario de registro de categoria
    public function category()
    {
        return view('category_create');
    }
    //Metodo que porcesa el registro de la categoria
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
    //metodo que permite eliminar una categoria
    public function destroy_category($id_category)
    {
        $category = \DB::table('categories')->where('id', '=', decrypt($id_category))->delete();
        return redirect('categories');
    }

    /*
        Para Los Alergenos, se consultan, se crean, y se eliminan de la base de datos
    */
    //Metodo que permite mostrar todo los Alergenos registrados
    public function allergens()
    {
        $allergens = \DB::table('allergens')->get();
        return view('list_allergen', compact('allergens'));
    }
    //Metodo que redirige al formulario de registro del Alergeno
    public function allergen()
    {
        return view('allergen_create');
    }
    //Metodo encargado del registro de los Alergenos
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
    //Metodo que permite eliminar un alergeno especifico
    public function destroy_allergen($id_allergen)
    {
        $allergen = \DB::table('allergens')->where('id', '=', decrypt($id_allergen))->delete();
        return redirect('allergens');
    }

    /*
        Para los platos, se consultan, se crean, y se eliminan de la base de datos
    */
    //Meotod que muestra todos los platos (productos) del sistema
    public function products()
    {
        $products = \DB::table('products')->get();
        return view('list_product', compact('products'));
    }
    //Metodo que redirige al formulario de registro del producto 
    public function product()
    {
        $list_allergens = Allergen::get();
        $list_categories = Category::get();
        return view('product_create', compact('list_allergens', 'list_categories'));
    }
    
    //Metodo que procesa el registro del producto
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
    //Metodo que permite eliminar fisicamente un producto de la base de datos
    public function destroy_product($id_product)
    {
        $product = \DB::table('products')->where('id', '=', decrypt($id_product))->delete();
        return redirect('products');
    }
    //Metodo que cambia el estato de visibilidad de un plato o producto
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

    //
    public function edit($id_product)
    {
        $product = \DB::table('products')->where('id', '=', decrypt($id_product))->first();
        $list_allergens = Allergen::select('id','name')->get();
        $list_categories = Category::select('id','name')->get();
        return view('edit_product', compact('product', 'list_allergens', 'list_categories'));
    }
    public function update(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $amount = $request->amount;
        $id = $request->id;

        $update_name = \DB::table('products')->where('id', $id)->update(['name' => $name, 'description' => $description, 'amount' => $amount]);
        if ($request->hasFile('image'))
        {
            $photo = $request->file('image')->store('public');
            $image = \DB::table('products')->where('id','=', $id)->update(['image' => $photo]);
        }
        if ($request->hasFile('video'))
        {
            $video = $request->file('video')->store('public');
            $image = \DB::table('products')->where('id','=', $id)->update(['video' => $video]);
        } 

        return redirect('products');
    }

}

