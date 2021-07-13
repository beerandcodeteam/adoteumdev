# Contributing to AdoteUmDev
Hi! We at `Beer and Code` are happy that you are interested in contributing to `AdoteUm.Dev`. But before submitting your contribution, be sure to take a moment and read the following guidelines.

  - [1. Getting started](#1-getting-started)
  - [2. Issue Reporting Guidelines](#2-issue-reporting-guidelines)
  - [3. Pull Request Guidelines](#3-pull-request-guidelines)
  - [4. Development Setup](#4-development-setup)
    - [4.1. Minimum Requirements](#41-minimum-requirements)
    - [4.2. Prepare the Environment](#42-prepare-the-environment)
    - [4.3. Create the Environment](#43-create-the-environment)
    - [4.4. Building Assets](#44-building-assets)
  - [5. Open Application in Browser](#5-open-application-in-browser)

## 1. Getting started

Before you begin:
- Check if your environment meets the established minimum requirements.
- Have you read the [Contributing Code Conduct](./CODE_OF_CONDUCT.md)?
- Check out the [existing issues](https://github.com/beerandcodeteam/adoteumdev/issues) & see if we accept contributions for your type of issue in our [Discord](https://discord.com/invite/mhyKFgv) or [Telegram](https://t.me/joinchat/HU7jWfEDn9xzgcND).

## 2. Issue Reporting Guidelines
// TODO : Define `issues` minimal rules

## 3. Pull Request Guidelines
// TODO : Define `pull request` minimal rules

## 4. Development Setup
`AdoteUm.Dev` is developed with the Laravel 8.40 release. The entire development environment can be created easily using `Laravel Sail`. Thus creating a standard environment, where all developers will have the same versions of certain technologies on their workstations, avoiding possible problems due to version incompatibility.

`Laravel Sail` as defined in its [documentation](https://laravel.com/docs/8.x/sail) has the following definition:

> Laravel Sail is a light-weight command-line interface for interacting with Laravel's default Docker development environment. Sail provides a great starting point for building a Laravel application using PHP, MySQL, and Redis without requiring prior Docker experience.

Consequently, so that we can maintain compatibility between development environments, we will define here the minimum requirements for generating and hosting the project.

<br />

### 4.1. Minimum Requirements
- PHP v8.0.8;
- Composer v2.1.3;
- NodeJs v16.4.1; 
- Npm v7.18.1;
- Npx v7.18.1;
- Yarn v1.22.5;
- MySql v8.0.25;
- Redis v6.2.4;
- WIP...

<br />

### 4.2. Prepare the Environment
After cloning the repository, enter the project folder and run:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

> If you are running the project for the first time, you need to run the above command so that the `composer` dependencies are installed correctly.

<br />

### 4.3. Create the Environment
Once all `composer` dependencies are installed, effectively create the Docker development environment with the command below:

```bash
$ sail up -d
```

This command will initiate downloads of all the Docker images needed to create the entire development environment established by the Laravel team.

> In case the Docker images already exist on your workstation, their download will be ignored. 

After all Docker images have been downloaded, all containers will be started, thus ending the development environment creation cycle.

<br />

### 4.4. Building Assets
Now that the development environment has been built, we need to compile the assets so that (`styles, scripts, etc`)  are handled and published. To do this, just run the following command:

```bash
$ sail npm install
$ sail npm run dev
```

<br />

## 5. Open Application in Browser
With everything resolved, the time has definitely come to see the application working, for that, go to the url `http://localhost:${APP_PORT}` in your favorite browser.

> Where ${APP_PORT} should be replaced by the port number informed in your '.env' file, if you did not enter a port number, the default port used will be `80`.
