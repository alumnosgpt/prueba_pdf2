<h1 class="text-center">VENTAS EFECTUADAS</h1>

<div class="row justify-content-center mb-3"> 
    <form class="col-lg-6 border rounded bg-light p-2" id="formularioVenta"> 
        <div class="row mb-2"> 
            <div class="col">
                <label for="primera_fecha">Primera Fecha</label>
                <input type="date" name="primera_fecha" id="primera_fecha" class="form-control">
            </div>
        </div>
        <div class="row mb-2"> 
            <div class="col">
                <label for="segunda_fecha">Segunda Fecha</label>
                <input type="date" name="segunda_fecha" id="segunda_fecha" class="form-control">
            </div>
        </div>
        <div class="row mb-2"> 
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>
</div>

<div class="row justify-content-center">
    <script src="build/js/ventas/index.js"></script>
</div>
