<?php
/**
  * Database Connectivity
  *
  * Exads would like to A/B test a number of promotional designs to see which provides the best
  * conversion rate.
  *
  * Write a snippet of PHP code that redirects end users to the different designs based on the database
  * table below. Extend the database model as needed.
  *
  * i.e. - 50% of people will be shown Design A, 25% shown Design B and 25% shown Design C.
  * The code needs to be scalable as a single promotion may have upwards of 3 designs to test.
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
	$table = 'designs';

	$sqlquery = "SELECT design_id,design_name,split_percent, view_count, view_count * 100 / cj.sum AS `% of total` FROM {$table} CROSS JOIN (SELECT SUM(view_count) AS sum FROM {$table}) cj WHERE split_percent >= view_count * 100 / cj.sum order by view_count asc limit 1";
	$records = $dbh->raw_query($sqlquery);

	if (!empty($records)) {

		echo 'User redirect to ' . $records['design_name'];
		$options = [
			'fields' => [
				'view_count' => $records['view_count'] + 1
			],
			'conditions' => [
				'design_id' => $records['design_id']
			]
		];

	} else {

	    $options = [
	        'orderby' => 'split_percent',
			'limit' => 1
	    ];
	    $records = $dbh->get_single_record($table, $options);
	    echo 'User redirect to ' . $records['design_name'];

		$options = [
			'fields' => [
				'view_count' => $records['view_count'] + 1
			],
			'conditions' => [
				'design_id' => $records['design_id']
			]
		];
	}
	$dbh->update_record($table, $options);
	$records = $dbh->get_records($table);
	echo "<br>";
	print_r($records);
?>
