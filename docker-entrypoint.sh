#!/bin/sh

# Check if .env file exists
if [ ! -f .env ]; then
    echo "First run detected: Setting up environment..."

    cp .env.example .env
    php artisan key:generate
    
    # Note: In production, you might want to add --force to the migrate command
    php artisan migrate
else
    echo "Environment file exists. Skipping setup."
fi

cd /app

exec composer run dev
