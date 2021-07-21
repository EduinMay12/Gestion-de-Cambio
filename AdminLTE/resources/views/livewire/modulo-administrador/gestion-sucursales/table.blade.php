    <div class="col-4 mb-4">
        <label for="">Seleccionar Empresa *</label>
        <select wire:model="empresa_id" class="form-select form-control" required>
            <option value="">Seleccione</option>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}">{{ $empresa->empresa }}</option>
            @endforeach
        </select>
    </div>
    <center>
        @if ($empresa_id)
        <div class="col-4">
            <button wire:click="create({{ $empresa_id }})" class="btn btn-primary">Agregar Sucursal <i class="fas fa-plus"></i></button>
        </div>
        @endif
    </center>
    <div class="row mt-2">

        <div class="col-8">
            <span>Mostrar</span>
            <select wire:model="cant" class="form-select" aria-label="Default select example">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>Entradas</span>
        </div>

        <div class="col-4">
            <input class="form-control me-2" type="search" placeholder="Buscar" type="text" aria-label="Search" wire:model="search">
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive mb-4"><br>
                <table class="table table-bordered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                    @if ($sucursales->count())
                    <thead>
                        <tr class="table-primary">
                            <th>No.</th>
                            <th wire:click="order('sucursal')">
                                Nombre
                                {{-- Sort --}}
                                @if ($sort == 'sucursal')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif

                            </th>
                            <th wire:click="order('user_id')">
                                Resposable
                                {{-- Sort --}}
                                @if ($sort == 'user_id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th wire:click="order('empleados')">
                                No. Empleados
                                {{-- Sort --}}
                                @if ($sort == 'empleados')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th>Tamaño</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Estatus</th>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sucursales as $sucursal)
                        <tr>
                            <td>{{ $sucursal->id }}</td>
                            <td>{{ $sucursal->sucursal }}</td>
                            <td>{{ $sucursal->user->name  }}</td>
                            <td>{{ $sucursal->empleados }}</td>

                                @if ($sucursal->tamaño == 0)
                            <td class="text-dark"> Grande</td>
                                @elseif($sucursal->tamaño == 1)
                            <td class="text-dark"> Mediano</td>
                                @elseif($sucursal->tamaño == 2)
                            <td class="text-dark"> Chico</td>
                                @endif

                            <td>{{ $sucursal->d_ciudad }}</td>
                            <td>{{ $sucursal->estado }}</td>

                                @if ($sucursal->estatus == 0)
                            <td class="text-danger"> Inactivo</td>
                                @elseif($sucursal->estatus == 1)
                            <td class="text-success"> Activo</td>
                                @endif

                            <td width="80">
                                <button  class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            <td width="80">
                                <button wire:click="edit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td width="80">
                                <button class="btn btn-danger btn-sm" wire:click="$emit('deleteSucursal', {{ $sucursal }})">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="card-body">
                        <strong><h4> No existe ningún registro <i class="fa fa-exclamation-circle"></i></h4></strong>
                    </div>
                @endif
            </div>
            <nav aria-label="Page navigation example" class="float-right">
                <ul class="pagination">
                    <li class="page-item">
                        {{ $sucursales->links() }}
                    </li>
                </ul>
            </nav>
        </div>
    </div>

