function setWaterLevel() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "list_ajax_waterpump_graphic",
        method: "GET",
        dataType: "json",
        success: function (data) {
            if (data.errors) {
                console.log(data.errors);
            } else if (data.code == 500) {
                console.log(data.message);
            } else {
                $('#input').val(data.data.input);
                $('#output').val(data.data.output);
                $('#constant').val(data.data.constant);
                var increment = parseInt(data.data.level);
                startPumping(increment);
            }
        },
        error: function (data) {
            console.log('Algo ha salido mal');
        }
    });
}

var pumpingInterval;
var currentHeight = 0;

function startPumping(increment) {
    var waterLevel = document.querySelector(".water-level");
    var percentageField = document.getElementById("value");

    clearInterval(pumpingInterval);

    pumpingInterval = setInterval(function () {
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
    }, 1000);
}

function stopPumping() {
    clearInterval(pumpingInterval);
}

setInterval(setWaterLevel, 1000);