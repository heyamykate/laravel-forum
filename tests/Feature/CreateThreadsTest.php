<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class CreateThreadsTest extends TestCase
{
   /** @test */
   function guests_may_not_create_threads()
   {
       $this->withExceptionHandling();

       $this->get('/threads/create')
            ->assertRedirect('/login');

       $this->post('/threads')
            ->assertRedirect('/login');
   }

    /** @test */
   function an_authenticated_user_can_create_new_forum_threads()
   {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
   }

   /** @test */
   function a_thread_requires_a_title()
   {
       $this->withExceptionHandling();

       $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
   }

   /** @test */
   function a_thread_requires_a_body()
   {
       $this->withExceptionHandling();

       $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
   }

   /** @test */
   function a_thread_requires_a_valid_channel()
   {
       $this->withExceptionHandling();

       $channels = factory('App\Channel', 2)->create();

       $this->publishThread(['channel_id' => 1])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');

   }

   public function publishThread($overrides = [])
   {
       $this->signIn();

       $thread =  make('App\Thread', $overrides);

       return $this->post('/threads', $thread->toArray());
   }

}
