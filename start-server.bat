@echo off
echo ============================================
echo  Ancient Egyptian Museum - Development Server
echo ============================================
echo.
echo Starting PHP development server...
echo Server will be available at: http://localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo ============================================
echo.

cd /d "%~dp0"
php -S localhost:8000 -t public

pause
