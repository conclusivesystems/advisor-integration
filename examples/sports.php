<?php
namespace App\Http\Controllers\IntegrationLibrary;
use App\Http\Controllers\Controller;
use Consys\Advisor\Integration\Writer\XML;
use Consys\Advisor\Integration\Response;
class AdvisorIntegrationController extends Controller
{
//Here we build up a complete Course Catalog file/stream.
    public function getSports()
    {
        $writer = new XML();
        $response = new Response($writer);
        $sports = $response->addSports();
        //You can loop over as many sports as you offer.
        //This is an optional look-up table, so that a UserSport can have a title derived by the 'code' attribute.
        $sport = $sports->addSport([
            'code' => "FB",
            'title' => "Football",
        ]);
//Be sure to save each sport individually!
        $sport->save();
//Then save the set of sports.
        $sports->save();
//The last act is to finalize the response.
        $response->save();
    }
}
