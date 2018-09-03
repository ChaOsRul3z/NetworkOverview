<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortVlanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('port_vlan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('port_id')->unsigned()->index();
            $table->foreign('port_id')->references('id')->on('ports')->onDelete('cascade');
            $table->integer('vlan_id')->unsigned()->index();
            $table->foreign('vlan_id')->references('id')->on('vlans')->onDelete('cascade');
            $table->primary(['port_id', 'vlan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('port_vlan');
    }
}
