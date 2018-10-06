<?php

return [
'csv' => 1,
'category' => 2,
'weight' => 3,
'amount' => 4,


'title' => [
	'csv' => 'CSV Import',
	'category' => 'By Product Category',
	'weight' => 'By Total Weight of Products',
	'amount' => 'By Total Order Amount',
],


'csv_path' => '/storage/app',

'type' => [
	1 => 'csv',
	2 => 'category',
	3 => 'weight',
	4 => 'amount',
],


'states' => [
    'Kuala Lumpur',
    'Johor',
    'Kedah',
    'Kelantan',
    'Kuantan',
    'Melacca',
    'Negeri Sembilan',
    'Labuan',
    'Pahang',
    'Penang',
    'Perak',
    'Perlis',
    'Putrajaya',
    'Sabah',
    'Sarawak',
    'Selangor',
    'Terengganu',
],


'destinations' => [
    'West Malaysia, Peninsular Malaysia' => [
        'Kuala Lumpur',
        'Johor',
        'Kedah',
        'Kelantan',
        'Kuantan',
        'Melacca',
        'Negeri Sembilan',
        'Pahang',
        'Penang',
        'Perak',
        'Perlis',
        'Putrajaya',
        'Selangor',
        'Terengganu',
        'Pulau Pinang',
    ],

    'East Malaysia' => [
        'Sabah',
        'Sarawak',
        'Labuan',
    ],

],

];