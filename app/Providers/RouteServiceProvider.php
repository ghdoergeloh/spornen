<?php

namespace App\Providers;

use App\Domain\Model\Auth\User;
use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;
use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot()
	{
		//

		parent::boot();

		Route::bind('runpart', function ($runId) {
			$user = Auth::user();
			return RunParticipation::where('sponsored_run_id', $runId)->where('user_id', $user->id)->first();
		});
		Route::bind('sponsor', function ($sponsorId) {
			$user = Auth::user();
			return Sponsor::where('id', $sponsorId)->where('user_id', $user->id)->first();
		});
		Route::model('user', User::class);
		Route::model('sponrun', SponsoredRun::class);
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map()
	{
		$this->mapApiRoutes();

		$this->mapWebRoutes();

		//
	}

	/**
	 * Define the "web" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapWebRoutes()
	{
		Route::middleware('web')
				->namespace($this->namespace)
				->group(base_path('routes/web.php'));
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes()
	{
		Route::prefix('api')
				->middleware('api')
				->namespace($this->namespace)
				->group(base_path('routes/api.php'));
	}

}
