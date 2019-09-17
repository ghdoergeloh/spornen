<?php
namespace Tests\Feature;

use App\Domain\Model\Auth\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class UserTest extends TestCase
{
	use RefreshDatabase;

	protected function setUp()
	{
		parent::setUp();

		$test = $this;

		TestResponse::macro('followRedirects',
			function ($number = null, $testCase = null) use ($test) {
				$response = $this;
				$testCase = $testCase ?: $test;

				$count = 1;
				$continue = true;
				while ($response->isRedirect() && $continue) {
					$response = $testCase->get($response->headers->get('Location'));
					if ($number != null) {
						$count ++;
						$continue = $count <= $number;
					}
				}
				return $response;
			});
	}

	public function test_app_is_working()
	{
		$response = $this->get('/login');
		$response->assertSuccessful();
	}

	public function test_user_can_register()
	{
		$data = $this->createUserData();
		$response = $this->post('/register', $data);
		$response->assertSessionHasNoErrors();
		$response->followRedirects()->assertViewIs('auth.verify');
		$this->assertCount(1, User::all());
	}

	public function test_user_can_login()
	{
		$user = factory(User::class)->create();
		$user->markEmailAsVerified();
		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'secret'
		]);
		$response->assertSessionHasNoErrors();
		$response->followRedirects()->assertViewIs('home');
	}

	public function test_noauth_user_can_view_login()
	{
		$response = $this->get('/login');
		$response->assertSuccessful();
		$response->assertViewIs('auth.login');
	}

	public function test_auth_user_cannot_view_login()
	{
		$user = factory(User::class)->make();
		$user->markEmailAsVerified();
		$response = $this->actingAs($user)->get('/login');
		$response->assertRedirect();
	}

	public function test_noauth_user_cannot_view_home()
	{
		$response = $this->get('/home');
		$response->assertRedirect();
		$this->actingAs(factory(User::class)->create());
	}

	public function test_auth_user_can_view_home()
	{
		$user = factory(User::class)->make();
		$user->markEmailAsVerified();
		$response = $this->actingAs($user)
			->get('/home')
			->followRedirects();
		$response->assertSuccessful();
		$response->assertViewIs('home');
	}

	public function test_auth_user_without_verified_mail_can_only_view_verify()
	{
		$user = factory(User::class)->make();
		$response = $this->actingAs($user)
			->get('/home')
			->followRedirects();
		$response->assertSuccessful();
		$response->assertViewIs('auth.verify');
	}

	private function createUserData()
	{
		$faker = Factory::create('de_DE');
		$gender = $faker->randomElement([
			'm',
			'f'
		]);
		return [
			'firstname' => $faker->firstName($gender),
			'lastname' => $faker->lastName,
			'street' => $faker->streetName,
			'housenumber' => $faker->buildingNumber,
			'postcode' => $faker->postcode,
			'city' => $faker->city,
			'birthday' => $faker->dateTime->format('Y-m-d'),
			'gender' => $gender,
			'phone' => '+49 2747 52873',
			'email' => $faker->safeEmail,
			'password' => 'secret',
			'password_confirmation' => 'secret'
		];
	}
}
