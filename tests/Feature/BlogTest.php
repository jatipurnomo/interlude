<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlogTest extends TestCase
{
    public function test_blog_page_displays_coming_soon_message(): void
    {
        $response = $this->get('/blog');

        $response->assertOk()
            ->assertSee('Interlude Blog')
            ->assertSee('Coming Soon')
            ->assertSee('Catatan, cerita, dan gagasan dari dunia buku sedang kami siapkan untuk Anda.')
            ->assertSee('href="'.route('blog').'"', false)
            ->assertSee('aria-current="page"', false);
    }
}
