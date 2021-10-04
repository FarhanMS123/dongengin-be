# DongengIn - Frontend (ReactJS) Source Code

> This Readme is describe DongengIn and Dongengin Backend development status. If you are looking for Backend' Readme and License, please continue to [this page](./README_laravel.md)

## Installation

> You could just skip this section as this project's backend-part has been installed properly. The purposes of this are to describe how to setup the project at first and what modules are used in the development. Please consider to edit to this section whenever you add new modules or restructuring the folders and files.

This project has been build using `composer create-project`, and some modules showed below.

```bash
composer create-project laravel/laravel dongengin-be
```

You could take a look to these documentation

-   https://laravel.com/

## Setting Up

As the project has been built properly, next developer just need to do `npm install` to install all modules needed.

```bash
npm install
```

Let Node Package Manager do its job. The PM would also install `react-scripts` which could executed scripts we need for development.

You may need `.env` configuration whenever you need to setting NodeJS and `react-scripts` behavior, application key (public_key or private_key), or any global variables needed by the app. If you do not like the concept of `.env`, NodeJS and `react-scripts` would do their default behavior, and set configuration variables straight in the `src` folder. The `.env` configuration could be accessed from references below.

Take a look

-   https://create-react-app.dev/docs/available-scripts
-   https://create-react-app.dev/docs/adding-custom-environment-variables
-   https://create-react-app.dev/docs/advanced-configuration

## Entity Relationship Document

## Local Serving (Development Mode)

## Build (Deployment Mode)

## Frontend Integration

In integrating Frontend (ReactJS) to Backend (Laravel), you need the compiled version of ReactJS Project. To complete it, you must build the react project as instructed in it's documentation.

After that, you would get a `build` folder. This folder has all compiled version needed in integrating. To do so, please follow this step:

1. Copy `build` folder to laravel project, and rename it as `public`. You could just remove the `public` folder in Laravel project.
2. Move `index.html` from inside `public` (It is the `build` folder before it is renamed) folder to `resources/views` and rename it as `index.blade.php`.
3. Serve it.

> Note: to see how to serve it, you could see the instruction above.

> Note: In relative path, you may need change all urls using `{{ asset() }}` or `{{ url() }}`. Or you could just serve it via `php artisan serve`.

## Program Workflow

This project's backend is use full of Rest-APIS scheme. The routes and request documentation could be seen in [APIS.md](./APIS.md).

## Features

> There is nothing to see here

## Need to Check

> There is nothing to see here

## Notes

-   Using SUM and Raw:

```
    // config/database.php
    'strict' => true,
    'modes' => [
        // 'ONLY_FULL_GROUP_BY',
        'STRICT_TRANS_TABLES',
        'NO_ZERO_IN_DATE',
        'NO_ZERO_DATE',
        'ERROR_FOR_DIVISION_BY_ZERO',
        'NO_AUTO_CREATE_USER',
        'NO_ENGINE_SUBSTITUTION'
    ],
```

```
    use Illuminate\Support\Facades\DB;

    Polio::select('*', DB::raw('SUM(id + anchor_id) as totals'))->groupBy('id')->get();
```

References: https://stackoverflow.com/a/44984930

-   Rebuild the Models

```
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->where('created_at', '<', now()->subYears(2000));
        });
    }
```

https://laravel.com/docs/8.x/eloquent#anonymous-global-scopes

-   Get ranking and view

```sql
CREATE VIEW `ranking` AS
SELECT *, RANK() OVER(ORDER BY polio_id) as `Rank` FROM `anchors`;

SELECT * FROM `ranking` WHERE 1;

DROP VIEW `ranking`;
```

https://www.sqlshack.com/overview-of-sql-rank-functions/
https://www.w3schools.com/sql/sql_ref_create_view.asp

## Todo

> There is nothing to see here

### Suspended

> There is nothing to see here

### Next up

> There is nothing to see here

> Remove all tasks above while everything has done, wants to continue to next tasks, or would be merged to the master routes and serve in production.

## Security Issue

> There is nothing to see here

## References

-   https://stackoverflow.com/a/44984930

-   Assets for Home -> https://www.freepik.com/free-vector/fantasy-blue-castle-rock-morning_12900211.htm#page=1&query=castle&position=2&from_view=search
-   Assets for Masuk/Daftar -> https://www.freepik.com/free-vector/dragon-flying-towards-castle_2584214.htm#page=1&query=dragon&position=15

-   Assets for Dongeng Thumbnail ->

    -   Si Pitung -> https://www.youtube.com/watch?v=1ZTvayQwpkQ
    -   Malin Kundang -> https://www.youtube.com/watch?v=VoqEu-hHz-M&ab_channel=Alrain
    -   Si Buta dari Gua Hantu -> https://bumilangit.fandom.com/wiki/Si_Buta_Dari_Gua_Hantu_(Pusaka)
    -   Timun Mas -> https://kumparan.com/viral-food-travel/contoh-cerita-rakyat-kisah-timun-mas-mengalahkan-raksasa-yang-ingin-memakannya-1v1jnU6HtcX
    -   Keong Mas -> https://dongengceritarakyat.com/cerita-rakyat-indonesia-dongeng-keong-mas/
    -   Lutung Kasarung dan Purbasari -> https://www.popmama.com/kid/1-3-years-old/jemima/dongeng-nusantara-lutung-kasarung-dan-purbasari
    -   Jaka Tarub -> https://histori.id/kisah-jaka-tarub-dan-tujuh-bidadari/
    -   Kancil dan Timun -> http://www.riri.id/nostalgia-bareng-si-cerdik-yang-suka-mentimun

-   Assets for Dongeng Cerita
    -   Malin Kundang -> https://www.youtube.com/watch?v=VoqEu-hHz-M&ab_channel=Alrain
        -> https://www.popmama.com/kid/4-5-years-old/jemima/dongeng-anak-malin-kundang-anak-durhaka
-   Assets for "Koleksi Kartu" -> https://www.freepik.com/gienlee

## License

> There is nothing to see here
