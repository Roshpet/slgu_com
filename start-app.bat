@echo off
TITLE Marriage Certificate System
CLS

:: Force execution from the script's directory
cd /d "%~dp0"

ECHO ==========================================================
ECHO   MARRIAGE CERTIFICATE SYSTEM
ECHO ==========================================================
ECHO.

:: 1. Self-Cleaning: Stop any stuck background processes
ECHO   [1] Cleaning up previous sessions...
taskkill /F /IM php.exe >nul 2>nul

:: 2. Verification
IF NOT EXIST "artisan" (
    ECHO.
    ECHO   [ERROR] Critical file 'artisan' is missing!
    ECHO   Please make sure 'start-app.bat' is inside your COM folder.
    ECHO.
    PAUSE
    EXIT
)

:: 3. Locate PHP
SET PHP_CMD=php
IF EXIST "C:\php\php.exe" SET PHP_CMD=C:\php\php.exe

:: 4. Launch App
ECHO   [2] Starting Server...
ECHO   [3] Opening Browser...
ECHO.
ECHO   The app is running. Do not close this window.
ECHO.

:: Background task to open browser after 3 seconds
START /B cmd /c "timeout /t 3 /nobreak >nul && start "" "http://127.0.0.1:8000""

:: Start the server
%PHP_CMD% artisan serve --host=127.0.0.1 --port=8000

PAUSE