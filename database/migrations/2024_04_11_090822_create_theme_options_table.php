<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_options', function (Blueprint $table) {
            $table->id();
            $table->text('top_header1_text')->nullable();
            $table->text('top_header2_text')->nullable();
            $table->string('top_header2_text_price')->nullable();
            $table->string('mega_menu_banner')->nullable();
            $table->string('header_logo')->nullable();
            $table->text('footer_description')->nullable();
            $table->text('social_links')->nullable();
            $table->string('admin_email')->nullable();
            $table->string('admin_phone')->nullable();
            $table->string('footer_payment_logo')->nullable();
            $table->text('above_footer_section')->nullable();
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
        Schema::drop('theme_options');
    }
}
