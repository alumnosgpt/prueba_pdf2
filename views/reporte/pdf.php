<style>
    /* Estilo para centrar la tabla y cambiar colores de fondo */
    table {
        border-collapse: collapse;
        width: 80%; /* Ancho de la tabla */
        margin: 0 auto; /* Centrar la tabla horizontalmente */
        background-color: #f0f0f0; /* Color de fondo gris */
    }

    th, td {
        border: 1px solid #000; /* Borde de las celdas */
        padding: 8px; /* Espaciado interno */
        text-align: left;
    }

    th {
        background-color: #3498db; /* Color de fondo azul para las celdas de encabezado */
        color: #fff; /* Color de texto en el encabezado */
    }

    tr:nth-child(even) {
        background-color: #bdc3c7; /* Color de fondo gris claro para filas pares */
    }

    tr:nth-child(odd) {
        background-color: #ecf0f1; /* Color de fondo gris claro para filas impares */
    }

    /* Estilo para el div contenedor */
    .contenedor {
        width: 80%; /* Ancho igual al de la tabla */
        margin: 0 auto; /* Centrar el div horizontalmente */
        border: 1px solid #000; /* Borde alrededor del div */
        padding: 10px; /* Espaciado interno del div */
    }

    /* Estilo para el div del título */
    .titulo {
        text-align: center; /* Centrar el texto horizontalmente */
        background-color: #3498db; /* Color de fondo azul para el título */
        color: #fff; /* Color de texto en el título */
        padding: 10px; /* Espaciado interno del título */
    }
</style>

<div class="contenedor">
    <div class="titulo">
        <h1>Ventas efectuadas</h1>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $ventas) : ?>
                <tr>
                    <td><?= $ventas->fecha ?></td>
                    <td><?= $ventas->cantidad ?></td>
                    <td><?= $ventas->producto ?></td>
                    <td><?= $ventas->cliente ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
