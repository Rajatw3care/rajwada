<?php

use App\Models\BlogPost;

function blogResultsListTitles(string $html): array
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    // token-exact match: 'blog-list' must not also match 'blog-list-page'
    $list = $xpath->query("//div[contains(concat(' ', normalize-space(@class), ' '), ' blog-list ')]")->item(0);
    if (! $list) {
        return [];
    }

    $titles = [];
    foreach ($xpath->query(".//article[contains(@class,'blog-card')]//h3", $list) as $node) {
        $titles[] = trim($node->textContent);
    }

    return $titles;
}

test('blog search matches by title', function () {
    BlogPost::factory()->create(['title' => 'Real Wedding at Lalgarh Palace', 'is_active' => true]);
    BlogPost::factory()->create(['title' => 'Planning Your Sangeet Night', 'is_active' => true]);

    $response = $this->get(route('blogs', ['q' => 'Lalgarh']))->assertOk();

    // Scope to the filtered results list — "Planning Your Sangeet Night" is
    // allowed to still appear in the unfiltered "Recent Posts" sidebar widget.
    $titles = blogResultsListTitles($response->getContent());

    expect($titles)->toContain('Real Wedding at Lalgarh Palace');
    expect($titles)->not->toContain('Planning Your Sangeet Night');
});

test('blog search matches by venue', function () {
    BlogPost::factory()->create(['title' => 'A Destination Celebration', 'venue' => 'Lalgarh Palace, Bikaner', 'is_active' => true]);
    BlogPost::factory()->create(['title' => 'A City Celebration', 'venue' => 'Udaipur', 'is_active' => true]);

    $response = $this->get(route('blogs', ['q' => 'Bikaner']))->assertOk();

    $titles = blogResultsListTitles($response->getContent());

    expect($titles)->toContain('A Destination Celebration');
    expect($titles)->not->toContain('A City Celebration');
});

test('blog search shows a no-results message when nothing matches', function () {
    BlogPost::factory()->create(['title' => 'A Real Post', 'is_active' => true]);

    $response = $this->get(route('blogs', ['q' => 'zzz-no-match-zzz']));

    $response->assertOk();
    $response->assertSee('No articles matched');
});

test('blog search box retains the typed query', function () {
    BlogPost::factory()->create(['is_active' => true]);

    $response = $this->get(route('blogs', ['q' => 'sangeet']));

    $response->assertSee('value="sangeet"', false);
});
