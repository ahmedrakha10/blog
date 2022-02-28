<?php

namespace App\Console\Commands;

use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Http as HttpAlias;

class GetGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'list of genres from TMDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get(config('services.tmdb.url') . '/genre/movie/list?api_key=' . config('services.tmdb.api_key'));
        foreach ($response->json()['genres'] as $genre) {
            Genre::create([
                              'name' => $genre['name']
                          ]);
        }
    }//End of handle
}//End of class
