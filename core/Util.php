<?php

namespace DDForum\Core;

class Util
{
  public static function timestamp( $datetime ) {
    list($date, $time) = explode(' ', $datetime);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);

    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

    return $timestamp;
  }

  public static function getdate($timestamp)
  {
    $info = getdate( $timestamp );
    $info[ 'mon0' ] = substr( '0' . $info[ 'mon' ], -2, 2 );
    $info[ 'mday0' ] = substr( '0' . $info[ 'mday' ], -2, 2 );
    return $info;
  }

  public static function time2str($ts) {
    if ( !ctype_digit( $ts ) ) {
      $ts = strtotime( $ts );
    }

    $diff = time() - $ts;

    if ( $diff == 0 ) {
      return 'now';
    }
    elseif ( $diff > 0 ) {
      $day_diff = floor( $diff / 86400 );

      if ( $day_diff == 0 ) {
        if ( $diff < 60 ) return 'just now';
        if ( $diff < 120 ) return '1 minute ago';
        if ( $diff < 3600 ) return floor( $diff / 60 ) . ' minutes ago';
        if ( $diff < 7200 ) return '1 hour ago';
        if ( $diff < 86400 ) return floor( $diff / 3600 ) . ' hours ago';
      }

      if ( $day_diff == 1 ) return 'Yesterday';
      if ( $day_diff < 7 ) return $day_diff . ' days ago';
      if ( $day_diff < 31 ) return ceil( $day_diff / 7 ) . ' weeks ago';
      if ( $day_diff < 60 ) return 'last month';

      return date('F Y', $ts);
    }
    else {
      $diff = abs($diff);
      $day_diff = floor($diff / 86400);

      if ( $day_diff == 0 ) {
        if ( $diff < 120 ) return 'in a minute';
        if ( $diff < 3600 ) return 'in ' . floor($diff / 60) . ' minutes';
        if ( $diff < 7200 ) return 'in an hour';
        if ( $diff < 86400 ) return 'in ' . floor($diff / 3600) . ' hours';
      }

      if ( $day_diff == 1 ) return 'Tomorrow';
      if ( $day_diff < 4 ) return date('l', $ts);
      if ( $day_diff < 7 + ( 7 - date('w') ) ) return 'next week';
      if ( ceil($day_diff / 7 ) < 4 ) return 'in ' . ceil($day_diff / 7) . ' weeks';
      if ( date('n', $ts ) == date( 'n' ) + 1 ) return 'next month';
      return date( 'F Y', $ts );
    }
  }

  public static function locale_date( $format, $timestamp )
  {
    $matches = preg_split( '/((?<!\\\\)%[a-z]\\s*)/iu', $format, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );
    $output = '';
    foreach ( $matches as $match ) {
      if ( $match{0} == '%' ) {
        $output .= strftime( $match, $timestamp );
      }
      else {
        $output .= date( $match, $timestamp );
      }
    }
    return $output;
  }

  /**
   * Redirect to a new URL
   *
   * @param string $url
   *   The url to redirect to
   * @return void
   */
  public static function redirect($url)
  {
    header( 'Location: ' . $url, true, 302 );
    exit;
  }

  /**
   * Clean the input
   */
  public static function escape($input)
  {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
  }

  public static function selected($selected, $current = true, $show = true)
  {
    return self::checkedSelectedResult($selected, $current, $show, 'selected');
  }

  public static function checked($checked, $current = true, $show = true)
  {
    return self::checkedSelectedResult($checked, $current, $show, 'checked');
  }

  private static function checkedSelectedResult($helper, $current, $show, $type)
  {
    if ((string)$helper === (string)$current) {
      $result = " $type='$type'";
    } else {
      $result = '';
    }

    if ($show) {
      echo $result;
    }

    return $result;
  }

  /**
   * Make a string URL ready
   *
   * @param string $string
   *   The string to convert
   *
   * @return string
   *   URL ready string
   */
  public static function slug($string)
  {
    $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    $string = preg_replace("%[^-/+|\w ]%", '', $string);
    $string = strtolower(trim($string));
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    return $string;
  }

  public static function selectFromJson($json, $selected = '', $id = '', $name = '')
  {
    if (file_exists($json)) {

      $file     = file_get_contents($json);
      $get_json = json_decode($file);

      foreach ($get_json as $arr) {

        foreach ($arr as $key => $value) {
          $array[$key] = $value;
        }
      }

      $output = '<select class="select-box" id="'.$id.'" name="'.$name.'">';

      for ($i = 0, $c = count($array); $i < $c; $i++) {
        $output .= '<option value="'.lcfirst($array[$i]).'" '.self::selected($selected, lcfirst($array[$i]), false).'>'.$array[$i].'</option>';
      }

      $output .= '</select>';

      return $output;
    } else {
      return false;
    }
  }

  public static function selectDate($selected_day = '', $selected_month = '', $selected_year = '')
  {
    $day = '<select class="select-box" id="day" name="day">';

    for ($i = 1; $i <= 31; $i++) {
        $days[] = $i;
      }

    foreach ($days as $id => $item) {
      $day .= '<option value="'.$item.'" '.self::selected($selected_day, $item, false).'>'.$item.'</option>';
    }
    $day .= '</select>';

    $month = '<select class="select-box" id="month" name="month">';

    $months = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    foreach ($months as $id => $item) {

      if ($id == 0) continue;

      $month .= '<option value="'.$id.'" '.self::selected($selected_month, $id, false).'>'.$item.'</option>';
    }

    $month .= '</select>';

    $year = '<select class="select-box" id="year" name="year">';
    $current_year = date('Y');
    $start_year = $current_year - 50;

    for ($i = $start_year; $i <= $current_year; $i++) {
      $years[] = $i;
    }

    foreach ($years as $id => $item) {
      $year .= '<option value="'.$item.'" '.self::selected($selected_year, $item, false).'>'.$item.'</option>';
    }
    $year .= '</select>';

    $output = $day . $month . $year;

    return $output;
  }

  public static function isEmail( $string ) {
    if (preg_match("/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/", $string)) {
      return true;
    } else {
      return false;
    }
  }
}
