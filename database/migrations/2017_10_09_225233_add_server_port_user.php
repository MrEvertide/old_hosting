<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServerPortUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->string('port')->after('host');
            $table->string('whm_user')->after('api_token');
            $table->boolean('is_https');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function($table) {
            $table->dropColumn('port');
            $table->dropColumn('whm_user');
            $table->dropColumn('is_https');
        });
    }
}
