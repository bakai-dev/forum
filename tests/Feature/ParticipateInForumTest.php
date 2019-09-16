<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');


        $this->post('/threads/1/replies', []);

    }


    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = factory(User::class)->create());

        $thread = create(Thread::class);

        $reply = create(Reply::class);

        $this->post($thread->path().'/replies', $reply->toArray());



        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
