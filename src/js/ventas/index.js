import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form');
const btnBuscar = document.getElementById('btnBuscar');

const buscar = async () => {
    const primera_fecha = document.getElementById('primera_fecha').value;
    const segunda_fecha = document.getElementById('segunda_fecha').value;

    if (!primera_fecha || !segunda_fecha) {
        // Validación simple para asegurarte de que ambas fechas estén seleccionadas.
        Toast.fire({
            title: 'Por favor, seleccione ambas fechas.',
            icon: 'warning', // Cambié el ícono a una advertencia
            timer: 3000, // Cambié el tiempo de visualización del mensaje a 3 segundos
            timerProgressBar: true // Agregué una barra de progreso al timer
        });
        return;
    }

    if (primera_fecha > segunda_fecha) {
        Toast.fire({
            title: 'La fecha de inicio no puede ser mayor que la fecha de fin.',
            icon: 'error' // Cambié el ícono a un error
        });
        return;
    }

    const url = `/prueba_pdf2/API/ventas/buscar?primera_fecha=${primera_fecha}&segunda_fecha=${segunda_fecha}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data);

        if (data.length === 0) {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info' // Cambié el ícono a una información
            });
        } else {
            generarPDF(data);
        }
    } catch (error) {
        console.log(error);
    }
};

const generarPDF = async (datos) => {
    const url = `/prueba_pdf2/reporte/generarPDF`;

    const config = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos),
    };

    try {
        const respuesta = await fetch(url, config);

        if (respuesta.ok) {
            const blob = await respuesta.blob();

            if (blob) {
                const urlBlob = window.URL.createObjectURL(blob);

                // Abre el PDF en una nueva ventana o pestaña
                window.open(urlBlob, '_blank');
            } else {
                console.error('No se pudo obtener el blob del PDF.');
            }
        } else {
            console.error('Error al generar el PDF.');
        }
    } catch (error) {
        console.error(error);
    }
};

btnBuscar.addEventListener('click', buscar);
