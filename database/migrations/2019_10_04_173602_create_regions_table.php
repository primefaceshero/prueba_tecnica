<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code', 4);
            $table->timestamps();
        });

        $this->load();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }

    private function load()
    {
        $regions = array(
            [15, 'Arica y Parinacota', 'XV'],
            [1, 'Tarapacá', 'I'],
            [2, 'Antofagasta', 'II'],
            [3, 'Atacama', 'III'],
            [4, 'Coquimbo', 'IV'],
            [5, 'Valparaiso', 'V'],
            [13, 'Metropolitana de Santiago', 'RM'],
            [6, 'Libertador General Bernardo O\'Higgins', 'VI'],
            [7, 'Maule', 'VII'],
            [8, 'Biobío', 'VIII'],
            [9, 'La Araucanía', 'IX'],
            [14, 'Los Ríos', 'XIV'],
            [10, 'Los Lagos', 'X'],
            [11, 'Aisén del General Carlos Ibáñez del Campo', 'XI'],
            [12, 'Magallanes y de la Antártica Chilena', 'XII']);

        foreach ($regions as $region){
            App\Models\Region::create([
                'id' => $region[0],
                'name' => $region[1],
                'code' => $region[2]
            ]);
        }
    }
}
