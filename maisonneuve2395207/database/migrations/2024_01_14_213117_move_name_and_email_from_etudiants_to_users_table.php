<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get the data from the etudiants table
        $etudiants = DB::table('etudiants')->get();

        // Loop through the etudiants and insert the data to the users table
        foreach ($etudiants as $etudiant) {
            // Create a new user with the name and email of the etudiant
            $user = DB::table('users')->insertGetId([
                'name' => $etudiant->nom,
                'email' => $etudiant->email,
                'password' => bcrypt('1234'), //default password is '1234'
            ]);

            // Update the user_id of the etudiant with the id of the user
            DB::table('etudiants')->where('id', $etudiant->id)->update([
                'user_id' => $user,
            ]);
        }

        // Drop the name and email columns from the etudiants table
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropColumn(['nom', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add the name and email columns to the etudiants table
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('nom');
            $table->string('email')->unique();
        });

        // Get the data from the users table
        $users = DB::table('users')->get();

        // Loop through the users and update the data to the etudiants table
        foreach ($users as $user) {
            // Find the etudiant with the user_id of the user
            $etudiant = DB::table('etudiants')->where('user_id', $user->id)->first();

            // Update the name and email of the etudiant with the name and email of the user
            DB::table('etudiants')->where('id', $etudiant->id)->update([
                'name' => $user->name,
                'email' => $user->email,
            ]);

            // Delete the user
            DB::table('users')->where('id', $user->id)->delete();
        }
    }
};
