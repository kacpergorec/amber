> [!CAUTION]
>  Before working with this repo, please read the [Disclaimer](#-disclaimer) and [Known limitations](#-known-limitations) sections.

---

<p align="center"><a href="https://deploys.pl" target="_blank">
    <img src="https://i.ibb.co/72VzznX/amber.png" width="200" alt="Amber CMS Logo">
</a></p>

<p align="center">
<img src="https://img.shields.io/badge/status-active-darkforestgreen">
<a href="https://github.com/kacpergorec/amber/blob/master/LICENSE"><img src="https://img.shields.io/badge/License-GPL_3.0-blue"></a>
</p>


Amber CMS is a UX-first content management system built with **Laravel 11** and **Livewire**. It combines modern development practices with an emphasis on user experience, making it both a powerful and accessible solution for managing content.

## Features

- **Livewire-Powered Interactions**: Seamless, reactive UI components for an enhanced user experience.
- **Laravel 11**: Built on the latest version of Laravel, offering cutting-edge performance and security.
- **Focus on UX**: Every feature is designed with user experience in mind.
- **Fully accesible and responsive**: Built with accessibility and responsiveness in mind.

## Configuration

```Bash
cp compose.override.yml.dist compose.override.yml
```

## Installation with Makefile

```Bash
make run
make build-front
```

```Bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

## Installation via Docker only

```Bash
# Create network if doesnt exist
docker network create amber-cms
```

```Bash
# Initialize Docker Environment 
docker-compose up -d

# DB
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

# Composer and npm
docker-compose exec app composer install
docker-compose exec app npm install

# Build CMS frontend (Tailwind, DaisyUI, additional scripts)
docker-compose exec app npm run build

```

## Tools

```Bash
make prettier

# Testing (.env.testing)
make create-testing-db
make run-tests
````
```Bash
docker-compose exec app npm run prettier

# Create testing database manually (.env.testing)
docker-compose exec app php artisan test --coverage
```

## Feature Roadmap
##### Stage 1
- [ ] User management, roles, permissions
- [ ] Pages and Sections
- [ ] Simple one-template system (Frontend)
##### Stage 2
- [ ] Media management
- [ ] Website settings
- [ ] SEO settings
- [ ] User settings
- [ ] Exporting pages to static HTML and serving them
##### Stage 3
- [ ] Templating system
- [ ] Separate Core logic from Development logic
- [ ] Publish to Packagist
##### Stage 4 (Post release)
- [ ] Custom field filtering
- [ ] Headless CMS Backend

## ❗ Known limitations
While this project is functional, it is not yet optimized for production in highly demanding environments. Contributions, feedback, and bug reports are welcome!

## ❗ Disclaimer
Amber CMS is primarily a learning project. **My background is in Symfony**, and I’m using this opportunity to expand my skill set in Laravel and Livewire.

That said, Amber CMS also serves a practical purpose: it ~~powers~~ **will power** [deploys.pl](https://deploys.pl), my personal website.
