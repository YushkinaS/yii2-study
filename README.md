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


только для advanced
```
init
```
Выбираем [0] Development и вводим yes 


Теперь можем перенести наш проект на уровень выше, то есть скопироваться все файлы из папки basic или advanced в папку yii.loc.

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
 
 
 только для advanced
```
 yii migrate
```


http://yii.loc/web/

http://yii.loc/frontend/web/

http://yii.loc/backend/web/

##ЧПУ

domains\advanced\frontend\config\main.php
раскомментировать
```
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],``
```
и создать .htaccess в корне (domains\advanced\)
http://byprofox.ru/lessons/lessons-yii-2/pravilnyj-htaccess-dlya-yii-2-0/
я пробовала по этой ссылке файл для advanced приложения, заработало сразу
```
Options +FollowSymLinks
IndexIgnore */*
RewriteEngine on
 
# Если запрос начинается с /admin, то заменяем на /backend/web/
RewriteCond %{REQUEST_URI} ^/admin
RewriteRule ^admin\/?(.*) /backend/web/$1
 
# Добавляем другой запрос /frontend/web/$1
RewriteCond %{REQUEST_URI} !^/(frontend/web|backend/web|admin)
RewriteRule (.*) /frontend/web/$1
 
# Если frontend запрос
RewriteCond %{REQUEST_URI} ^/frontend/web
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /frontend/web/index.php
 
# Если backend запрос
RewriteCond %{REQUEST_URI} ^/backend/web
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /backend/web/index.php
```
basic не проверяла
```
Options +FollowSymLinks
IndexIgnore */*
RewriteEngine on
 
# Если запрос не начинается с web, добавляем его
RewriteCond %{REQUEST_URI} !^/(web)
RewriteRule (.*) /web/$1
 
# Если файл или каталог не существует, идём к /web/index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /web/index.php
```
##Как вставить картинку на страницу
```
<?= Html::img('@web/images/logo.png', ['alt'=>'some', 'class'=>'thing']);?> 
```
В папке web создаем папку images. Или иначе ее называем. Кладем туда все картинки.
Теоретически можно располагать картинки где угодно, это только самый простой вариант, если не трогать конфиги. 

##Как подключить css
domains\advanced\frontend\assets\AppAsset.php
в этом же файле настраиваются пути к картинкам и другим ресурсам

##Layout
domains\advanced\frontend\views\layouts\main.php 
```
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

...

 <?= $content ?>

...

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
```

##Имена таблиц и модели

Модель по умолчанию
```
<?php

namespace app\models;

use yii\db\ActiveRecord;

class Word1Word2Word3 extends ActiveRecord
{
}
```
помещается в файл с тем же именем, что и у класса

соответствует таблице БД с именем word1_word2_word3 (camelcase переводится в подчеркивания между словами)

##Как вставить ссылку и другие html теги
```
<?= Html::a('Profile', ['user/view', 'id' => $id], ['class' => 'profile-link']) ?>
```
http://www.yiiframework.com/doc-2.0/guide-helper-html.html

##Body Class
http://www.yiiframework.com/forum/index.php/topic/28849-body-classes-based-on-url/
еще не освоено
