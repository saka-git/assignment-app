<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // $table->dropColumn('email');
            // $table->dropColumn('email_verified_at');
            // $table->dropColumn('password');
            // $table->dropColumn('remember_token');
            // 外部キー制約を削除
            $table->dropForeign('companies_parent_company_id_foreign');
            // カラムを削除
            $table->dropColumn('parent_company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
        });
    }
};
