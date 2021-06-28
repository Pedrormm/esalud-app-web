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
            CountriesTableSeeder::class,
            PhonePrefixesTableSeeder::class,
            UsersTableSeeder::class,
            MessagesTableSeeder::class,
            PatientsTableSeeder::class,
            PatientsDoctorsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            RolesPermissionsTableSeeder::class,
            MedicalSpecialitiesTableSeeder::class,
            SpecialitiesStaffTableSeeder::class,
            StaffTableSeeder::class,
            MedicinesAdministrationTableSeeder::class,
            TypeMedicineTableSeeder::class,
            TreatmentsTableSeeder::class,
            RoutesTableSeeder::class,
            StaffScheduleTableSeeder::class,
            // AppointmentsTableSeeder::class
            ]);
    }
}
