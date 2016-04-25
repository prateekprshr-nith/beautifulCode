<?php

use Illuminate\Database\Seeder;

/**
 * Class NonUserTablesSeeder, this class
 * is used to seed non user tables
 */
class NonUserTablesSeeder extends Seeder
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
            'CHD' => 'Department of Chemistry',
            'HSD' => 'Department of Humanities and Social Sciences',
            'MSD' => 'Department of Management Studies',
            'MD' => 'Department of Mathematics',
            'PD' => 'Department of Physics',
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
        $hostelArr = [
            'MMH' => 'Manimahesh Hostel',
            'KBH' => 'Kailash Boys Hostel',
            'PGH' => 'Parvati Girls Hostel',
            'VBH' => 'Vindhanchal Boys Hostel',
            'NBH' => 'Neelkanth Boys Hostel',
            'AGH' => 'Ambika Girls Hostel',
            'HMH' => 'Himadri Hostel',
            'HGH' => 'Himgiri Hostel',
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
        

        // Seed the courses table
        $courseArr = [
            'CSS-121' => ['CSED','1','Engineering Mathematics-II',false,false,'3','1','0','4'],
            'CSS-122' => ['CSED','1','Chemistry for Computer Engineers',false,false,'3','1','0','4'],
            'CSH-123' => ['CSED','1','Communication Skills',false,false,'3','1','0','4'],
            'CSD-124' => ['CSED','1','Basic Electrical Engineering',false,false,'3','1','0','4'],
            'CSS-125' => ['CSED','1','Chemistry Lab',false,false,'0','0','3','1'],
            'CSH-126' => ['CSED','1','Communication Skills Lab',false,false,'0','0','3','1'],
            'CSD-127' => ['CSED','1','Engineering Graphics',false,false,'1','0','3','3'],
        ];

        foreach($courseArr as $courseCode => $details)
        {
            if(DB::table('courses')->where('courseCode', $courseCode)->value('courseCode') == null)
            {
                DB::table('courses')->insert([
                    'courseCode' => $courseCode,
                    'dCode' => $details[0],
                    'semNo' => $details[1],
                    'courseName' => $details[2],
                    'openElective' => $details[3],
                    'departmentElective' => $details[4],
                    'lectures' => $details[5],
                    'tutorials' => $details[6],
                    'practicals' => $details[7],
                    'credits' => $details[8],
                ]);
            }
        }
    }
}
