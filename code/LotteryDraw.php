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

  class LotteryDraw
  {

    /**
     * @var  $date
    */
      protected $date;

      /**
       * @var  $next_draw
      */
      protected $next_draw;

      /**
      * Constructor method to set initial data
      * @param date $date
      * @return null
      */
      public function __construct($date = null)
      {
          date_default_timezone_set('Europe/Dublin'); // Sets the default timezone used by all date/time functions in the script to Europe/Dublin.

          if (empty($date)) {
              $this->date =  strtotime("now");
          } elseif (isset($date) && ((bool)strtotime($date) == true)) {
              $this->date =  strtotime($date);
          } else {
              echo "Invalid Date";
          }

          $this->getNextLotteryDrawDate();
      }

      /**
      * Method to check and set date
      * @param null
      * @return null
      */
      public function getNextLotteryDrawDate()
      {
          $day = date('D', $this->date);
          $hour = date('H', $this->date);
          $date = date('Y-m-d', $this->date);

          if (($day == 'Wed' || $day == 'Sat') && $hour < 20) {
              $this->next_draw = date("Y-m-d", $this->date);
          } elseif (($day == 'Mon' || $day == 'Tue')) {
              $this->next_draw = date("Y-m-d", strtotime("Next Wednesday"));
          } else {
              $this->next_draw = date("Y-m-d", strtotime("Next Saturday"));
          }
      }

      /**
      * Get next draw date
      * @param null
      * @return date
      */
      public function getDate()
      {
          return $this->next_draw;
      }
  }

  $lottery_draw_without_date = new LotteryDraw;
  echo 'Next Irish National Lottery draw is at '. $lottery_draw_without_date->getDate();
  echo "<br />";

  $lottery_draw_with_date = new LotteryDraw('27-02-2019');
  echo 'Next Irish National Lottery draw is at '. $lottery_draw_with_date->getDate();
  echo "<br />";

  $lottery_draw_with_datetime = new LotteryDraw('27-02-2019 19:00:00');
  echo 'Next Irish National Lottery draw is at '. $lottery_draw_with_datetime->getDate();
  echo "<br />";

  $lottery_draw_with_nextdate = new LotteryDraw('27-02-2019 21:00:00');
  echo 'Next Irish National Lottery draw is at '. $lottery_draw_with_nextdate->getDate();

?>
