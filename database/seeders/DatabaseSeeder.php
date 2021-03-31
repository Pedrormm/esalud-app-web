<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AnalyticsTableSeeder::class,
            AnalyticsResultsTableSeeder::class,
            CallsTableSeeder::class,
            ChatsTableSeeder::class,
            EventsTableSeeder::class,
            LogsTableSeeder::class,
            TreatmentsTableSeeder::class,
            MessagesTableSeeder::class,
            NotesTableSeeder::class,
            PatientsTableSeeder::class,
            PatientsDoctorsTableSeeder::class,
            PermissionsTableSeeder::class,
            PiecenewsTableSeeder::class,
            ProtocolsTableSeeder::class,
            ReportsTableSeeder::class,
            RolesTableSeeder::class,
            RolesPermissionsTableSeeder::class,
            BranchesTableSeeder::class,
            SpecialitiesStaffTableSeeder::class,
            StaffTableSeeder::class,
            WarningsTableSeeder::class,
            WarningsReadsTableSeeder::class,
            MedicinesAdministrationTableSeeder::class,
            TypeMedicineTableSeeder::class
            ]);
    }
}
