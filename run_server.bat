@echo off
echo Starting development servers...
start "NPM Dev Server" cmd /k npm run dev
timeout /t 3
start "Laravel Server" cmd /k php artisan serve