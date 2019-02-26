<?php
/**
  * 500 Element Array
  *
  * Write a PHP script to generate a random array of 500 integers (values of 1 – 500 inclusive).
  * Randomly remove and discard an arbitary element from this newly generated array.
  *
  * @author  Srikanth Matheesh <phpsri@gmail.com>
  *
  * @version 1.0
  *
  * @since 1.0
  *
  */

  /**
  * Method to find missing element in an array with 1 to 500
  * @param null
  * @return null
  */
    function random500Array()
    {

        // Create random array variables with values 1 to 500
        $array_to_process = $array_to_compare = range(1, 500);

        // Randomize the order of the elements in the array
        shuffle($array_to_process);

        // Generates a random integer key to remove from the original array
        $elemment_to_remove = mt_rand(0, 499); // mt_rand() faster than rand()

        // Unset the variable set by $elemment_to_remove
        unset($array_to_process[$elemment_to_remove]);

        // Printing final processed array
        print_r($array_to_process);

        /* Option 1 */
        // Compare the values of two arrays, and return the differences
        $missing_element = array_diff($array_to_compare, $array_to_process);
        print "Missing element value using array_diff(): " . current($missing_element); // Return the current element in an array

        /* Option 2 */
        // Calculate the sum of values in an both array and subtract them to get the missing element
        // $missing_element = array_sum($array_to_compare) - array_sum($array_to_process);
        // print "Missing element using array_sum(): " . $missing_element;

        unset($array_to_process);
        unset($array_to_compare);
    }

    random500Array();
?>
