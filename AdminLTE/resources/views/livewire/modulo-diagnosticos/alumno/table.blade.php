<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-4">
                        <span>Mostrar</span>
                        <select wire:model="cant" class="form-select" aria-label="Default select example">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <span>Entradas</span>
                    </div>

        <div class="col-4">
            <button wire:click="create()" class="btn btn-primary">
                Agregar Alumno
                <i class="fas fa-plus"></i></button>
        </div>

                    <div class="col-4">
                        <input class="form-control me-2" type="search" placeholder="Buscar" type="text"
                            aria-label="Search" wire:model="search">
                    </div>
                </div>
                @if ($alumnos->count())

                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr class="table-primary">
                                <th wire:click="order('id')" class="col-1">
                                    No
                                    {{-- Sort --}}
                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif

                                    @else
                                        <i class="fas fa-sort float-right mt-1"></i>
                                    @endif

                                </th>
                                <th wire:click="order('nombre')" class="col-3">
                                    Nombre
                                    {{-- Sort --}}
                                    @if ($sort == 'nombre')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif

                                    @else
                                        <i class="fas fa-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th wire:click="order('apellido')" class="col-3">
                                    Descripción
                                    {{-- Sort --}}
                                    @if ($sort == 'apellido')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif

                                    @else
                                        <i class="fas fa-sort float-right mt-1"></i>
                                    @endif
                                </th>

                                <th class="col-1">Ver</th>
                                <th class="col-1">Editar</th>
                                <th class="col-1">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnos as $alumno)

                                <tr>
                                    <td>{{ $alumno->id }}</td>
                                    <td>{{ $alumno->nombre }}</td>
                                    <td>{{ $alumno->apellido }}</td>
                                    <td>
                                        <button wire:click="show({{ $alumno->id }})" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button wire:click="edit({{ $alumno->id }})"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
            
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="$emit('deleteAlumno', {{ $alumno->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="card-body">
                        <strong>No existe ningún registro</strong>
                    </div>
                @endif
                <br>
                <nav aria-label="Page navigation example" class="float-right">
                    <ul class="pagination">
                        <li class="page-item">
                            {{ $alumnos->links() }}
                        </li>
                    </ul>
                </nav>
                <div class="mt-3">
                    <p> Mostrando {{ $alumnos->firstItem() }} a {{ $alumnos->lastItem() }} de {{ $alumnos->total() }} Entradas</p>
                </div>
            </div>
        </div>

    </div>

</div>

