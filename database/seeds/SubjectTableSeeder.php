<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('subjects')->insert([    		
    		'subjects' => 'Art',
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('subjects')->insert([    		
    		'subjects' => 'Business',
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'English',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'Computer',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'Foregn Language',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'History',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'Law',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('subjects')->insert([         
            'subjects' => 'Mathematics',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'Medicine',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'Philosophy',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'Science',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('subjects')->insert([         
            'subjects' => 'General',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
