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
        AdoteBanner     
        read -p "$(echo -e "${LABEL_ERROR}It seems your app is not configured. ${GREEN}Start self-config it now? ${NC}(y/N)")"  ANSWER


        if [[ $ANSWER == "y" || $ANSWER == "Y" || $ANSWER == "yes" || $ANSWER == "YES" ]] ; then
            configureSail
        else
            echo -e "Aborting! You must run ${GREEN}./sail config ${NC} to configure your app."
        fi
        exit 1
     fi
}

configureSail() {
    echo -e "${LABEL_ADOTE}is starting self-configuring."

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
        echo -e "${LABEL_ADOTE}You can start the app now. Run: ${GREEN}./sail init ${NC}".

    else
        echo -e "${LABEL_ERROR}Unkown error happend."

    fi

}


function AdoteBanner() {
    echo -e "\033[038;5;167m                                         *((/*,.                                "
    echo -e "\033[038;5;167m                                         ,/(/////*,                             "
    echo -e "\033[038;5;167m                                         ,/(/////////,.                         "
    echo -e "\033[038;5;167m                                         ,/(//////////(/,.                      "
    echo -e "\033[038;5;167m                                         *///////////////(/,                    "
    echo -e "\033[038;5;167m                                        .///////////////////(,.                 "
    echo -e "\033[038;5;167m                                        ,/(///////////////////(*                "
    echo -e "\033[038;5;167m                                       .////////////////////////(*.             "
    echo -e "\033[038;5;167m                .*,                   ,/(////////////////////////(/,            "
    echo -e "\033[038;5;167m             ,*/((*.                 ,/(/////////////////////////////.          "
    echo -e "\033[038;5;167m          .*(////(/,               .////////////////////////////////(/,         "
    echo -e "\033[038;5;167m        ./(////////*             ,/(///////////////////////////////////*        "
    echo -e "\033[038;5;167m      ./(///////////*         ,/(///////////////////////////////////////*       "
    echo -e "\033[038;5;167m     *//////////////(*.  .*/(///////////////////////////////////////////(,      "
    echo -e "\033[038;5;167m   .//////////////////////////////////////////////////////////////////////,     "
    echo -e "\033[038;5;167m  .*(////////////////////////////////////////////////////////////////////(*.    "
    echo -e "\033[038;5;167m .*/////////////////////////////////////////////////**/////////////////////,    "
    echo -e "\033[038;5;167m *//////////////////*  ,///////**,,,,.,,,,,**//////,  ,////////////////////*    "
    echo -e "\033[038;5;167m.///////////////////,                                 ,/////////////////////.   "
    echo -e "\033[038;5;167m,////////////////////.                               .*/////////////////////.   "
    echo -e "\033[038;5;167m,//////////////////*.                                 .*(///////////////////.   "
    echo -e "\033[038;5;167m,/////////////////*.                                    ,///////////////////.   "
    echo -e "\033[038;5;167m,////////////////*.                                     .*/////////////////*    "
    echo -e "\033[038;5;167m.*///////////////*.                                      */////////////////,    "
    echo -e "\033[038;5;167m ,////////////////,                                     ./////////////////*.    "
    echo -e "\033[038;5;167m .*///////////////*.                                    *////////////////*.     "
    echo -e "\033[038;5;167m  .*(//////////////*.                                 .*(////////////////.      "
    echo -e "\033[038;5;167m    *////////////////*.                              ,/////////////////*        "
    echo -e "\033[038;5;167m     ,//////*.  .,*/////*,.                     .,*///////////////////,         "
    echo -e "\033[038;5;167m      .,/////**,,.  .*////////*.           .*///////////////////////,.          "
    echo -e "\033[038;5;167m         ,////////*.  .*/////*.             .*////////////////////,.            "
    echo -e "\033[038;5;167m           ,///////*.                        */////////////////*.               "
    echo -e "\033[038;5;167m              ,*//////*,......               *//////////////*.                  "
    echo -e "\033[038;5;167m                 .,/////////(*.              *//////////*,                      "
    echo -e "\033[038;5;167m                      .,*//((*.              */(//*,.                           "
    echo -e "\033[0m            ___       __      __       __  __            ____           "
    echo -e "\033[0m           /   | ____/ /___  / /____  / / / /___ ___    / __ \___ _   __"
    echo -e "\033[0m          / /| |/ __  / __ \/ __/ _ \/ / / / __  __ \  / / / / _ \ | / /"
    echo -e "\033[0m         / ___ / /_/ / /_/ / /_/  __/ /_/ / / / / / / / /_/ /  __/ |/ / "
    echo -e "\033[0m        /_/  |_\__,_/\____/\__/\___/\____/_/ /_/ /_(_)_____/\___/|___/  "
    echo -e "\033[0m                                                    by \033[31mBeer And Code\033[0m\n"
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
    AdoteBanner
    configureSail
    exit 0;
fi

#All comands bellow should only run if the dependencies are installed.
checkDependencies

if [ "$1" == "init" ]; then
    AdoteBanner
    echo -e "${LABEL_ADOTE}is starting..."

    ./vendor/bin/sail up --build --force-recreate -d
    echo -e "\n"
    echo -e "${LABEL_OK} Everything should be up and running!\n"
    echo -e "⛵ Some useful commands are:\n"
    echo -e "${GREEN}./sail art ${NC}runs Laravel Artisan"
    echo -e "${GREEN}./sail test ${NC}runs tests with Pest in parallel mode"
    echo -e "${GREEN}./sail tinker ${NC}opens a Laravel thinker console."
    echo -e "${GREEN}./sail shell ${NC}opens a shell in your app container."
    echo -e "${GREEN}./sail stop ${NC} stops your app container."
    echo -e "\n${LABEL_ADOTE} HAVE FUN!\n"

elif [ "$1" == "test" ]; then
    shift 1
    docker-compose exec \
    -u sail \
    "$APP_SERVICE" \
    php artisan test -p "$@"
else
    ./vendor/bin/sail "$@"
fi