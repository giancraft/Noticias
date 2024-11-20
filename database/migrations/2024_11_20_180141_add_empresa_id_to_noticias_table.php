<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpresaIdToNoticiasTable extends Migration
{
    public function up()
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_id')->after('id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropColumn('empresa_id');
        });
    }
}
