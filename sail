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

# Define environment variables...
export APP_PORT=${APP_PORT:-80}
export APP_SERVICE=${APP_SERVICE:-"laravel.test"}
export DB_PORT=${DB_PORT:-3306}
export WWWUSER=${WWWUSER:-$UID}
export WWWGROUP=${WWWGROUP:-$(id -g)}

if [ "$MACHINE" == "linux" ]; then
    export SEDCMD="sed -i"
elif [ "$MACHINE" == "mac" ]; then
    export SEDCMD="sed -i .bak"
fi

# Ensure that Docker is running...
if ! docker info > /dev/null 2>&1; then
    echo -e "${WHITE}Docker is not running.${NC}" >&2

    exit 1
fi

# Determine if Sail is currently up...
PSRESULT="$(docker-compose ps -q)"

if docker-compose ps | grep 'Exit'; then
    echo -e "${WHITE}Shutting down old Sail processes...${NC}" >&2

    docker-compose down > /dev/null 2>&1

    EXEC="no"
elif [ -n "$PSRESULT" ]; then
    EXEC="yes"
else
    EXEC="no"
fi

# Function that outputs Sail is not running...
function sail_is_not_running {
    echo -e "${WHITE}Sail is not running.${NC}" >&2
    echo "" >&2
    echo -e "${WHITE}You may Sail using the following commands:${NC} './vendor/bin/sail up' or './vendor/bin/sail up -d'" >&2

    exit 1
}

# Source the ".env" file so Laravel's environment variables are available...
if [ -f ./.env ]; then
    source ./.env
fi

if [ "$1" == "build" ]; then

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

        docker-compose up --build --force-recreate -d

# Pass unknown commands to the "docker-compose" binary...
else
    ./vendor/bin/sail "$@"
fi

