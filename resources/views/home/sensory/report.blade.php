@extends('adminlte::page')

@section('title', 'SYNHO | Sensor Reporte')

@section('content_header')
@stop

@section('content')<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sensores</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Sensores</a></li>
                        <li class="breadcrumb-item active">Reportes</li>
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
                    <h3 class="card-title">Lista de Reportes</h3>

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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form id="report-viatic" action="#" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="begin">Fecha Inicio</label>
                                        <input id="begin" type="date" name="begin" class="form-control"
                                            value="{{ old('begin') }}" placeholder="Fecha...">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="finish">Fecha Final</label>
                                        <input id="finish" type="date" name="finish" class="form-control"
                                            value="{{ old('finish') }}" placeholder="Fecha...">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="search_data">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        <button type="submit" class="btn btn-secondary oculto" id="mail_data">
                                            <i class="fas fa-mail-bulk"></i> Email
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                            <th>SENSOR1</th>
                                            <th>SENSOR2</th>
                                            <th>SENSOR3</th>
                                            <th>SENSOR4</th>
                                            <th>SENSOR5</th>
                                        </tr>
                                    </thead>
                                    <tbody id="#lista_datos">
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="container-multiline"></div>
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
    <style>
        .oculto {
            display: none;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/sensory/report.js') }}"></script>
@stop
