<?php

declare(strict_types=1);

use App\Application\Actions\Attractions\AddAttractionsAction;
use App\Application\Actions\Attractions\DeleteAttractionsAction;
use App\Application\Actions\Attractions\DeleteCitiesAction;
use App\Application\Actions\Attractions\GetAttractionsAction;
use App\Application\Actions\Attractions\UpdateAttractionsAction;
use App\Application\Actions\Attractions\UpdateCitiesAction;
use App\Application\Actions\Attractions\ViewAttractionsAction;
use App\Application\Actions\Cities\AddCitiesAction;
use App\Application\Actions\Cities\GetCitiesAction;
use App\Application\Actions\Cities\GetTravelersVisitedCitiesAction;
use App\Application\Actions\Cities\ViewCitiesAction;
use App\Application\Actions\Ratings\AddRatingsAction;
use App\Application\Actions\Ratings\GetRatingByAttractionsAction;
use App\Application\Actions\Ratings\GetRatingByTravelersAction;
use App\Application\Actions\Travelers\AddTravelersAction;
use App\Application\Actions\Travelers\GetTravelersAction;
use App\Application\Actions\Travelers\GetTravelersByCitiesAction;
use App\Application\Actions\Travelers\ViewTravelersAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/travelers', function (Group $group) {
        $group->get('', GetTravelersAction::class);
        $group->post('', AddTravelersAction::class);
        $group->get('/{id}', ViewTravelersAction::class);
        $group->delete('/{id}', DeleteAttractionsAction::class);
        $group->post('/{id}', UpdateAttractionsAction::class);
        $group->get('/{id}/visited-cities', GetTravelersVisitedCitiesAction::class);
    });

    $app->group('/cities', function (Group $group) {
        $group->get('', GetCitiesAction::class);
        $group->post('', AddCitiesAction::class);
        $group->get('/{id}', ViewCitiesAction::class);
        $group->delete('/{id}', DeleteCitiesAction::class);
        $group->post('/{id}', UpdateCitiesAction::class);
        $group->get('/{id}/travelers', GetTravelersByCitiesAction::class);
    });

    $app->group('/attractions', function (Group $group) {
        $group->get('', GetAttractionsAction::class);
        $group->post('', AddAttractionsAction::class);
        $group->get('/{id}', ViewAttractionsAction::class);
        $group->delete('/{id}', DeleteAttractionsAction::class);
        $group->post('/{id}', UpdateAttractionsAction::class);
    });

    $app->group('/ratings', function (Group $group) {
        $group->post('', AddRatingsAction::class);
        $group->get('/attraction/{id}', GetRatingByAttractionsAction::class);
        $group->get('/traveler/{id}', GetRatingByTravelersAction::class);
    });
};
