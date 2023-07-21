@extends('adminlte::page')

@section('title', 'SYNHO | Crear Sensor')

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
                        <li class="breadcrumb-item active">Sensores</li>
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
                    <h3 class="card-title">Agregrar variables</h3>

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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!--validar error-->
                            <form id="registro_sensor" action="{{ url('home/sensory') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sensory1">Sensor 1</label>
                                        <input type="number" name="sensory1" class="form-control"
                                            value="{{ old('sensory1') }}" min="1" max="100" placeholder="Sensor 1...">
                                            @error('sensory1')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="sensory2">Sensor 2</label>
                                        <input type="number" name="sensory2" class="form-control"
                                            value="{{ old('sensory2') }}" min="1" max="100" placeholder="Sensor 2...">
                                            @error('sensory2')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sensory3">Sensor 3</label>
                                        <input type="number" name="sensory3" class="form-control"
                                            value="{{ old('sensory3') }}" min="1" max="100" placeholder="Sensor 3...">
                                            @error('sensory3')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="sensory4">Sensor 4</label>
                                        <input type="number" name="sensory4" class="form-control"
                                            value="{{ old('sensory4') }}" min="1" max="100" placeholder="Sensor 4...">
                                            @error('sensory4')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sensory5">Sensor 5</label>
                                        <input type="number" name="sensory5" class="form-control"
                                            value="{{ old('sensory5') }}" min="1" max="100" placeholder="Sensor 5...">
                                            @error('sensory5')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="save_data"><i
                                            class="fas fa-save"></i> Guardar</button>
                                    <a href="{{ url('home/sensory') }}" class="btn btn-danger" id="btncancel"><i
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

@stop

@section('js')

@stop
