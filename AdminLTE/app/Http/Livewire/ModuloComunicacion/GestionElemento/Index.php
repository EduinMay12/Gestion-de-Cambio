<?php

namespace App\Http\Livewire\ModuloComunicacion\GestionElemento;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ModuloComunicacion\Elemento;
use App\Models\User;
use App\Models\ModuloComunicacion\Comunicacion;


class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $view = 'table';
    public $cant = '10';
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    public $name;
    public $elemento;
    public $elemento_id;
    public $comunicacion_id;
    public $user_id;
    public $descripcion;
    public $dirigido;
    public $imagen;
    public $url;
    public $status;
    public $contenido;
    public $identificador;

    protected $paginationTheme = "bootstrap";

    protected $listeners =
    [
        'delete'
    ];

    protected $queryString =
    [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected $rules =
    [
        'name' => 'required',
        'comunicacion_id' => 'required',
        'user_id' => 'required',
        'descripcion' => 'required',
        'dirigido' => 'required',
        'contenido' => 'required',
        'url' => 'required',
        'imagen' => 'required|image|max:2048',
        'status' => 'required'
    ];

    public function mount()
    {
        $this->identificador = rand();
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }

        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::all();
        $comunicacions = Comunicacion::where('status', '=', 1)->get();
        $elementos = Elemento::where('name', 'like' , '%' . $this->search . '%')
                    ->orWhere('user_id', 'like' , '%' . $this->search . '%')
                    ->Where('descripcion', 'like' , '%' . $this->search . '%')
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->cant);
        return view('livewire.modulo-comunicacion.gestion-elemento.index', compact('elementos', 'comunicacions'))->with('users',$users);
    }

    public function table($elemento)
    {
        $this->elemento_id = $elemento;
        $this->reset([
            'name',
            'dirigido',
            'descripcion',
            'contenido',
            'url',
            'user_id',
            'comunicacion_id',
            'imagen',
            'status'
        ]);
        $this->identificar = rand();
        $this->view = 'table';
    }

    public function create(Elemento $elemento)
    {
        $this->elemento = $elemento;
        $this->view = 'create';
    }

    public function save()
    {
        $this->validate([
            'user_id' => 'required',
            'name' => 'required',
            'comunicacion_id' => 'required',
            'url' => 'required',
            'imagen' => 'required',
            'status' => 'required',
            'dirigido' => 'required',
            'contenido' => 'required',
            'descripcion' => 'required'
        ]);

        $imagen = $this->imagen->store('elemento');

        Elemento::create([
            'name' => $this->name,
            'comunicacion_id' => $this->comunicacion_id,
            'user_id' => $this->user_id,
            'descripcion' => $this->descripcion,
            'dirigido' => $this->dirigido,
            'contenido' => $this->contenido,
            'url' => $this->url,
            'imagen' => $imagen,
            'status' => $this->status
        ]);

        $this->reset([
            'name',
            'dirigido',
            'descripcion',
            'contenido',
            'url',
            'user_id',
            'comunicacion_id',
            'imagen',
            'status'
        ]);

        $this->identificador = rand();

        $this->emit('alert', '!Se agregó un elemento de comunicación con exito¡');
    }

    public function show(Elemento $elemento)
    {
        $this->elemento = $elemento;
        $this->view = 'show';
    }

    public function delete(Elemento $elemento)
    {

        $elemento->delete();

    }

    public function edit( Comunicacion $comunicacion)
    {
        $this->comunicacion_id = $comunicacion->id;
        $this->name = $comunicacion->name;
        $this->imagen_comunicacion = $comunicacion->imagen;
        $this->descripcion = $comunicacion->descripcion;
        $this->status = $comunicacion->status;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'status' => 'required',
            'comunicacion_id' => 'required'
        ]);

        if ($this->imagen) {
            Storage::delete([$this->imagen_comunicacion]);
            $this->imagen_comunicacion = $this->imagen->store('comunicacion');
        }

        $comunicacion = Comunicacion::find($this->comunicacion_id);

        $comunicacion->update([

            'name' => $this->name,
            'imagen' => $this->imagen_comunicacion,
            'descripcion' => $this->descripcion,
            'status' => $this->status
        ]);

        $this->identificador = rand();

        $this->emit('alert', '!Se actualizó la categoria de la comunicacion con exito¡');

    }
}
