<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->boolean('editable')->default(1);
            $table->boolean('removable')->default(1);
            $table->boolean('viewable')->default(1);
            $table->boolean('active')->default(1);

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
        Schema::dropIfExists('users');
    }

    private function load()
    {
        $u = new \App\Models\User();
        $u->first_name = 'Prueba';
        $u->last_name = 'Técnica';
        $u->email = 'prueba@innovaweb.cl';
        $u->password = bcrypt('prueba');
        $u->editable = 0;
        $u->removable = 0;
        $u->viewable = 0;
        $u->save();
    }
}
