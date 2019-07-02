<?php
namespace App\Http\Controllers\IntegrationLibrary;
use App\Http\Controllers\Controller;
use Consys\Advisor\Integration\Writer\JSON;
use Consys\Advisor\Integration\Response;
class AdvisorIntegrationController extends Controller
{
//Here we build up a complete Equivalencies file/stream.
    public function getEquivalencies()
    {
        $writer = new JSON();
        $response = new Response($writer);
        $equivalencies = $response->addEquivalencies();
//You can loop over as many course equivalencies as you wish.
        $equivalency = $equivalencies->addEquivalency([
            'original_course_id' => '5673992',
            'original_course_prefix' => 'math',
            'original_course_number' => '101',
            'original_course_suffix' => '',
            'target_course_id' => '2445873',
            'target_course_prefix' => 'math',
            'target_course_number' => '1',
            'target_course_suffix' => '',
            'start_term_year' => '1995',
            'start_term_code' => 'fall',
            'end_term_year' => '2022',
            'end_term_code' => 'fall',
            'notes' => 'College Algebra changed number',
            'program_code' => '',
            'program_type_code' => '',
            'course_option1_value' => '1',
        ]);
//Be sure to save each equivalency individually!
        $equivalency->save();
//Save/finalize the equivalencies.
        $equivalencies->save();
//The last act is to finalize the response.
        $response->save();
    }
}
