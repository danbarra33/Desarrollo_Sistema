@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifique su dirección de correo electrónico</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                        Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    Si no recibiste el correo
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Click aquí para reenviar</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
