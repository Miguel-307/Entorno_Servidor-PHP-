$(document).ready(function() {
    $('#formulario').submit(function(event) {
        event.preventDefault();

        let numero = $('#numero').val();

        if (numero === '' || isNaN(numero)) {
            $('#resultado').text('Por favor, introduce un número válido.');
            return;
        }


        $.ajax({
            url: 'pagina.php',
            method: 'POST',
            data: { numero: numero },
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta.ok) {
                    $('#resultado').text('Resultado: ' + respuesta.resultado);
                } else {
                    $('#resultado').text('Error: ' + (respuesta.mensaje || 'Petición inválida'));
                }
            },
            error: function(xhr, status, error) {
                $('#resultado').text('Error de comunicación con el servidor.');
                console.error('AJAX error:', status, error);
            }
        });
    });
});
