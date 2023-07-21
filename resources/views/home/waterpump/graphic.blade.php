@extends('adminlte::page')

@section('title', 'SYNHO | Grafica Tanque de agua')

@section('content_header')
@stop

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tanque de agua</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Tanque de agua</a></li>
                        <li class="breadcrumb-item active">Grafica</li>
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
                    <h3 class="card-title">Bomba de agua</h3>

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
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!--validar error-->
                            <form id="registro_sensor" action="/save-sensory" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="input">INPUT</label>
                                        <input type="number" id="input" name="input" class="form-control"
                                            value="{{ old('sensory1') }}" disabled min="1" max="100"
                                            placeholder="Inicio ...">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="output">OUTPUT</label>
                                        <input type="number" id="output" name="output" class="form-control"
                                            value="{{ old('output') }}" disabled min="1" max="100"
                                            placeholder="Salida ...">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="constant">CONSTANTE</label>
                                        <input type="number" id="constant" name="constant" class="form-control"
                                            value="{{ old('constant') }}" disabled min="1" max="100"
                                            placeholder="Constante...">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="tank">
                                            <div class="water-level"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="value">VALOR ACTUAL</label>
                                        <input type="text" id="value" name="value" class="form-control"
                                            value="{{ old('value') }}" disabled
                                            placeholder="Nivel ...">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <a href="{{ url('home/waterpump') }}" class="btn btn-danger" id="btncancel"><i
                                            class="fas fa-backward"></i> Cancelar</a>
                                </div>
                            </form>
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
        .tank {
            position: relative;
            width: 200px;
            height: 300px;
            border: 2px solid #000;
            background-color: #000;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .water-level {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #3498db;
            transition: height 0.5s ease;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/waterpump/graphic.js') }}"></script>
@stop
