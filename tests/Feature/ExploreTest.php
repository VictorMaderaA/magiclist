<?php


namespace Tests\Feature;


use App\Models\Activities;
use App\Models\Lists;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ExploreTest extends TestCase
{

    /**
     * @return void
     */
    public function testLoad()
    {
        $response = $this->get(route('explore'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testLoadList()
    {
        self::be(factory(User::class)->create());
        $list = factory(Lists::class)->create([
            'private' => false,
        ]);
        $response = $this->get(route('explore_list', $list->id));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testLoadListPrivate()
    {
        self::be(factory(User::class)->create());
        $list = factory(Lists::class)->create([
            'private' => true,
        ]);
        $response = $this->get(route('explore_list', $list->id));
        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function testLoadActivity()
    {
        self::be(factory(User::class)->create());
        $activity = factory(Activities::class)->create([
            'list_id' => factory(Lists::class)->create([
                'private' => false,
            ])
        ]);
        $response = $this->get(route('explore_activity', $activity->id));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testLoadActivityPrivate()
    {
        self::be(factory(User::class)->create());
        $activity = factory(Activities::class)->create([
            'list_id' => factory(Lists::class)->create([
                'private' => true,
            ])
        ]);

        $response = $this->get(route('explore_activity', $activity->id));
        $response->assertStatus(404);
    }
}
