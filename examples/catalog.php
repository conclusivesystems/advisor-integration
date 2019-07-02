<?php
namespace App\Http\Controllers\IntegrationLibrary;
use App\Http\Controllers\Controller;
use Consys\Advisor\Integration\Writer\JSON;
use Consys\Advisor\Integration\Response;
class AdvisorIntegrationController extends Controller
{
//Here we build up a complete Course Catalog file/stream.
    public function getCatalog()
    {
        $writer = new JSON();
        $response = new Response($writer);
        $catalog = $response->addCatalog();
//You can loop over as many courses as are in your course-offerings list.
        $course = $catalog->addCourse([
            'id' => "5673992",
            'prefix' => "math",
            'number' => "101",
            'suffix' => "",
            'title' => "College Algebra",
            'min_credits' => 3,
            'max_credits' => 3,
            'credit_type' => "S",
            'archived' => "n",
            'level' => "1",
            'url' => "https://some.course-description.some-school.edu",
            'option1' => "1",
        ]);
//Be sure to save each course individually!
        $course->save();
//After all courses, save the entire catalog.
        $catalog->save();
//The last act is to finalize the response.
        $response->save();
    }
}
