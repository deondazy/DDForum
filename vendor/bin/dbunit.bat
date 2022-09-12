@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../phpunit/dbunit/composer/bin/dbunit
php "%BIN_TARGET%" %*
