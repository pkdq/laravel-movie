<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class PersonViewModel extends ViewModel
{
    public $person;
    public $social;
    public $credits;

    public function __construct($person, $social, $credits)
    {
        $this->person = $person;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function person()
    {
        return $this->formatPerson($this->person);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : null,
        ]);
    }

    public function knownForTitles()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take(5)->map(function($title) {

            if (isset($title['title'])) {
                $showTitle = $title['title'];
            } elseif (isset($title['name'])) {
                $showTitle = $title['name'];
            } else {
                $showTitle = 'Untitled';
            }

            return collect($title)->merge([
                'poster_path' => $title['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185' . $title['poster_path']
                    : 'https://via.placeholder.com/300x450',
                'title' => $showTitle,
                'linkToDetailsPage' => $title['media_type'] === 'movie'
                    ? route('movies.show', $title['id'])
                    : route('tv.show', $title['id']),
            ]);
        });
    }

    public function credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie) {
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
            ]);
        })->sortByDesc('release_date');
    }


    private function formatPerson()
    {
        return collect($this->person)->merge([
            'birthday' => Carbon::parse($this->person['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->person['birthday'])->age,
            'profile_path' => $this->person['profile_path']
                ? 'https://image.tmdb.org/t/p/w300' . $this->person['profile_path']
                : 'https://via.placeholder.com/300x450',
        ]);
    }
}
