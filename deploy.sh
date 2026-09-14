#!/usr/bin/env bash
set -Eeuo pipefail

APP_DIR="/root/DASHBOARD"
BRANCH="main"
LOCK_FILE="/tmp/dashboard-deploy.lock"
LOG_FILE="/var/log/dashboard-deploy.log"

exec 9>"$LOCK_FILE"
if ! flock -n 9; then
    exit 0
fi

cd "$APP_DIR"

log() {
    printf '[%s] %s\n' "$(date '+%Y-%m-%d %H:%M:%S')" "$*" >> "$LOG_FILE"
}

log "Checking $BRANCH for updates"
git fetch origin "$BRANCH" --quiet

LOCAL=$(git rev-parse HEAD)
REMOTE=$(git rev-parse "origin/$BRANCH")

if [ "$LOCAL" = "$REMOTE" ]; then
    exit 0
fi

log "Deploying $LOCAL -> $REMOTE"

git pull --ff-only origin "$BRANCH" >> "$LOG_FILE" 2>&1

if [ -f composer.json ]; then
    if command -v composer >/dev/null 2>&1; then
        composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader >> "$LOG_FILE" 2>&1
    elif [ -f composer.phar ]; then
        php composer.phar install --no-dev --prefer-dist --no-interaction --optimize-autoloader >> "$LOG_FILE" 2>&1
    else
        log "ERROR: Composer is not installed"
        exit 1
    fi
fi

php artisan migrate --force >> "$LOG_FILE" 2>&1
php artisan optimize:clear >> "$LOG_FILE" 2>&1
php artisan optimize >> "$LOG_FILE" 2>&1

log "Deployment completed at $(git rev-parse --short HEAD)"
