<?php

namespace App\Providers;

use App\Domain\Model\Auth\User;
use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;
use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Zizaco\Entrust\Entrust;
use function base_path;

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

		Route::bind('runpart', function ($runpartId) {
			if (!Auth::check())
				return;
			$runpart = RunParticipation::find($runpartId);
			if (is_null($runpart))
				return;
			if (Auth::user()->hasRole('admin'))
				return $runpart;
			if ($runpart->user == Auth::user())
				return $runpart;
		});
		Route::bind('run', function ($runHash) {
			$runpart = RunParticipation::where('hash',$runHash)->first();
			if (is_null($runpart))
				return;
			return $runpart;
		});
		Route::bind('sponsor', function ($sponsorId) {
			if (!Auth::check())
				return;
			$sponsor = Sponsor::find($sponsorId);
			if (is_null($sponsor))
				return;
			if (Auth::user()->hasRole('admin'))
				return $sponsor;
			if ($sponsor->user == Auth::user())
				return $sponsor;
		});
		Route::bind('user', function ($userId) {
			if (!Auth::check())
				return;
			$user = Sponsor::find($userId);
			if (is_null($user))
				return;
			if (Auth::user()->hasRole('admin'))
				return $user;
			if ($user == Auth::user())
				return $user;
		});
		Route::bind('sponrun', function ($sponrunId) {
			return SponsoredRun::withCount('participants')->find($sponrunId);
		});
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
