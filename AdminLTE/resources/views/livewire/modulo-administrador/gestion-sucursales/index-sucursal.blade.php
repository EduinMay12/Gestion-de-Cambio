<div>
    <div class="container">
        <div class="card">
            <div class="card-body">

                @include("livewire.modulo-administrador.gestion-sucursales.$view")

            </div>
        </div>
    </div>

    <!-- Scripts ---->
    @livewireScripts

    <script>
        livewire.on('alert', function(message) {
            Swal.fire(
                'Good job!',
                message,
                'success'
            )
        });
    </script>

    <script src="sweetalert2.all.min.js"></script>

    <script>
        livewire.on('deleteSucursal', SucursalID => {
            Swal.fire({
                title: '¿Estas segur@?',
                text: "Esta accion no se podra revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emitTo('modulo-administrador.gestion-sucursales.index', 'destroy', SucursalID);
                    Swal.fire(
                        'Eliminado!',
                        'Curso eliminado con exito',
                        'success'
                    )
                }
            })
        })
    </script>

</div>
