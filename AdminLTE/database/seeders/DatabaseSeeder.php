<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\ModuloCapacitaciones\Categoria;
use App\Models\ModuloCapacitaciones\Cuestionario;
use App\Models\ModuloCapacitaciones\Curso;
use App\Models\ModuloCapacitaciones\Grupo;
use App\Models\ModuloCapacitaciones\Instructore;
use App\Models\ModuloCapacitaciones\Leccione;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Carpeta donde se guardan las imagenes de categorias de capacitaciones
        Storage::deleteDirectory('categorias');
        Storage::deleteDirectory('cursos');
        Storage::deleteDirectory('grupos');
        Storage::makeDirectory('categorias');
        Storage::makeDirectory('cursos');
        Storage::makeDirectory('grupos');

        \App\Models\User::factory(100)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        Categoria::factory(20)->create();
        Instructore::factory(50)->create();
        Curso::factory(80)->create();
        Grupo::factory(300)->create();
        Leccione::factory(300)->create();
        Cuestionario::factory(20)->create();
    }
}
