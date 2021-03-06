<?php

namespace Tests;

use App\Role;
use App\User;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTest extends BaseTestCase
{
    use CreatesApplication;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://laravel.blog';

    /**
     * Return an admin user
     * @return User $admin
     */
    protected function admin($overrides = [])
    {
        $admin = $this->user($overrides);
        $admin->roles()->attach(factory(Role::class)->states('admin')->create());

        return $admin;
    }

    /**
     * Return an user
     * @return User
     */
    protected function user($overrides = [])
    {
        return factory(User::class)->create($overrides);
    }

    /**
     * Acting as an admin
     */
    protected function actingAsAdmin($api = null)
    {
        $this->actingAs($this->admin(), $api);

        return $this;
    }

    /**
     * Acting as an user
     */
    protected function actingAsUser($api = null)
    {
        $this->actingAs($this->user(), $api);

        return $this;
    }
}
