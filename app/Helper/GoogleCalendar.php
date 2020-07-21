<?php
namespace App\Helper;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendar
{
    public static function add($data){
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar');
        // $client->setScopes(Google_Service_Calendar::CALENDAR);
        $scopes = implode(' ', array(Google_Service_Calendar::CALENDAR, Google_Service_Calendar::CALENDAR_EVENTS));
        $client->setScopes($scopes);
        $client->setSubject('contact@npcsolution.com');
        $client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json'));

        $event = new Google_Service_Calendar_Event(array(
            'summary' => $data['summary'],
            'location' => $data['location'],
            'description' => $data['description'],
            'start' => array(
              'dateTime' => $data['startdate'],
              'timeZone' => 'Asia/Bangkok',
            ),
            'end' => array(
              'dateTime' => $data['enddate'],
              'timeZone' => 'Asia/Bangkok',
            ),
            // 'recurrence' => array(
            //   'RRULE:FREQ=DAILY;COUNT=1'
            // ),
            'reminders' => array(
              'useDefault' => FALSE,
              'overrides' => array(
                array('method' => 'email', 'minutes' => 24 * 60),
                array('method' => 'popup', 'minutes' => 10),
              ),
            ),
          ));
          $service = new Google_Service_Calendar($client);
          $calendarId = env('GOOGLE_CALENDAR_ID');
          $event = $service->events->insert($calendarId, $event);
          $_event = new Google_Service_Calendar_Event(array(
            'attendees' => $data['attendees']
          ));
          $eventId =  $event->id;
          $event = $service->events->patch(
                $calendarId, 
                $eventId, 
                $_event, 
            ['sendUpdates' => 'all']
          );

          $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
          );
          $results = $service->events->listEvents($calendarId, $optParams);
          $events = $results->getItems();
          return $events;
    } 
    public static function get(){
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar');
        $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
        $client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json'));
        $service = new Google_Service_Calendar($client);
        $calendarId = env('GOOGLE_CALENDAR_ID');
        $optParams = array(
                'maxResults' => 10,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();
        return $events;
    } 
}