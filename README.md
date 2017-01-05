

- [установка под Openserver](https://github.com/YushkinaS/yii2-study/blob/master/instal%20for%20Openserver.md)
- [ЧПУ](https://github.com/YushkinaS/yii2-study/blob/master/pretty%20urls.md)
- [ajax](https://github.com/YushkinaS/yii2-study/blob/master/ajax.md)


##Как вставить картинку на страницу
```php
<?= Html::img('@web/images/logo.png', ['alt'=>'some', 'class'=>'thing']);?> 
```
В папке web создаем папку images. Или иначе ее называем. Кладем туда все картинки.
Теоретически можно располагать картинки где угодно, это только самый простой вариант, если не трогать конфиги. 

##Как подключить css
domains\advanced\frontend\assets\AppAsset.php
в этом же файле настраиваются пути к картинкам и другим ресурсам

##Layout
domains\advanced\frontend\views\layouts\main.php 
```php
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
```php
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
```php
<?= Html::a('Profile', ['user/view', 'id' => $id], ['class' => 'profile-link']) ?>
```
http://www.yiiframework.com/doc-2.0/guide-helper-html.html

##Body Class
http://www.yiiframework.com/forum/index.php/topic/28849-body-classes-based-on-url/
еще не освоено
