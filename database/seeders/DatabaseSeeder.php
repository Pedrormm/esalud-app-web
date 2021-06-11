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
            MessagesTableSeeder::class,
            PatientsTableSeeder::class,
            PatientsDoctorsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            RolesPermissionsTableSeeder::class,
            BranchesTableSeeder::class,
            SpecialitiesStaffTableSeeder::class,
            StaffTableSeeder::class,
            MedicinesAdministrationTableSeeder::class,
            TypeMedicineTableSeeder::class,
            TreatmentsTableSeeder::class,
            RoutesTableSeeder::class,
            StaffScheduleTableSeeder::class
            ]);
    }
}
