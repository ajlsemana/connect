<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create(
        			array(
        				'username'		=> 'superadmin',
        				'password'		=> '$2y$10$zN72J2lIcW.gzOxcs5276eHtD8k.bryv3W5EXiaOMhtNfxmwuzSv6',
        				'first_name'	=> 'Super',
        				'middle_name'	=> '',
        				'last_name'		=> 'Admin',
        				'email_address'	=> 'superadmin@tblsys.com',
        				'user_type'		=> 1,
        				'status'		=> 1
        			)
      	  		);
    }

}