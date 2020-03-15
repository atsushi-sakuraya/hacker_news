<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('profile_icon_photo')->nullable()->after('name');
            $table->text('profile_header_photo')->nullable()->after('profile_icon_photo');
            $table->text('self_produce')->nullable()->after('profile_header_photo');
            $table->unsignedSmallInteger('birth_year')->after('self_produce');
            $table->unsignedTinyInteger('birth_month')->after('birth_year');
            $table->unsignedTinyInteger('birth_day')->after('birth_month');
            $table->unsignedInteger('follow')->default(0)->after('birth_day');
            $table->unsignedInteger('follower')->default(0)->after('follow');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_icon_photo');
            $table->dropColumn('profile_header_photo');
            $table->dropColumn('self_produce');
            $table->dropColumn('birth_year');
            $table->dropColumn('birth_month');
            $table->dropColumn('birth_day');
            $table->dropColumn('follow');
            $table->dropColumn('follower');
        });
    }
}
