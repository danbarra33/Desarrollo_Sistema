@extends('layouts.app_menu')

@section('content')

<div class="row justify-content-center">
            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Editar Perfil</h5>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-md-8 pr-1">
                        <div class="form-group">
                          <label for="exampleInputEmail1"
                            >Correo Electronico</label
                          >
                          <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                          />
                        </div>
                      </div>
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Telefono</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Telefono"
                            value="667"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Nombre Completo</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Company"
                            value="Mike Contreras"
                            readonly
                          />
                        </div>
                      </div>
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Domicilio</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Home Address"
                            value="Barrancos"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Sucursal</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Sucursal"
                            value="Centro"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <button type="button" class="btn btn-success">
                        Guardar
                      </button>
                    </div>
                  </form>
                  <br />
                </div>
              </div>
            </div>
            <div class="col-md-3 justify-content-center">
              <div class="card card-user">
                <div class="image">
                  <img src="{{url('/img/bg6.jpg')}}" alt="Background" />
                </div>
                <div class="card-body">
                  <div class="author">
                    <a href="#">
                      <img
                        class="avatar border-gray"
                        src="{{url('/img/user.png')}}"
                        alt="Foto"
                      />
                      <h5 class="title">Miguel Contreras</h5>
                    </a>
                    <p class="Status">Cliente Morozo</p>
                  </div>
                  <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-success">
                      Cambiar Foto de Perfil
                    </button>
                  </div>
                  <br />
                </div>
              </div>
            </div>
          </div>
@endsection