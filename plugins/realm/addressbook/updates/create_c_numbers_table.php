<?php namespace Realm\AddressBook\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('realm_addressbook_c_numbers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('contact_id')->nullable()->unsigned();
            $table->string('contactnumber')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('realm_addressbook_c_numbers');
    }
}
