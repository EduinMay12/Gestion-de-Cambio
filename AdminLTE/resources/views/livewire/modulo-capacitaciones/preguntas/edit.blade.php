
    @include('livewire.modulo-capacitaciones.preguntas.form')

    <div class="mt-4">
        <button wire:click="update" wire:loading.attr="disabled" wire:target="update"
            class="btn btn-success">Guardar</button>
        <button wire:click="table({{ $cuestionario->id }})" class="btn btn-danger">Volver</button>
    </div>
