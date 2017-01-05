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
basic - работает, проверено
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
Как писать правила:
```
'rules' => [
        'catalog/<category:[^/]+>' => 'catalog',
        'catalog/<category:[^/]+>/<subcategory:[^/]+>' => 'catalog',
],
```
В wordpress мы писали регулярку под весь урл сразу, выделяя группы.
В yii2 урл задается строкой, в которую в <таких скобках> включаем параметры.
Формат: <имяПараметра:регулярка>.
Каждому урлу задаем контроллер/действие.
У меня здесь действие Index, поэтому указан только контроллер.
Правила, которые я написала, позволят передать контроллеру параметр category, если нужна страница категории (например, товаров). И параметры category и subcategory, если нужна страница подкатегории.

Но в реальности для такой задачи придется писать класс UrlRule. Потому что категории и подкатегории могут быть не любыми, а должны соответствовать БД. https://github.com/YushkinaS/yii2-study/blob/master/CatalogUrlRule - вот этот класс. Подключать его  так:
```
'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
        ],
        'rules' => [
                [
                'class' => 'app\components\CatalogUrlRule', 
                // ...настройка других параметров правила...
                ],
        ],
],
```
И здесь еще включена полезная фича - нормализация trailing slash. (это для всех страниц сайта, не только каталога). Можно ее переопределять в каждом правиле отдельно, если требуется.
