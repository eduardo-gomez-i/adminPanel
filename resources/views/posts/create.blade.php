@extends('layouts.main', ['activePage' => 'posts', 'titlePage' => 'Nueva Documento'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" action="{{ route('posts.store') }}" class="form-horizontal">
          @csrf
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-primary">
              <h4 class="card-title">Documento</h4>
              <p class="card-category">Ingresar datos del nuevo Documento</p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">
                <label for="title" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="title" placeholder="Ingrese el nombre del archivo" autocomplete="off" autofocus>
                </div>
              </div>
              <div class="row pt-2">
                <label for="title" class="col-sm-2 col-form-label">Archivo</label>
                <div class="col-sm-7">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-raised btn-round btn-default btn-file">
                        <input type="file" name="archivo" />
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row pt-2">
                <label for="title" class="col-sm-2 col-form-label">Apartados</label>
                <div class="col-sm-7">
                  <div class="col-sm-10 checkbox-radios">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="productos" value="1"> Productos
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="posiciones" value="2"> Ubicaciones
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--End body-->

            <!--Footer-->
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <!--End footer-->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection