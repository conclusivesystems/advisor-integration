<?php
namespace App\Http\Controllers\IntegrationLibrary;
use App\Http\Controllers\Controller;
use Consys\Advisor\Integration\Writer\JSON;
use Consys\Advisor\Integration\Response;
class AdvisorIntegrationController extends Controller
{
//Here we build up a complete Prerequisites file/stream.
    public function getPrerequisites()
    {
        $writer = new JSON();
        $response = new Response($writer);
        $prerequisites = $response->addPrerequisites();
//You can loop over as many prerequisite relationships as you wish.
        $prerequisite = $prerequisites->addPrerequisite();
//Each prereq relationship is anchored to ONE 'target' course.
//The 'target' course has the prereqs/coreqs that must be taken first/concurrently.
        $prerequisite->addTarget([
            'key' => "5673992",
            'prefix' => "math",
            'number' => "101",
            'suffix' => "",
        ]);

//Now we add 'criteria,' which are what must be done prior to or concurrently with taking the 'target' course. The criteria object can contain a single courselist or a single requirement.
        $criteria = $prerequisite->addCriteria();
//The data in the array passed into addCourseList is all optional.
        $courselist = $criteria->addCourseList([]);
        $courselist->addCourse([
            'coreq' => "n",
            'key' => "3934522",
            'prefix' => "math",
            'number' => "100",
            'suffix' => "",
        ]);
//Be sure to save each prerequisite relationship.
        $prerequisite->save();

//We do a second prereq relationship
        $prerequisite = $prerequisites->addPrerequisite();
        $prerequisite->addTarget([
            'key' => "348274",
            'prefix' => "math",
            'number' => "025",
            'suffix' => "",
        ]);
        $criteria = $prerequisite->addCriteria();
//The data in the array passed into addRequirement is all optional.
        $requirement= $criteria->addRequirement([]);
        $requirement->addParameter([
            'type' => "student",
            'field' => "option5",
            'operator' => "=",
            'value' => "yes",
        ]);
        $requirement->addParameter([
            'type' => "student",
            'field' => "option6",
            'operator' => "!=",
            'value' => "no",
        ]);
        $children = $requirement->addChildren([
            'relationship' => "min",
            'min_number' => 2,
        ]);
        $courselist = $children->addCourseList([]);
        $courselist->addParameter([
            'type' => "course",
            'field' => "option5",
            'operator' => "=",
            'value' => "yes",
        ]);
        $courselist->addParameter([
            'type' => "student",
            'field' => "option1",
            'operator' => "=",
            'value' => "",
        ]);
        $courselist->addCourse([
            'coreq' => "y",
            'key' => "*",
            'prefix' => "*",
            'number' => "100-199",
            'suffix' => "*",
        ]);

        $courselist = $children->addCourseList([]);
        $courselist->addCourse([
            'coreq' => "n",
            'key' => "348270",
            'prefix' => "math",
            'number' => "010",
            'suffix' => "",
        ]);

        $courselist = $children->addCourseList([]);
        $courselist->addCourse([
            'coreq' => "n",
            'key' => "348272",
            'prefix' => "math",
            'number' => "015",
            'suffix' => "",
        ]);

//Be sure to save each prerequisite relationship.
        $prerequisite->save();

//Save/finalize the prerequisites.
        $prerequisites->save();

//The last act is to save/finalize the response.
        $response->save();
    }
}
