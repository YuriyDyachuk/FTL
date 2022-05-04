<?php


namespace Tests\Feature\LoginPage;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Runner\Exception;
use Session;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use DatabaseTransactions;

    public function testLoginPageAvailable()
    {
        $response = $this->get('/login');

        return $response->assertStatus(200);
    }

    public function testCanAuthenticate()
    {
        $user = factory(User::class)->make();
        $response = $this->be($user);
        $user->delete();

        return $response->assertAuthenticated();
    }

    public function testRedirectAfterLogin()
    {
        Session::start();
        $user = factory(User::class)->create();
        $response = $this->call('post', '/login',[
            'email' => $user->email,
            'password' => $user->password,
            '_token' => csrf_token()
        ]);
        $user->delete();

        return $response->assertRedirect('/');
    }

}
