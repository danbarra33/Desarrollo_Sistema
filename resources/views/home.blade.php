@extends('layouts.app_menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">Tablero</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col" align="center">
                    <img src="https://i.pinimg.com/564x/08/13/2f/08132f3ff8f760b99341593d958c3e21.jpg"
                    width="500" height="500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
