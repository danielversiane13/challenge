<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    private function createUserAndGivePermission(string $permission = null)
    {
        $user  = User::factory()->create();

        if ($permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
            $user->givePermissionTo($permission);
        }

        return $user;
    }

    public function test_can_access_route_middleware_when_not_has_permission()
    {
        $user = $this->createUserAndGivePermission();

        $response = $this->actingAs($user, 'api')->get('/api/any-route');
        $response->assertStatus(403);
    }

    public function test_can_access_route_middleware_when_has_permission()
    {
        $user = $this->createUserAndGivePermission('any_index');

        $response = $this->actingAs($user, 'api')->get('/api/any-route');
        $response->assertStatus(200);
    }
}
