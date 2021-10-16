#!/usr/bin/env bash

########################################################

UNAMEOUT="$(uname -s)"

NC='\033[0m'
WHITE='\033[1;37m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
LABEL_ERROR="\n\033[048;5;9m ERROR ${NC} "
LABEL_OK="\n\033[048;5;64m   OK   ${NC} "
LABEL_ADOTE="\n\033[048;5;167m \033[1m→ AdoteUm.Dev ${NC} "

generateAppKey(){
    HAS_KEY=$(grep APP_KEY=base64 .env)
        
    if [  -f ./.env ] && [ -z "$HAS_KEY"  ]; then
        echo -e "${LABEL_ADOTE}generating App Key... 🗝️"

        docker-compose exec \
        -u sail \
        "$APP_SERVICE" \
        php artisan key:generate --ansi
    fi
}

compileAppAssets(){
    echo -e "${LABEL_ADOTE}compiling App Assets... 🎒"

    docker-compose exec \
    -u sail \
    "$APP_SERVICE" \
    npm run dev
}

checkDependencies() {
     if [ ! -d ./vendor ] || [ ! -f ./vendor/bin/sail ] || [ ! -d ./node_modules ] || [ -z "$(ls -A ./node_modules)" ]; then
        AdoteBanner     
        read -p "$(echo -e "${LABEL_ERROR}It seems your app is missing package dependencies. ${GREEN}Let's download them now${NC} [y/N]? ")"  ANSWER

        if [[ $ANSWER == "y" || $ANSWER == "Y" || $ANSWER == "yes" || $ANSWER == "YES" ]] ; then
            configureSail
        else
            echo -e "Aborting! Run ${GREEN}./sail config${NC} to configure your app and download dependencies."
            exit
        fi
        exit 1
     fi
}

configureSail() {
    echo -e "${LABEL_ADOTE}is starting to download packages and self-configure."

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
        echo -e "${LABEL_ADOTE}You can start the app now. Run: ${GREEN}./sail init${NC} command."
        exit 0
    else
        echo -e "${LABEL_ERROR}Unkown error happend."
        exit 1
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

#############################################################
# Commands below require dependecies  to be installed      #
#############################################################

checkDependencies

if [ "$1" == "init" ]; then
    AdoteBanner
    echo -e "${LABEL_ADOTE}is starting..."

    ./vendor/bin/sail up --build --force-recreate -d

    ALL_UP="$(docker-compose ps | grep 'Exit';)"

    if [ -n "$ALL_UP" ]; then
        docker-compose ps
        echo -e "${LABEL_ERROR}Some services could not be started. Check the output above."
        exit 1;
    fi
    
    generateAppKey
    compileAppAssets

    echo -e "${LABEL_OK}Services are up and running!"

    echo -e "\n⛵ Some useful commands:\n"
    echo -e "${GREEN}./sail art <cmd>${NC} runs a command with Laravel Artisan."
    echo -e "${GREEN}./sail rdev${NC}      execute 'npm run dev' command."
    echo -e "${GREEN}./sail test ${NC}     runs tests with Pest in parallel mode."
    echo -e "${GREEN}./sail tinker ${NC}   opens a Laravel Tinker console."
    echo -e "${GREEN}./sail shell ${NC}    opens a shell inside your app container."
    echo -e "${GREEN}./sail stop ${NC}     stops your app container."
    echo -e "\n${LABEL_ADOTE}is ready for you at ${YELLOW}${APP_URL}${NC} - Enjoy and have fun!"
    echo -e "\n${YELLOW}⭐ Star${NC} our repository: ${YELLOW}https://github.com/beerandcodeteam/adoteumdev${NC}\n"

elif [ "$1" == "rdev" ]; then
    compileAppAssets

elif [ "$1" == "test" ]; then
    shift 1
    docker-compose exec \
    -u sail \
    "$APP_SERVICE" \
    php artisan test -p "$@"
else
    ./vendor/bin/sail "$@"
fi