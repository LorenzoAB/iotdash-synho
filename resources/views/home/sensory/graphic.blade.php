@extends('adminlte::page')

@section('title', 'SYNHO | Sensor Graficas')

@section('content_header')
@stop

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sensores</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Sensores</a></li>
                        <li class="breadcrumb-item active">Graficas</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Graficas</h3>
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
                    <!--<div class="row">
                        <div class="col-lg-12">
                            <div id="container-bar"></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="container-pie"></div>
                        </div>
                    </div>
                    <br>-->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="m-0 text-dark" style="text-align: center">LISTA DE SENSORES</h3>
                        </div>
                        <br><br><br><br>
                        <div class="col-lg-4">
                            <div id="container-guage-sensory1"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="container-guage-sensory2"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="container-guage-sensory3"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="container-guage-sensory4"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="container-guage-sensory"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="container-guage-sensory5"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="container-multiline"></div>
                        </div>
                    </div>
                    <br>
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
    <script src="{{ asset('js/sensory/graph.js') }}"></script>
@stop
