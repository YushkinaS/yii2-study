#ajax
Создаем контроллер и действие для обработки аякс запроса.

controller/action
```
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
```
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

