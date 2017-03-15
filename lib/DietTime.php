<?php
class DietTime
{

    public $date;
    public $format;
    protected static $days_of_week = array (
        "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"
    );

    function __construct($date = null, $format = "Y-m-d")
    {
        $this->date = strtotime($date);
        $this->format = $format;
        if ($date === null) {
            $this->date = time();
        }
    }

    /**
     * Returns formatted date based on the given format (default "Y-m-d")
     * @return string
     */
    public function getFormattedDate()
    {
        return date($this->format, $this->date);
    }

    /**
     * Returns the previous date based on the given day of the week
     * @param int $day - day of the week (eg. 0 is monday, 1 is tuesday..)
     * @return string
     */
    public function getPreviousDay($day = 0)
    {
        $previous_day = self::$days_of_week[$day];
        return date($this->format, strtotime("previous ".$previous_day, $this->date));
    }

    /**
     * Returns the next date based on the given day of the week
     * @param int $day - day of the week (eg. 0 is monday, 1 is tuesday..)
     * @return string
     */
    public function getNextDay($day = 0)
    {
        $next_day = self::$days_of_week[$day];
        return date($this->format, strtotime("next ".$next_day, $this->date));
    }

    public function getFirstDayOfMonth()
    {
        return date($this->format, strtotime("first day of this month", $this->date));
    }

    public function getLastDayOfMonth()
    {
        return date($this->format, strtotime("last day of this month", $this->date));
    }
    
    public function getMonthRange()
    {
        return array($this->getFirstDayOfMonth(), $this->getLastDayOfMonth());
    }

    public function getWeekRange()
    {
        return array($this->getPreviousDay(), $this->getNextDay(6));
    }

    /**
     * Check if a date is within the week range.
     * @param $date - a formatted date
     * @return bool
     */
    public function isWithinWeek($date)
    {
        if (!$date) {
            return false;
        }

        $week_range = $this->getWeekRange();
        return $this->isDateWithin($week_range, $date);
    }

    /**
     * Check if a date is within the month range.
     * @param $date - a formatted date
     * @return bool
     */
    public function isWithinMonth($date)
    {
        if (!$date) {
            return false;
        }

        $month_range = $this->getMonthRange();
        return $this->isDateWithin($month_range, $date);
    }

    /**
     * @param array $range - range of date (eg. array("2013-07-25", "2013-09-09")
     * @param string $date - date to compare
     * @return bool
     */
    public function isDateWithin($range, $date)
    {
        $date = strtotime($date);
        if (strtotime($range[0]) <= $date && strtotime($range[1]) >= $date) {
            return true;
        }

        return false;
    }
}