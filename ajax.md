#ajax
Создаем контроллер и действие для обработки аякс запроса.

controller/action
```php
  if (Yii::$app->request->isAjax) {
    Yii::$app->response->format = Response::FORMAT_JSON;
    return [ 'data2' =>$data2 ];
   }
```
Задаем формат ответа json (иначе контроллер вернет целую страницу)

Во вьюхе через Url::to получаем урл для нашего controller/action, при этом можно указать параметры, которые действию будут переданы

Создаем скрипт, в котором шлем аякс запрос на наш урл. Здесь в data тоже можно передать параметры. 

Регистрируем скрипт. Все.

view
```php
<?php
use yii\helpers\Url;
?>
	<a href="" class="test-ajax">test ajax</a>
	<div class="test">test</div>
	
	<?php
	$url = Url::to(['controller/action','param'=>$param]);
	$js = <<< JS
    $('.test-ajax').click(function( event ){
		  event.preventDefault();
      $.ajax({
        url: "$url",
        dataType: "json",
        data: {
				  data1: "something",
			  },
        success: function(data) {
          $(".test").html( data.data2 );                
        }
      });
    });
JS;
$this->registerJs($js);
?>
```

Если скрипт должен вернуть кусок html, то в контроллере формат менять не надо, там html по умолчанию. В скрипте нужно указать dataType: "html". Контроллер должен отрендерить нужный html с помощью renderAjax и вернуть результат. В скрипте мы его прямо выведем в нужное место страницы.

Может быть так, что один и тот же контроллер/действие будет использоваться и напрямую, и через ajax. Тогда нужно смотреть Yii::$app->request->isAjax и возвращать соответственно разные html - целую страницу или кусок для ajax.
