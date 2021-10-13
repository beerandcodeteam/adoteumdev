#!/usr/bin/env bash

########################################################

UNAMEOUT="$(uname -s)"

NC='\033[0m'
WHITE='\033[1;37m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
LABEL_ERROR="\033[048;5;9m ERROR ${NC} "
LABEL_OK="\033[048;5;64m  OK   ${NC} "
LABEL_ADOTE="\033[048;5;167m \033[1m→ AdoteUm.Dev ${NC} "

checkDependencies() {
     if [ ! -d ./vendor ] || [ ! -f ./vendor/bin/sail ]; then

        echo -e "${LABEL_ERROR}It seems your project is not configured. Run ${GREEN}./sail configure${NC} now? (y/N)"
        read -t 20  ANSWER

        if [[ $ANSWER == "y" || $ANSWER == "Y" || $ANSWER == "yes" || $ANSWER == "YES" ]] ; then
            configureSail
        fi
        exit 1
     fi
}

configureSail() {

    echo -e "${LABEL_ADOTE}is now being configured..."

    ENVFILE='./.env'

    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd)":/opt \
        -w /opt \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs

    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd)":/usr/src/app \
        -w /usr/src/app \
        node:16-alpine \
        npm install

    if [ ! -f $ENVFILE ]; then
        cp .env.example .env
    fi

    if [ -d ./vendor ] && [ -f ./vendor/bin/sail ]; then
        echo -e "${LABEL_OK}configuration done!"
    fi

}
########################################################

# Verify operating system is supported...
case "${UNAMEOUT}" in
    Linux*)             MACHINE=linux;;
    Darwin*)            MACHINE=mac;;
    *)                  MACHINE="UNKNOWN"
esac

if [ "$MACHINE" == "UNKNOWN" ]; then
    echo -e "${LABEL_ERROR}Unsupported operating system [$(uname -s)]. Laravel Sail supports macOS, Linux, and Windows (WSL2)." >&2

    exit 1
fi

# Ensure that Docker is running...
if ! docker info > /dev/null 2>&1; then
    echo -e "${LABEL_ERROR}Docker is not running.${NC}" >&2
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
    configureSail

elif [ "$1" == "init" ]; then
    echo -e "${LABEL_ADOTE}is starting..."
    ./vendor/bin/sail up --build --force-recreate -d
    
elif [ "$1" == "test" ]; then
    shift 1
    checkDependencies
    docker-compose exec \
    -u sail \
    "$APP_SERVICE" \
    php artisan test -p "$@"
else
    ./vendor/bin/sail "$@"
fi