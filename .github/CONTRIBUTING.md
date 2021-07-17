# Contributing to AdoteUmDev
Hi! We at `Beer and Code` are happy that you are interested in contributing to `AdoteUm.Dev`. But before submitting your contribution, be sure to take a moment and read the following guidelines.

  - [1. Getting started](#1-getting-started)
  - [2. Issue Reporting Guidelines](#2-issue-reporting-guidelines)
  - [3. Pull Request Guidelines](#3-pull-request-guidelines)
  - [4. New Features and Security Vulnerabilities](#4-new-features-and-security-vulnerabilities)
  - [5. Development Setup](#5-development-setup)
    - [5.1. Minimum Requirements](#51-minimum-requirements)
    - [5.2. Prepare the Environment](#52-prepare-the-environment)
    - [5.3. Create the Environment](#53-create-the-environment)
    - [5.4. Building Assets](#54-building-assets)
  - [6. Open Application in Browser](#6-open-application-in-browser)

## 1. Getting started

Before you begin:
- Did you read the [Contributing Code Conduct](./CODE_OF_CONDUCT.md)?
- Did you read this document in its entirety?
- Check if your environment meets the established minimum requirements.
- Check out the [existing issues](https://github.com/beerandcodeteam/adoteumdev/issues) & see if we accept contributions for your type of issue in our [Discord](https://discord.com/invite/mhyKFgv) or [Telegram](https://t.me/joinchat/HU7jWfEDn9xzgcND).

<br />

## 2. Issue Reporting Guidelines

- The issue list of this repo is exclusively for bug reports, docs reports and feature requests. Non-conforming issues will be closed immediately.

  - To answer your questions, you can get answers in the `Beer and Code` chat on [Discord](https://discord.com/invite/mhyKFgv) or in the [Telegram](https://t.me/joinchat/HU7jWfEDn9xzgcND) group.

- Try to search for your issue, it may have already been answered or even fixed in the master branch (main).
  
- Use only the minimum amount of code necessary to reproduce the unexpected behavior. The more precisely you isolate the issue, the faster we can investigate.

- Check if the issue is reproducible with the latest stable version of `AdoteUm.Dev`, and please indicate the specific version you are using.
  
- Issues with no clear repro steps will not be triaged. If an issue labeled "need repro" receives no further input from the issue author for more than 7 days, it will be closed.
  
- If your issue is resolved but still open, don’t hesitate to close it. In case you found a solution by yourself, it could be helpful to explain how you fixed it.

- Most importantly, we ask for your patience: the team must balance your request with many other responsibilities - fixing other bugs, answering other questions, new features, new documentation, conducting channel lives, etc.

<br />

## 3. Pull Request Guidelines
- If adding new feature:
  - Provide convincing reason to add this feature. Ideally you should open a suggestion issue first and have it greenlighted before working on it.

- If fixing a bug:
  - If you are resolving a special issue, add `(fix: #xxxx[,#xxx])` (#xxxx is the issue id) in your PR title for a better release log, e.g. `fix: update entities encoding/decoding (fix #3899)`.
  - Provide detailed description of the bug in the PR.

<br />

## 4. New Features and Security Vulnerabilities

If you intend to propose a new feature, submit a issue to this repository.

In case of discovery of a security vulnerability in `AdoptOne.Dev`, **DO NOT** disclose publicly as an Issue, send a message to the email address [security@adoteum.dev](mailto://security@adoteum.dev). All security vulnerabilities will be resolved as soon as possible.

<br />

## 5. Development Setup
`AdoteUm.Dev` is developed with the Laravel 8.40 release. The entire development environment can be created easily using `Laravel Sail`. Thus creating a standard environment, where all developers will have the same versions of certain technologies on their workstations, avoiding possible problems due to version incompatibility.

`Laravel Sail` as defined in its [documentation](https://laravel.com/docs/8.x/sail) has the following definition:

> Laravel Sail is a light-weight command-line interface for interacting with Laravel's default Docker development environment. Sail provides a great starting point for building a Laravel application using PHP, MySQL, and Redis without requiring prior Docker experience.

Consequently, so that we can maintain compatibility between development environments, we will define here the minimum requirements for generating and hosting the project.

<br />

### 5.1. Minimum Requirements
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

### 5.2. Prepare the Environment
First, clone the repository by running the following command:

```bash
$ git clone git@github.com:beerandcodeteam/adoteumdev.git
```

After cloning the repository, enter the project folder and run:

```bash
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

📝 Note
> If you are running the project for the first time, you need to run the above command so that the `composer` dependencies are installed correctly.

<br />

### 5.3. Create the Environment
Once all `composer` dependencies are installed, effectively create the Docker development environment with the command below:

```bash
$ sail up -d
```

This command will initiate downloads of all the Docker images needed to create the entire development environment established by the Laravel team.

📝 Note
> In case the Docker images already exist on your workstation, their download will be ignored. 

After all Docker images have been downloaded, all containers will be started, thus ending the development environment creation cycle.

<br />

### 5.4. Building Assets
Now that the development environment has been built, we need to compile the assets so that (`styles, scripts, etc`)  are handled and published. To do this, just run the following command:

```bash
$ sail npm install
$ sail npm run dev
```

<br />

## 6. Open Application in Browser
With everything resolved, the time has definitely come to see the application working, for that, go to the url `http://localhost:${APP_PORT}` in your favorite browser.

📝 Note
> Where ${APP_PORT} should be replaced by the port number informed in your '.env' file, if you did not enter a port number, the default port used will be `80`.
