<?php
namespace App\Http\Controllers\IntegrationLibrary;
use App\Http\Controllers\Controller;
use Consys\Advisor\Integration\Writer\JSON;
use Consys\Advisor\Integration\Response;
class AdvisorIntegrationController extends Controller
{
//Here we build up a complete Course Schedules file/stream.
    public function getSchedule()
    {
        $writer = new JSON();
        $response = new Response($writer);
        $schedule = $response->addSchedule();
//You can loop over as many scheduled courses as you wish.
        $course = $schedule->addCourse([
            'term_year' => 2019,
            'term_code' => "fall",
            'prefix' => "math",
            'number' => "101",
            'suffix' => "",
            'seats' => 50,
            'min_credits' => 3,
            'max_credits' => 3,
            'instructor' => "Joe Professor",
            'start_date' => "2019-09-12",
            'end_date' => "2019-12-19",
            'url' => "https://some.course.university.edu",
        ]);
//You can loop over as many meetings for each scheduled course as you wish.
//You need a different meeting for each day/time or any other such changes.
        $course->addMeeting([
            'room' => "Building 3, Room 200",
            'day' => "m",
            'start_time' => "13:00:00",
            'end_time' => "14:50:00",
        ]);
        $course->addMeeting([
            'room' => "Building 3, Room 200",
            'day' => "w",
            'start_time' => "13:00:00",
            'end_time' => "14:50:00",
        ]);
        $course->addMeeting([
            'room' => "Building 3, Room 200",
            'day' => "f",
            'start_time' => "13:00:00",
            'end_time' => "14:50:00",
        ]);
//Be sure to save each scheduled course individually!
        $course->save();
//Save/finalize the schedule.
        $schedule->save();
//The last act is to save/finalize the schedule response.
        $response->save();
    }
}
