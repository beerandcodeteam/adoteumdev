#!/usr/bin/env bash

UNAMEOUT="$(uname -s)"

WHITE='\033[1;37m'
NC='\033[0m'

# Verify operating system is supported...
case "${UNAMEOUT}" in
    Linux*)             MACHINE=linux;;
    Darwin*)            MACHINE=mac;;
    *)                  MACHINE="UNKNOWN"
esac

if [ "$MACHINE" == "UNKNOWN" ]; then
    echo "Unsupported operating system [$(uname -s)]. Laravel Sail supports macOS, Linux, and Windows (WSL2)." >&2

    exit 1
fi

# Ensure that Docker is running...
if ! docker info > /dev/null 2>&1; then
    echo -e "${WHITE}Docker is not running.${NC}" >&2

    exit 1
fi

export APP_SERVICE=${APP_SERVICE:-"laravel.test"}
export WWWUSER=${WWWUSER:-$UID}
export WWWGROUP=${WWWGROUP:-$(id -g)}

# Determine if Sail is currently up...
PSRESULT="$(docker-compose ps -q)"
if docker-compose ps | grep $APP_SERVICE | grep 'Exit'; then
    echo -e "Shutting down old Sail processes..." >&2

    docker-compose down > /dev/null 2>&1

    EXEC="no"
elif [ -n "$PSRESULT" ]; then
    EXEC="yes"
else
    EXEC="no"
fi

# Source the ".env" file so Laravel's environment variables are available...
if [ -f ./.env ]; then
    source ./.env
fi

if [ "$1" == "config" ]; then

    ENVFILE='./.env'

    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/opt \
        -w /opt \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs

    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/usr/src/app \
        -w /usr/src/app \
        node:16-alpine \
        npm install

    if [ ! -f $ENVFILE ]; then
        cp .env.example .env
    fi

elif [ "$1" == "init" ]; then
    ./vendor/bin/sail up --build --force-recreate -d
    
elif [ "$1" == "test" ]; then
    shift 1

    if [ "$EXEC" == "yes" ]; then
        docker-compose exec \
            -u sail \
            "$APP_SERVICE" \
            php artisan test -p "$@"
    else
        echo "Sail is not running."
    fi

else
    ./vendor/bin/sail "$@"
fi
