<?php
/**
  * Database Connectivity
  *
  * Demonstrate with PHP how you would connect to a MySQL (InnoDB) database and query for all
  * records with the following fields: (name, age, job_title) from a table called 'exads_test'.
  *
  * Also provide an example of how you would write a sanitised record to the same table.
  *
  * @author  Srikanth Matheesh <phpsri@gmail.com>
  *
  * @version 1.0
  *
  * @since 1.0
  *
  */

    require "DBH.php";
    $dbh = new DBH;
	$table = 'exads_test';

	/* Insert records to table*/
	$options = [
		'name' => $dbh->checkinput('rolf hegdal'),
		'age' => $dbh->checkinput('31'),
		'job_title' => $dbh->checkinput('Developer')
	];
	$records = $dbh->insert_record($table, $options);

	/* Query for all records */
    $options = [
        'orderby' => 'id'
    ];
    $records = $dbh->get_records($table, $options);
    print_r($records);

	/* Query for records with pagingation*/
    // $options = [
	// 	'page' => 1,
    //     'orderby' => 'id'
    // ];
    // $records = $dbh->get_records($table, $options);
    // print_r($records);

?>
