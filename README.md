![screenshot](https://user-images.githubusercontent.com/11954286/85945043-a41f5980-b958-11ea-9103-502db0fbade9.jpg)

# Laravel Movies

This Movie application similar to IMDB (basic features only) is developed using a new stack with better UI.

### Technology Used

1. Laravel 7

    1.1 Laravel Components
    1.2 Laravel View Models
    1.3 Livewire

2. Alpine.js
3. TMDB APIs

## Installation

1. Clone the repo and `cd` into it.
2. `composer install`.
3. Rename or copy `.env.example` file to `.env`.
4. Set your `TMDB_TOKEN` in your `.env` file. You can get an API key [here](https://www.themoviedb.org/documentation/api). Make sure to use the "API Read Access Token (v4 auth)" from the TMDb dashboard.
5. `php artisan key:generate`.
6. `php artisan serve` or use Laravel Valet or Laravel Homestead.
7. Visit `localhost:8000` in your browser.

## Future Plans

1. Add capability to search for TV Series, Actors etc.
2. User Authentication.
3. Create User Favourites Section.
4. To Watch section.
5. Notify new relased movies by email.
