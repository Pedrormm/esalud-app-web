<?php

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
            AnalyticsTableSeeder::class,
            AnalyticsResultsTableSeeder::class,
            CallsTableSeeder::class,
            ChatsTableSeeder::class,
            EventsTableSeeder::class,
            LogsTableSeeder::class,
            MedicinesTableSeeder::class,
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
            SpecialitiesTableSeeder::class,
            SpecialitiesStaffTableSeeder::class,
            StaffTableSeeder::class,
            UsersTableSeeder::class,
            WarningsTableSeeder::class,
            WarningsReadsTableSeeder::class
            ]);
        $this->call(LogsTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(RelationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PiecenewsTableSeeder::class);
        $this->call(ProtocolsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(RolesPermissionsTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(WarningsTableSeeder::class);
        $this->call(WarningReadsTableSeeder::class);
    }
}
