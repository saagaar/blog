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
        	array('parent_id'=>NULL,'name'=>'Engineering and Technology',		'status'=>'1',			'slug'=>'engineering&technology',		'banner_image'=>'Engineering.jpg'),
            array('parent_id'=>NULL,'name'=>'Education',                         'status'=>'1',         'slug'=>'education',        'banner_image'=>'Education.jpg'),
        	array('parent_id'=>NULL,'name'=>'Politics',                          'status'=>'1',			'slug'=>'politics',		'banner_image'=>'Politics.jpg'),
        	
        	array('parent_id'=>NULL,'name'=>'Science',		                     'status'=>'1',		    'slug'=>'science',		'banner_image'=>'Science.jpg'),
        	array('parent_id'=>NULL,'name'=>'Math',		                         'status'=>'1',			'slug'=>'math',		'banner_image'=>'Math.jpg'),
        	array('parent_id'=>NULL,'name'=>'Geography',		                 'status'=>'1',			'slug'=>'geography',		'banner_image'=>'Geography.jpg'),
        	array('parent_id'=>NULL,'name'=>'Religion',		                     'status'=>'1',			'slug'=>'religion',		'banner_image'=>'Religion.jpg'),
        	array('parent_id'=>NULL,'name'=>'Others',		                     'status'=>'1',			'slug'=>'others',		'banner_image'=>''),
        	
        );
        DB::table('categories')->insert($category);
        $child = array(
            array('parent_id'=>1,'name'=>'IoT',                                  'status'=>'1',         'slug'=>'iot',      'banner_image'=>'Technology.jpg'),
            array('parent_id'=>1,'name'=>'Software',                             'status'=>'1',         'slug'=>'software',     'banner_image'=>''),
            array('parent_id'=>1,'name'=>'Hardware',                             'status'=>'1',         'slug'=>'hardware',     'banner_image'=>''),
            array('parent_id'=>1,'name'=>'Artificial Intelligence',              'status'=>'1',         'slug'=>'ai',       'banner_image'=>''),
            array('parent_id'=>1,'name'=>'Machine Learning',                     'status'=>'1',         'slug'=>'ml',       'banner_image'=>''),
            array('parent_id'=>1,'name'=>'Programming',                          'status'=>'1',         'slug'=>'programming',      'banner_image'=>''),
            array('parent_id'=>1,'name'=>'Data science',                         'status'=>'1',         'slug'=>'data-science',     'banner_image'=>''),
            array('parent_id'=>1,'name'=>'Data Analysis',                        'status'=>'1',         'slug'=>'data-analysis',        'banner_image'=>''),
            array('parent_id'=>1,'name'=>'BlockChain',                           'status'=>'1',         'slug'=>'blockchain',       'banner_image'=>''),
            array('parent_id'=>2,'name'=>'Quality education',                   'status'=>'1',          'slug'=>'quality-education',        'banner_image'=>''),
            array('parent_id'=>2,'name'=>'Equality',                             'status'=>'1',         'slug'=>'equality',     'banner_image'=>''),
            array('parent_id'=>2,'name'=>'Degree',                             'status'=>'1',           'slug'=>'degree',       'banner_image'=>''),
            array('parent_id'=>2,'name'=>'School/Colleges',                     'status'=>'1',          'slug'=>'school-colleges',      'banner_image'=>''),
            array('parent_id'=>3,'name'=>'World Politics',                      'status'=>'1',          'slug'=>'world-politics',       'banner_image'=>''),
            array('parent_id'=>3,'name'=>'Nepal',                               'status'=>'1',          'slug'=>'nepal',        'banner_image'=>''),
            array('parent_id'=>3,'name'=>'Local Governance',                    'status'=>'1',          'slug'=>'local Governance',     'banner_image'=>''),
            array('parent_id'=>4,'name'=>'Biology',                             'status'=>'1',          'slug'=>'biology',      'banner_image'=>''),
            array('parent_id'=>4,'name'=>'Physics',                              'status'=>'1',         'slug'=>'physics',      'banner_image'=>''),
            array('parent_id'=>4,'name'=>'Astronomy',                             'status'=>'1',            'slug'=>'astronomy',        'banner_image'=>''),
            array('parent_id'=>4,'name'=>'Chemistry',                             'status'=>'1',            'slug'=>'chemistry',        'banner_image'=>''),
            array('parent_id'=>4,'name'=>'Botany',                                'status'=>'1',            'slug'=>'botany',       'banner_image'=>''),
            array('parent_id'=>4,'name'=>'Zoology',                              'status'=>'1',         'slug'=>'zoology',      'banner_image'=>''),
            array('parent_id'=>5,'name'=>'Arithmetic',                           'status'=>'1',         'slug'=>'arithmetic',       'banner_image'=>''),
            array('parent_id'=>5,'name'=>'Algebra',                              'status'=>'1',         'slug'=>'algebra',      'banner_image'=>''),
            array('parent_id'=>5,'name'=>'Geometry',                           'status'=>'1',           'slug'=>'geometry',     'banner_image'=>''),
            array('parent_id'=>5,'name'=>'Statistics',                           'status'=>'1',         'slug'=>'statistics',       'banner_image'=>''),
            array('parent_id'=>6,'name'=>'Human',                                  'status'=>'1',           'slug'=>'human',        'banner_image'=>''),
            array('parent_id'=>6,'name'=>'Physical',                           'status'=>'1',           'slug'=>'physical',     'banner_image'=>''),
            array('parent_id'=>6,'name'=>'Environmental',                       'status'=>'1',          'slug'=>'environmental',        'banner_image'=>''),
            array('parent_id'=>6,'name'=>'Political',                          'status'=>'1',           'slug'=>'political',        'banner_image'=>''),
            array('parent_id'=>7,'name'=>'Hinduism',                           'status'=>'1',           'slug'=>'hinduism',     'banner_image'=>''),
            array('parent_id'=>7,'name'=>'Christianity',                         'status'=>'1',         'slug'=>'christianity',     'banner_image'=>''),
            array('parent_id'=>7,'name'=>'Buddhism',                           'status'=>'1',           'slug'=>'buddhism',     'banner_image'=>''),
            array('parent_id'=>8,'name'=>'History',                              'status'=>'1',         'slug'=>'history',      'banner_image'=>'History.jpg'),
            array('parent_id'=>8,'name'=>'Arts and Entertainment',             'status'=>'1',           'slug'=>'arts-and-Entertainment',       'banner_image'=>'Arts and Entertainment.jpg'),
            array('parent_id'=>8,'name'=>'Society',                              'status'=>'1',         'slug'=>'society',      'banner_image'=>'Society.jpg'),
            array('parent_id'=>8,'name'=>'Music',                                  'status'=>'1',           'slug'=>'music',        'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Movies',                                'status'=>'1',            'slug'=>'movies',       'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Startup',                              'status'=>'1',         'slug'=>'startup',      'banner_image'=>'Startup.jpg'),
            array('parent_id'=>8,'name'=>'Health',                                'status'=>'1',            'slug'=>'health',       'banner_image'=>'Health.jpg'),
            array('parent_id'=>8,'name'=>'Game',                                'status'=>'1',          'slug'=>'game',     'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Sports',                                'status'=>'1',            'slug'=>'sports',       'banner_image'=>'Sports.jpg'),
            array('parent_id'=>8,'name'=>'Photography',                           'status'=>'1',            'slug'=>'photography',      'banner_image'=>'Photography.jpg'),
            array('parent_id'=>8,'name'=>'Travel and Living',                   'status'=>'1',          'slug'=>'travel-and-living',        'banner_image'=>'Travel and Living.jpg'),
            array('parent_id'=>8,'name'=>'Livelihood',                             'status'=>'1',           'slug'=>'livelihood',       'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Food and Beverage',                   'status'=>'1',          'slug'=>'food-and-beverage',        'banner_image'=>'Food and Beverages.jpg'),
            array('parent_id'=>8,'name'=>'Environment',                         'status'=>'1',          'slug'=>'environment',      'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Nature',                                 'status'=>'1',           'slug'=>'nature',       'banner_image'=>'Nature.jpg'),
            array('parent_id'=>8,'name'=>'Disaster',                                 'status'=>'1',         'slug'=>'disaster',     'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Accounting',                             'status'=>'1',           'slug'=>'accounting',       'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Finance',                               'status'=>'1',            'slug'=>'finance',      'banner_image'=>'Finance.jpg'),
            array('parent_id'=>8,'name'=>'Policy',                                 'status'=>'1',           'slug'=>'policy',       'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Culture',                               'status'=>'1',            'slug'=>'culture',      'banner_image'=>'Culture.jpg'),
            array('parent_id'=>8,'name'=>'Economy',                               'status'=>'1',            'slug'=>'economy',      'banner_image'=>'Economy.jpg'),
            array('parent_id'=>8,'name'=>'Ethnicity',                               'status'=>'1',          'slug'=>'ethnicity',        'banner_image'=>''),
            array('parent_id'=>8,'name'=>'News',                                 'status'=>'1',         'slug'=>'news',     'banner_image'=>''),
            array('parent_id'=>8,'name'=>'Msci',                                   'status'=>'1',           'slug'=>'msic',     'banner_image'=>''),
        );
            DB::table('categories')->insert($child);
    }
}
