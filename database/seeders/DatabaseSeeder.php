<?php

namespace Database\Seeders;

use App\Models\Pedido;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Country::factory(50)->create();
        \App\Models\Cliente::factory(25)->create();
        Pedido::factory(15)->create();
        //Tabla cliente_pedido
        for($i=1; $i<=15; $i++){
            $pedido = Pedido::find($i);
            $pedido->clientes()->attach(random_int(1,25));

        }
    }
}
