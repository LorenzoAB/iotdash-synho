@extends('adminlte::page')

@section('title', 'SYNHO | Lista Tanque de agua')

@section('content_header')
@stop

@section('content')<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tanque de agua</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Tanque de agua</a></li>
                        <li class="breadcrumb-item active">Lista</li>
                    </ol>
                </div>

            </div>

        </div>
    </div>

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Tanque de agua</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!--CONTENIDO-->
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <h3>
                                <a href="{{ url('home/waterpump/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Agregrar variables</a>
                            </h3>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table id="lista"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nª</th>
                                            <th>FECHA</th>
                                            <th>INPUT</th>
                                            <th>OUTPUT</th>
                                            <th>CONSTANTE</th>
                                            <th>NIVEL</th>
                                            <th>VALOR</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista_datos">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!--FIN DE CONTENIDO-->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Leyenda
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
        <!-- /.card -->
    </section>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/waterpump/list.js') }}"></script>
@stop
