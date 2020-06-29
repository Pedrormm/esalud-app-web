<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewUsersWithMessagesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW users_with_messages_view AS
        SELECT * FROM (
        SELECT A.*,B.created_at as message_date FROM
        users A
        LEFT JOIN
        messages B ON(A.id = B.user_id_to)
        
        UNION
        
        SELECT A.*,B.created_at as message_date FROM
        users A
        LEFT JOIN
        messages B ON(A.id = B.user_id_from)
        ) as tmp");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS users_with_messages_view");
    }
}
