<div class="col-8">

    @include('livewire.modulo-diagnosticos.alumno.form')

    <div class="mt-4">
        <button wire:click="update" wire:loading.attr="disabled" wire:target="update" class="btn btn-success">Actualizar</button>
        <button wire:click="table({{ $alumno->id }})" class="btn btn-danger">Volver</button>
        
    </div>

</div>
