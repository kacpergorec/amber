<?php

namespace Tests\Feature\Post;

use App\Enums\PostBulkActionType;
use App\Handlers\PostBulkOperator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Livewire\Volt\Volt;
use Tests\TestCase;

class PostIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_post_table(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('posts.index'))
            ->assertStatus(200)
            ->assertSeeVolt('post.table');
    }

    public function test_can_delete_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(
            ['author_id' => $user->id]
        );

        $this->assertDatabaseHas('posts', ['id' => $post->id]);

        $this->actingAs($user)
            ->get(route('posts.index'));

        Livewire::test('post.table')
            ->call('deletePostConfirm', $post->id)
            ->assertOk();

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_pagination_and_sorting_works(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(30)->create(['author_id' => $user->id]);

        Livewire::test('post.table')
            // test per page 10 and sort by title
            ->call('setPerPage', 10)
            ->call('sortBy', 'title')
            ->assertViewHas(
                'posts',
                Post::with('author')
                    ->leftJoin('users as author', 'posts.author_id', '=', 'author.id')
                    ->select('posts.*')
                    ->orderBy('id')
                    ->orderBy('title')
                    ->paginate(10)
            )
            // test reversing sort
            ->call('sortBy', 'title')
            ->assertViewHas(
                'posts',
                Post::with('author')
                    ->leftJoin('users as author', 'posts.author_id', '=', 'author.id')
                    ->select('posts.*')
                    ->orderBy('id')
                    ->orderBy('title', 'desc')
                    ->paginate(10)
            )
            // test per page 100 and sort by reverse content
            ->call('sortBy', 'content')
            ->call('sortBy', 'content')
            ->call('setPerPage', 100)
            ->assertViewHas(
                'posts',
                Post::with('author')
                    ->leftJoin('users as author', 'posts.author_id', '=', 'author.id')
                    ->select('posts.*')
                    ->orderBy('id')
                    ->orderBy('content', 'desc')
                    ->paginate(100)
            )
        ;

        // test if page 2 has correct data
        Livewire::test('post.table')
            ->call('setPerPage', 10)
            ->call('sortBy', 'title')
            ->call('gotoPage', 2)
            ->assertViewHas(
                'posts',
                Post::with('author')
                    ->leftJoin('users as author', 'posts.author_id', '=', 'author.id')
                    ->select('posts.*')
                    ->orderBy('id')
                    ->orderBy('title')
                    ->paginate(10, ['*'], 'page', 2)
            );
    }

    public function test_can_select_posts(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(30)->create(['author_id' => $user->id]);

        // test if selectAll works
        Livewire::test('post.table')
            ->call('selectAll')
            ->assertSet('selectedItems', Post::pluck('id')->toArray())
            ->call('selectAll')
            ->assertSet('selectedItems', []);

        // test if selectAll on page works
        Livewire::test('post.table')
            // test selecting first 10
            ->call('setPerPage', 10)
            ->call('selectAll', 1)
            ->assertSet('selectedItems',
                Post::orderBy('posts.id')
                    ->paginate(10)
                    ->pluck('id')
                    ->toArray()
            )
            // test selecting up to 20
            ->call('gotoPage', 2)
            ->call('selectAll', 2)
            ->assertSet('selectedItems',
                Post::orderBy('posts.id')
                    ->paginate(10, ['*'], 'page', 1)
                    ->pluck('id')
                    ->merge(
                        Post::orderBy('posts.id')
                            ->paginate(10, ['*'], 'page', 2)
                            ->pluck('id')
                    )
                    ->toArray()
            )
            // test deselecting page 1
            ->call('gotoPage', 1)
            ->call('selectAll', 1)
            ->assertSet('selectedItems',
                Post::orderBy('posts.id')
                    ->paginate(10, ['*'], 'page', 2)
                    ->pluck('id')
                    ->toArray()
            );
    }

    public function test_can_handle_bulk_actions(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(30)->create(['author_id' => $user->id]);

        //select delete first item
        $firstPostId = Post::first()->id;
        Livewire::test('post.table')
            ->set('selectedItems', [$firstPostId])
            ->call('tableSelectionAction', PostBulkActionType::DELETE)
            ->assertSet('selectedItems', []);;
        $this->assertDatabaseMissing('posts', ['id' => $firstPostId]);

        //select first page
        Livewire::test('post.table')
            ->call('setPerPage', 10)
            ->call('selectAll', 1)
            ->assertSet('selectedItems',
                Post::orderBy('posts.id')
                    ->paginate(10)
                    ->pluck('id')
                    ->toArray()
            );

        //delete selected
        Livewire::test('post.table')
            ->call('tableSelectionAction', PostBulkActionType::DELETE)
            ->assertSet('selectedItems', []);
    }
}
