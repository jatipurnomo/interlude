<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    private string $channelId;

    public function __construct()
    {
        $this->channelId = (string) config('services.youtube.channel_id', '');
    }

    /**
     * Get the latest videos from the channel via RSS feed.
     *
     * @return array<int, array{id: string, title: string, thumbnail: string, published_at: string, embed_url: string}>
     */
    public function getLatestVideos(int $limit = 6): array
    {
        if ($this->channelId === '') {
            return [];
        }

        try {
            $url = "https://www.youtube.com/feeds/videos.xml?channel_id={$this->channelId}";
            $response = Http::timeout(10)->get($url);

            if ($response->failed()) {
                return [];
            }

            return $this->parseFeed($response->body(), $limit);
        } catch (\Exception $e) {
            Log::error('YouTube RSS error: '.$e->getMessage());

            return [];
        }
    }

    private function parseFeed(string $xml, int $limit): array
    {
        $xml = simplexml_load_string($xml);

        if ($xml === false) {
            return [];
        }

        $videos = [];
        $entries = $xml->entry ?? [];

        foreach ($entries as $entry) {
            if (count($videos) >= $limit) {
                break;
            }

            $mediaGroup = $entry->children('media', true)->group ?? null;
            $videoId = (string) ($entry->children('yt', true)->videoId ?? '');

            if ($videoId === '') {
                continue;
            }

            $thumbnail = '';
            if ($mediaGroup?->thumbnail) {
                $thumbnail = (string) $mediaGroup->thumbnail[0]['url'];
            }

            $videos[] = [
                'id' => $videoId,
                'title' => (string) ($entry->title ?? ''),
                'thumbnail' => $thumbnail,
                'published_at' => (string) ($entry->published ?? ''),
                'embed_url' => "https://www.youtube.com/embed/{$videoId}",
            ];
        }

        return $videos;
    }
}
