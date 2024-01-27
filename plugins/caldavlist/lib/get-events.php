<?php
include 'simpleCalDAV/SimpleCalDAVClient.php';

function &accessByReference($path, &$array)
{

    if (empty($path)) {
        return $array;
    }

    $paths = explode(".", $path);

    $ref = &$array;
    foreach ($paths as $p) {
        $ref = &$ref[$p];
    }
    return $ref;
}

/**
 * @param $url
 * @param $auth_user
 * @param $password
 * @param $calendar
 * @return array
 * @throws CalDAVException
 */
function getEvents($url, $auth_user, $password, $calendar)
{
    $client = new SimpleCalDAVClient();
    $client->connect($url, $auth_user, $password);

    $calendar_url = preg_replace('/https?:\/\/.+?(?=\/)/', '', $url);
    if (substr($calendar_url, -1) == '/') {
        $client->SetCalendar(new CalDAVCalendar($calendar_url . $calendar));
    } else {
        $client->SetCalendar(new CalDAVCalendar($calendar_url . '/' . $calendar));
    }
    $events = [];

    $lastYearDecember = new DateTime();
    $lastYearDecember->setDate(intval($lastYearDecember->format('Y') - 1), 12, 1);
    $lastYearDecember->setTime(0, 0, 0);

    foreach ($client->GetEvents($lastYearDecember->format('Ymd\THis\Z')) as $event) {

        $eventData = $event->getData();
        $eventLines = explode("\n", $eventData);

        $event = [];

        $edit = &$event;
        $tree = [];

        foreach ($eventLines as $line) {

            // remove strange formatting from caldav lib (used for parsing)

            $line = str_replace("\\n", "\n", $line);
            $line = str_replace("\\;", ";", $line);
            $line = str_replace("\\,", ",", $line);
            $line = stripslashes($line);


            if (strpos($line, "BEGIN:") === 0) {
                $key = str_replace("BEGIN:", "", $line);
                $edit[$key] = [];

                $edit = &$edit[$key];

                $tree[] = $key;

            } else if (strpos($line, "END:") === 0) {
                array_pop($tree);
                $edit = &accessByReference(join('.', $tree), $event);
            } else {
                $slices = explode(":", $line, 2);

                if (count($slices) !== 2) {
                    continue;
                }

                list($k, $v) = $slices;
                if (!empty($k)) {
                    if (!empty($edit[$k])) {
                        if (!is_array($edit[$k])) {
                            $tmp = $edit[$k];
                            $edit[$k] = [$tmp];
                        }
                        $edit[$k][] = $v;
                    } else {
                        $edit[$k] = $v;
                    }
                }
            }
        }

        // Thunderbird Lightning, Nextcloud inconsistency bug fix
        $event_category_field = &$event['VCALENDAR']['VEVENT']['CATEGORIES'];
        if (!empty($event_category_field) && !is_array($event_category_field)) {
            $arr = explode(',', $event_category_field);
            if (count($arr) > 1) {
                $event_category_field = $arr;
            }
        }

        $events[] = $event;
    }

    return $events;
}