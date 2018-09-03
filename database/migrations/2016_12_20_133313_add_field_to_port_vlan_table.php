<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToPortVlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('port_vlan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->boolean('tagged')->default(false)->after('vlan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('port_vlan', function (Blueprint $table) {
            //
        });
    }
}
