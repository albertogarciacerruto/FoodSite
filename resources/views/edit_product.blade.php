@extends('layouts.admin')
  @section('content')
  <div class="container">
    <div class="row">
    <form class="container" action="{{ url('products_edit') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

      <div class="form-group">
          <input id="id" type="hidden" name="id" value="{{ $product->id }}" readonly="readonly">
      </div>
      <div class="row">
        <div class="form-group col-lg-12">
            <label class="col-form-label">Nombre</label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $product->name }}" required>
            @if ($errors->has('name'))
                <div class="text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-12">
            <label class="col-form-label">Descripción</label>
            <textarea name="description" id="description" rows="4" placeholder="" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $product->description }}</textarea>
            @if ($errors->has('description'))
                <div class="text-danger">
                    <strong>{{ $errors->first('description') }}</strong>
                </div>
            @endif
        </div>
      </div>

      <div class="row">
          <div class="form-group col-lg-6">
              <label class="col-form-label">Precio</label>
              <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ $product->amount }}" patter="[0-9]+(\.[0-9][0-9]?)?" required>
              @if ($errors->has('amount'))
                  <div class="text-danger">
                      <strong>{{ $errors->first('amount') }}</strong>
                  </div>
              @endif
          </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6">
            <label class="col-form-label">Imagen</label>
            <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" accept="image/*">
            @if ($errors->has('image'))
                <div class="text-danger">
                    <strong>{{ $errors->first('image') }}</strong>
                </div>
            @endif
        </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6">
            <label class="col-form-label">Video</label>
            <input id="video" type="file" class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}" name="video" accept="video/*">
            @if ($errors->has('video'))
                <div class="text-danger">
                    <strong>{{ $errors->first('video') }}</strong>
                </div>
            @endif
        </div>
      </div>

      <div class="container d-flex justify-content-center">
        <button class="btn btn-primary d-flex justify-content-center" type="submit">Modificar</button>
        </form>
      </div>

    </div>
  </div>

  @endsection
