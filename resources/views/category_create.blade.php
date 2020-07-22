@extends('layouts.admin')
  @section('content')
  <div class="container">
    <div class="row">
    <form class="container" action="{{ url('register_category') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

      <div class="row">
        <div class="form-group col-lg-12">
            <label class="col-form-label">Nombre</label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name">
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
            <textarea name="description" id="description" rows="4" placeholder="" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <div class="text-danger">
                    <strong>{{ $errors->first('description') }}</strong>
                </div>
            @endif
        </div>
      </div>

      <div class="container d-flex justify-content-center">
        <button class="btn btn-primary d-flex justify-content-center" type="submit">Agregar</button>
        </form>
      </div>

    </div>
  </div>

  @endsection
