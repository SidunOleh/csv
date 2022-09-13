<?php // routes

return [
	'GET' => [
		'/' => 'csv/index',
        '/table'  => 'csv/table',
        '/export' => 'csv/export', 
	],

	'POST' => [
		'/import' => 'csv/import',
	],
];
