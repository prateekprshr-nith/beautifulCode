<?php

use Illuminate\Database\Seeder;
/**
 * Class NonUserTablesSeeder, this class
 * is used to seed user tables
 */
class UserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default password for users
        $password = bcrypt('password');

        // Seed the admins table
        $adminId = 'admin';

        if(DB::table('admins')->where('adminId', $adminId)->value('adminId') == null)
        {
            DB::table('admins')->insert([
                'adminId' => $adminId,
                'password' => $password,
            ]);
        }

        // Seed the students table
        $studentArr = [
          '12510' => [
              'CSED','1','022/11','E1','Prateek Prahser','Desh Raj Prasher','Parveen Prasher','prateekprshr@gmail.com',
              '9418563443','KBH','Nagrota Bagwan',$password,'1995-09-08',null,true
          ]
        ];

        foreach($studentArr as $rollNo => $details)
        {
            if (DB::table('students')->where('rollNo', $rollNo)->value('rollNo') == null)
            {
                DB::table('students')->insert([
                    'rollNo' => $rollNo,
                    'dCode' => $details[0],
                    'semNo' => $details[1],
                    'registrationNo' => $details[2],
                    'sectionId' => $details[3],
                    'name' => $details[4],
                    'fatherName' => $details[5],
                    'motherName' => $details[6],
                    'email' => $details[7],
                    'phoneNo' => $details[8],
                    'currentAddress' => $details[9],
                    'permanentAddress' => $details[10],
                    'password' => $details[11],
                    'dob' => $details[12],
                    'verificationCode' => $details[13],
                    'verified' => $details[14],
                ]);
            }
        }

        // Seed the teachers table
        $teacherArr = [
            'ta' => [
                'CSED',null,'TeacherA','ta@ex.com','CSED',$password,true,
            ]
        ];

        foreach($teacherArr as $facultyId => $details)
        {
            if (DB::table('teachers')->where('facultyId', $facultyId)->value('facultyId') == null)
            {
                DB::table('teachers')->insert([
                    'facultyId' => $facultyId,
                    'dCode' => $details[0],
                    'semNo' => $details[1],
                    'name' => $details[2],
                    'email' => $details[3],
                    'office' => $details[4],
                    'password' => $details[5],
                    'firstLogin' => $details[6],
                ]);
            }
        }

        // Seed the libraryStaffs table
        $libraryStaffArr = [
            'la' => [
                'LibraryA','ta@ex.com',$password,true,
            ]
        ];

        foreach($libraryStaffArr as $id => $details)
        {
            if (DB::table('libraryStaffs')->where('id', $id)->value('id') == null)
            {
                DB::table('libraryStaffs')->insert([
                    'id' => $id,
                    'name' => $details[0],
                    'email' => $details[1],
                    'password' => $details[2],
                    'firstLogin' => $details[3],
                ]);
            }
        }

        // Seed the adminStaffs table
        $adminStaffArr = [
            'aa' => [
                'AdminA','aa@ex.com',$password,true,
            ]
        ];

        foreach($adminStaffArr as $id => $details)
        {
            if (DB::table('adminStaffs')->where('id', $id)->value('id') == null)
            {
                DB::table('adminStaffs')->insert([
                    'id' => $id,
                    'name' => $details[0],
                    'email' => $details[1],
                    'password' => $details[2],
                    'firstLogin' => $details[3],
                ]);
            }
        }

        // Seed the chiefWardenStaffs table
        $chiefWardenStaffArr = [
            'cwa' => [
                'ChiefWardenA','cwa@ex.com',$password,true,
            ]
        ];

        foreach($chiefWardenStaffArr as $id => $details)
        {
            if (DB::table('chiefWardenStaffs')->where('id', $id)->value('id') == null)
            {
                DB::table('chiefWardenStaffs')->insert([
                    'id' => $id,
                    'name' => $details[0],
                    'email' => $details[1],
                    'password' => $details[2],
                    'firstLogin' => $details[3],
                ]);
            }
        }

        // Seed the hostelStaffs table
        $hostelStaffArr = [
            'ha' => [
                'KBH','HostelA','ha@ex.com',$password,true,
            ]
        ];

        foreach($hostelStaffArr as $id => $details)
        {
            if (DB::table('hostelStaffs')->where('id', $id)->value('id') == null)
            {
                DB::table('hostelStaffs')->insert([
                    'id' => $id,
                    'hostelId' => $details[0],
                    'name' => $details[1],
                    'email' => $details[2],
                    'password' => $details[3],
                    'firstLogin' => $details[4],
                ]);
            }
        }

        // Seed the departmentStaffs table
        $departmentStaffArr = [
            'da' => [
                'CSED','DepartmentA','da@ex.com',$password,true,
            ]
        ];

        foreach($departmentStaffArr as $id => $details)
        {
            if (DB::table('departmentStaffs')->where('id', $id)->value('id') == null)
            {
                DB::table('departmentStaffs')->insert([
                    'id' => $id,
                    'dCode' => $details[0],
                    'name' => $details[1],
                    'email' => $details[2],
                    'password' => $details[3],
                    'firstLogin' => $details[4],
                ]);
            }
        }
    }
}
