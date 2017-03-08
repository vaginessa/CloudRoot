@echo off
setlocal EnableDelayedExpansion
set myServer=cloudrandstad.ddns.net

for /f "tokens=1,2 delims=[]" %%a IN ('ping -n 1 !myServer!') DO (
 if "%%b" NEQ "" set ip=%%b
)
echo ip is %ip%
start "" http://%ip%/