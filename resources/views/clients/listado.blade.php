@extends('layouts.app_menu')

@section('content')

          <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Clientes</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th>ID Cliente</th>
                        <th>Nombre Completo</th>
                        <th>Folio INE</th>
                        <th>Domocilio</th>
                        <th>Telefono</th>
                        <th>Status</th>
                        <th>Salario Mensual</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Galarza</td>
                          <td>1234</td>
                          <td>Culiacan</td>
                          <td>6671</td>
                          <td>Morozo</td>
                          <td>$0.00</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Barraza</td>
                          <td>4321</td>
                          <td>Navolato</td>
                          <td>6671</td>
                          <td>Buro de Credito</td>
                          <td>$-100,000.00</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection