@extends('layouts.admin')
  @section('content')
  <div class="container">
    <div class="container d-flex justify-content-left">
        <a href="{{url('register_product')}}"><button class="btn btn-primary d-flex justify-content-center" type="submit">Nuevo</button></a>
    </div>
    <div class="row">
      <div class="col-12 mt-4">
          <div class="card">
              <div class="card-body">
                  <h4 class="header-title">Listado de Platos</h4>
                  <div class="single-table">
                      <div class="table-responsive">
                          <table id="DataTable" class="table text-center">
                              <thead class="text-uppercase bg-dark">
                                  <tr class="text-white">
                                      <th>Nombre</th>
                                      <th>Descripcion</th>
                                      <th>Precio</th>
                                      <th>categoria</th>
                                      <th>Alergenos</th>
                                      <th>Visibilidad</th>
                                      <th>Opciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($products as $product)
                              <tr>
                                  <td>{{ $product->name }}</td>
                                  <td>{{ $product->description }}</td>
                                  <td>{{ $product->amount }}</td>
                                  <?php $category = \DB::table('categories')->where('id', '=', $product->category_id)->first();?>
                                  <td>{{ $category->name }}</td>
                                  <?php $allergens = \DB::table('allergen_product')->where('product_id', '=', $product->id)->get();?>
                                  <td>
                                  @foreach($allergens as $allergen)
                                  <?php $item = \DB::table('allergens')->where('id', '=', $allergen->allergen_id)->first();?>
                                  {{ $item->name }} 
                                  @endforeach
                                  </td>
                                  @if( $product->view == 'true')
                                    <td>SI</td>
                                  @endif
                                  @if( $product->view == 'false')
                                    <td>NO</td>  
                                  @endIf
                                  <td class="text-center">
                                      <a href="{{ url('product_delete', encrypt($product->id)) }}"><i class="menu-icon fa fa-trash" title="Eliminar"></i></a>
                                      <a href="{{ url('product_status', encrypt($product->id)) }}"><i class="menu-icon fa fa-box" title="Estatus"></i></a>
                                  </td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>

  @endsection
