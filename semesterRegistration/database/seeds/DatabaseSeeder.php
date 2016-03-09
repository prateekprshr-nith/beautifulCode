<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder, this class is
 * used to seed the database with the
 * data for testing purposes.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the departments table
        $deptArr = [
            'CSED' => 'Department of Computer Science & Engineering',
            'ECED' => 'Department of Electronics & Communication Engineering',
            'CED' => 'Department of Civil Engineering',
            'EED' => 'Department of Electrical & Electronics Engineering',
            'MED' => 'Department of Mechanical Engineering',
            'CHED' => 'Department of Chemical Engineering',
            'ARD' => 'Department of Architecture',
        ];

        foreach($deptArr as $dCode => $dName)
        {
            if(DB::table('departments')->where('dCode', $dCode)->value('dCode') == null)
            {
                DB::table('departments')->insert([
                    'dCode' => $dCode,
                    'dName' => $dName,
                ]);
            }
        }

        // Seed the semester table
        for($semNo = 1; $semNo <= 10; $semNo++)
        {
            if(DB::table('semesters')->where('semNo', $semNo)->value('semNo') == null)
            {
                DB::table('semesters')->insert(['semNo' => $semNo]);
            }
        }

        // Seed the sections table
        // #TODO add more sections
        $sectArr = [
            'E1' => 'CSED',
            'E2' => 'CSED',
        ];

        foreach($sectArr as $sectionId => $dCode)
        {
            if(DB::table('sections')->where('sectionId', $sectionId)->value('sectionId') == null)
            {
                DB::table('sections')->insert([
                    'sectionId' => $sectionId,
                    'dCode' => $dCode,
                ]);
            }
        }

        // Seed the hostels table
        // #TODO add more hostels
        $hostelArr = [
            'MMH' => 'Manimahesh Hostel',
            'KBH' => 'Kailash Boys Hostel',
        ];

        foreach($hostelArr as $hostelId => $name)
        {
            if(DB::table('hostels')->where('hostelId', $hostelId)->value('hostelId') == null)
            {
                DB::table('hostels')->insert([
                    'hostelId' => $hostelId,
                    'name' => $name,
                ]);
            }
        }

        // Seed the admins table
        $adminId = 'admin';
        $password = bcrypt('password');

        if(DB::table('admins')->where('adminId', $adminId)->value('adminId') == null)
        {
            DB::table('admins')->insert([
                'adminId' => $adminId,
                'password' => $password,
            ]);
        }
    }
}
