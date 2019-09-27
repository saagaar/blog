<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = array(
        	array('parent_id'=>NULL,'name'=>'Engineering and Technology',		'status'=>'1',			'slug'=>'engineering&technology',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'Education',		'status'=>'1',			'slug'=>'education',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'Science',		'status'=>'1',			'slug'=>'science',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'Math',		'status'=>'1',			'slug'=>'math',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'Geography',		'status'=>'1',			'slug'=>'geography',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'Religion',		'status'=>'1',			'slug'=>'religion',		'banner_image'=>''),
        	array('parent_id'=>NULL,'name'=>'Others',		'status'=>'1',			'slug'=>'others',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'IoT',		'status'=>'1',			'slug'=>'iot',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Software',		'status'=>'1',			'slug'=>'software',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Hardware',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Artificial Intelligence',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Machine Learning',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Programming',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Data science',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'Data Analysis',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>1,'name'=>'BlockChain',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>2,'name'=>'Quality education',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>2,'name'=>'Equality',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>2,'name'=>'Degree',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>2,'name'=>'School/Colleges',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>3,'name'=>'World Politics',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>3,'name'=>'Nepal',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>3,'name'=>'Local Governance',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>4,'name'=>'Biology',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>4,'name'=>'Physics',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>4,'name'=>'Astronomy',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>4,'name'=>'Chemistry',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>4,'name'=>'Botany',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>4,'name'=>'Zoology',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>5,'name'=>'Arithmetic',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>5,'name'=>'Algebra',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>5,'name'=>'Geometry',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>5,'name'=>'Statistics',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>6,'name'=>'Human',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>6,'name'=>'Physical',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>6,'name'=>'Environmental',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>6,'name'=>'Political',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>7,'name'=>'Hinduism',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>7,'name'=>'Christianity',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>7,'name'=>'Buddhism',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'History',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Arts and Entertainment',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Society',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Music',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Movies',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Startup',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Health',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Game',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Sports',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Photography',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Travel and Living',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Livelihood',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Food and Beverage',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Environment',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Nature',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Disaster',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Accounting',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Finance',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Policy',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Culture',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Economy',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Ethnicity',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'News',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        	array('parent_id'=>8,'name'=>'Others',		'status'=>'1',			'slug'=>'',		'banner_image'=>''),
        );
    }
}
