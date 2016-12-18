# yii2-study

##Установка под Openserver
http://it-stop.ru/razrabotka-sajtov/ustanovka-yii2-na-openserver/

```
cd domains\yii.loc.

composer global require "fxp/composer-asset-plugin:~1.1.1"

composer create-project --prefer-dist yiisoft/yii2-app-basic basic
```
или
```
composer create-project --prefer-dist yiisoft/yii2-app-advanced advanced
```
или
другой репозиторий с проектом
последнее слово - любое имя папки. Потом ее все равно удалим и перенесем содержимое на уровень выше

https://github.com/settings/tokens/new?scopes=repo&description=Composer

```
init
```
Выбираем [0] Development и вводим yes 

Теперь можем перенести наш проект на уровень выше, то есть скопироваться все файлы из папки basic в папку yii.loc.

Создать БД
Прописать ее название в common/config/main-local.php. 
```
        'components' => [
        'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=yii2',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        ],  и т.д...
```
 
```
 yii migrate
```

http://yii.loc/frontend/web/

http://yii.loc/backend/web/

##ЧПУ
