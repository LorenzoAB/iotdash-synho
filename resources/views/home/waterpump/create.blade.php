@extends('adminlte::page')

@section('title', 'SYNHO | Crear Tanque de agua')

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
                        <li class="breadcrumb-item active">Tanque de agua</li>
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
                            <form id="registro_sensor" action="{{ url('admin/waterpump') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="input">Entrada</label>
                                        <input type="number" id="input" name="input" class="form-control"
                                            value="0" min="1" max="100" placeholder="Entrada ...">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="output">Salida</label>
                                        <input type="number" id="output" name="output" class="form-control"
                                            value="0" min="1" max="100" placeholder="Salida ...">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="constant">Constante</label>
                                        <input type="number" id="constant" name="constant" class="form-control"
                                            value="1" min="1" max="100" placeholder="Constante...">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="tank">
                                            <div class="water-level"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="value">Valor Actual</label>
                                        <input type="text" id="value" name="value" class="form-control"
                                            value="" disabled placeholder="Valor Actual ...">
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
    <script>
        $("#input").keyup(function(e) {
            e.preventDefault();
            var input = $('#input').val();
            var output = $('#output').val();
            var constant = $('#constant').val();
            var level = 0;
            //formula
            level = level + (input - output) * constant
            startPumping(level, input, output, constant);
        });

        $("#output").keyup(function(e) {
            e.preventDefault();
            var input = $('#input').val();
            var output = $('#output').val();
            var constant = $('#constant').val();
            var level = 0;
            //formula
            level = level + (input - output) * constant
            startPumping(level, input, output, constant);
        });

        $("#constant").keyup(function(e) {
            e.preventDefault();
            var input = $('#input').val();
            var output = $('#output').val();
            var constant = $('#constant').val();
            var level = 0;
            //formula
            level = level + (input - output) * constant
            startPumping(level, input, output, constant);
        });

        var pumpingInterval;
        var currentHeight = 0;
        var lastRecordTime = null;

        function startPumping(increment, input, output, constant) {

            var waterLevel = document.querySelector(".water-level");
            var percentageField = document.getElementById("value");

            clearInterval(pumpingInterval);

            pumpingInterval = setInterval(function() {
                if (increment > 0) {
                    if (currentHeight >= 300) {
                        clearInterval(pumpingInterval);
                        return;
                    } else {
                        currentHeight += increment;
                        if (currentHeight > 300) {
                            currentHeight = 300;
                        }
                        waterLevel.style.height = currentHeight + "px";

                        if (currentHeight >= 240 && currentHeight < 300) {
                            console.log("¡El nivel del agua está cerca del 80%!");
                        }
                    }
                } else if (increment < 0) {
                    if (currentHeight <= 0) {
                        clearInterval(pumpingInterval);
                        return;
                    } else {
                        currentHeight += increment;
                        if (currentHeight < 0) {
                            currentHeight = 0;
                        }
                        waterLevel.style.height = currentHeight + "px";

                        if (currentHeight <= 60 && currentHeight > 0) {
                            console.log("¡El nivel del agua está cerca del 20%!");
                        }
                    }
                }

                var percentage = (currentHeight / 300) * 100;
                percentageField.value = percentage.toFixed(2) + "%";

                // Simulación de registro cada 3 segundos
                var currentTime = new Date().getTime();

                if (lastRecordTime === null || currentTime - lastRecordTime >= 2000) {

                    register_waterpum(input, output, constant, increment, percentage.toFixed(2))
                    //var registro = "Registro: " + new Date().toLocaleTimeString() + " - Porcentaje: " + percentage.toFixed(2) + "%";
                    //console.log(registro);

                    lastRecordTime = currentTime;
                }

            }, 1000);

        }

        function stopPumping() {
            clearInterval(pumpingInterval);
        }


        function register_waterpum(input, output, constant, level, value) {
            $.ajax({
                url: "{{ route('store_waterpump') }}",
                method: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data: {
                    input: input,
                    output: output,
                    constant: constant,
                    level: level,
                    value: value
                },
                success: function(data) {
                    if (data.errors) {
                        console.log(data.errors);
                    } else if (data.code == 500) {
                        console.log(data.message);
                    } else {
                        console.log(data.message);
                    }
                },
                error: function(data) {
                    console.log('Algo ha salido mal');
                }
            }); //FIN DE AJAX 

        }
    </script>
@stop
