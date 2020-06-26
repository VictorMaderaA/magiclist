<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateListsTablePrivate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lists', function (Blueprint $table) {
            $table->boolean('private')->default(false);
        });

        $lists = \App\Models\Lists::all();
        foreach ($lists as $l){
            try {
                $l->private = true;
                $l->save();
            }catch (Exception $e){
                \Illuminate\Support\Facades\Log::error('Failed To Change Private status for list ' . $l->id);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lists', function (Blueprint $table) {
            $table->dropColumn('private');
        });
    }
}
