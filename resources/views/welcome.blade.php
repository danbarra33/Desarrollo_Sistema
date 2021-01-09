<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crédito y vales del noroeste</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('css/app.css') }}" />
        <link rel="stylesheet" href="{{ url('css/welcome/carousel.css') }}" />
    </head>

    <body style="background-color:#ddd;">


  <div class="col" align="center">
          <img src="https://i.pinimg.com/564x/08/13/2f/08132f3ff8f760b99341593d958c3e21.jpg"
          width="500" height="500">
        </div>

  
    <div class="pull" align="center">
            @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-outline-success">Inicio</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg">Entrar</a>
                    @endif
            @endif 
    </div>
    </div>
</body>
</html>