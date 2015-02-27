echo enter 1 for pull/ 2 for push

:start
set /p a=

if %a% == 1 (goto PULL)
if %a% == 2 (goto PUSH)


:PULL
git pull https://github.com/jokerdawn/phpstudy.git
pause
exit

:PUSH
git push https://github.com/jokerdawn/phpstudy.git
pause
exit