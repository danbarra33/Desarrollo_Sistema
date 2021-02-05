@extends('layouts.app_menu')

@section('content')

<div class="row justify-content-center">

			
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
                      <h5 class="title">{{Auth::user()->name}}</h5>
                    </a>
                    <!--<p class="Status">Cliente Morozo</p>-->
                  </div>
                  <div class="row d-flex justify-content-center">
                    <a href="{{ route('logout') }}" type="button" class="btn btn-success"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      Cerrar sesión
                    </a>
                  </div>
                  <br />
                </div>
              </div>
            </div>
          </div>


          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
@endsection