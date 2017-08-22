<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCarwash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services',function(Blueprint $table){
          $table->increments('id');
          $table->string('cart_type');
          $table->string('plate');
          $table->float('wash_price',8,2);
          $table->float('extra_mud',8,2);
          $table->float('loyalty_discount',8,2);
          $table->float('subtotal',8,2);
          $table->float('tax',8,2);
          $table->float('total',8,2);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
    }
}
