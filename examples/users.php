<?php
namespace App\Http\Controllers\IntegrationLibrary;
use App\Http\Controllers\Controller;
use Consys\Advisor\Integration\Writer\XML;
use Consys\Advisor\Integration\Response;
class AdvisorIntegrationController extends Controller
{
//Here we build up a complete Users file/stream, including related data.
    public function getUsers()
    {
        $writer = new XML();
        $response = new Response($writer);
        $options = $response->addOptions([
            'current_term_year'=>2019,
            'current_term_period'=>"fall",
        ]);
/*Do NOT do the changeUserGroups option unless you really do want to change all of the
users in the specified groups to be in the new group! This is an example ONLY! */
        $options->changeUserGroups([
            "Student",
            "ProspectiveStudent",
        ],
            "archived");
        $options->save();
        $users = $response->addUsers();
        $user = $users->addUser([
            'id' => "320848913",
            'user_type' => "Advisor",
            'username' => "A320848913",
            'name_first' => "Joe",
            'name_last' => "Advisor",
        ]);
//You can loop over advisees for as many as you assign to this advisor.
        $user->addAdvisee([
            'id'=>"44329927",
            'primary'=>"yes",
            'display'=>"yes",
        ]);
//Be sure you call $user->save() for each user!
        $user->save();
        $user = $users->addUser([
            'id' => "44329927",
            'user_type' => "Student",
            'username' => "S44329927",
            'name_first' => "Joe",
            'name_last' => "Student",
            'courses' => 20,
            'credits' => 60,
            'gpa' => "3.78",
            'option1' => "Sophomore",
        ]);
//You can loop over goals for as many goals are in the SIS for this user.
        $goal = $user->addGoal([
            'id' => "438972",
            'type' => "official",
            'flag' => "declared",
        ]);
//You can loop over groups for as many as compose a goal.
        $group = $goal->addGroup();
//You can loop over programs for as many as uniquely comprise a group.
        $group->addProgram([
            'type' => "year",
            'program' => "2019",
        ]);
        $group->addProgram([
            'type' => "degree",
            'program' => "BA",
        ]);
        $group->addProgram([
            'type' => "major",
            'program' => "Math",
        ]);
//You can loop over transcript courses for as many as this student has.
        $user->addCourse([
            'id' => "88573",
//course_id should be the catalog course id
            'course_id' => "5673992",
            'prefix' => "math",
            'number' => "101",
            'suffix' => "",
            'title' => "College Algebra",
            'grade' => "A-",
            'grade_type' => "A-F",
            'grade_suppressed' => "n",
            'status' => "C",
            'level' => "1",
            'credits' => "3",
            'credit_type' => "S",
            'transfer' => "n",
            'transfer_code' => "NT",
            'transfer_text' => "",
            'term_year' => "2018",
            'term_period' => "fall",
            'repeat' => "n",
            'option1' => "1",
        ]);
//You can loop over athletics for as many as this student has.
        $user->addSport([
            'code' => "FB",
            'year' => "2018",
            'term' => "fall",
        ]);
//You can loop over milestones for as many as this student has.
        $user->addMilestone([
            'id' => "1",
            'name' => "Example Milestone",
            'description' => "A Milestone to show how it is added",
            'status' => "C",
            'option1' => "whatever1",
            'option2' => "whatever2",
            'option3' => "whatever3",
            'option4' => "whatever4",
            'option5' => "whatever5",
            'option6' => "whatever6",
            'option7' => "whatever7",
            'option8' => "whatever8",
            'option9' => "whatever9",
            'option10' => "whatever10",
            'option11' => "whatever11",
            'option12' => "whatever12",
            'option13' => "whatever13",
            'option14' => "whatever14",
            'option15' => "whatever15",
        ]);
        $user->addTestScore([
            'name' => 'Example Test',
            'score' => '92',
            'taken_at' => '03-26-2025',
            'option1' => 'whatever',
            'option2' => 'whatever',
            'option3' => 'whatever',
            'option4' => 'whatever',
            'option5' => 'whatever',
            'option6' => 'whatever',
            'option7' => 'whatever',
            'option8' => 'whatever',
            'option9' => 'whatever',
            'option10' => 'whatever',
            'option11' => 'whatever',
            'option12' => 'whatever',
            'option13' => 'whatever',
            'option14' => 'whatever',
            'option15' => 'whatever',
        ]);
//You can loop over messages for as many messages as you want this user to see.
        $user->addMessage([
            'type' => "Info",
            'message' => "You are a Sophomore now!",
        ]);
//Be sure you call $user->save() for each user!
        $user->save();
//Save the entire users object.
        $users->save();
//The last act is to finalize the response.
        $response->save();
    }
}
