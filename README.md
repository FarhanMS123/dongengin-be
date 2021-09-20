# DongengIn - Frontend (ReactJS) Source Code
> This Readme is describe DongengIn and Dongengin Backend development status. If you are looking for Backend' Readme and License, please continue to [this page](./README_laravel.md)

## Installation
> You could just skip this section as this project's backend-part has been installed properly. The purposes of this are to describe how to setup the project at first and what modules are used in the development. Please consider to edit to this section whenever you add new modules or restructuring the folders and files.

This project has been build using `composer create-project`, and some modules showed below.

```bash
composer create-project laravel/laravel dongengin-be
```

You could take a look to these documentation
- https://laravel.com/

## Setting Up

As the project has been built properly, next developer just need to do `npm install` to install all modules needed.

```bash
npm install
```

Let Node Package Manager do its job. The PM would also install `react-scripts` which could executed scripts we need for development.

You may need `.env` configuration whenever you need to setting NodeJS and `react-scripts` behavior, application key (public_key or private_key), or any global variables needed by the app. If you do not like the concept of `.env`, NodeJS and `react-scripts` would do their default behavior, and set configuration variables straight in the `src` folder. The `.env` configuration could be accessed from references below.

Take a look
- https://create-react-app.dev/docs/available-scripts
- https://create-react-app.dev/docs/adding-custom-environment-variables
- https://create-react-app.dev/docs/advanced-configuration

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
> There is nothing to see here

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
> There is nothing to see here

## License
> There is nothing to see here
