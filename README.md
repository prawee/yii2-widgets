yii2-widgets
============
- ButtonAjax make button with ajax for modal

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist prawee/yii2-widgets "*"
```

or add

```
"prawee/yii2-widgets": "*"
```

to the require section of your `composer.json` file.


Usage
-----

1.ButtonAjax
----------
on view 
```php
    echo ButtonAjax::widget([
        'title'=>'Create',
        'route'=>['create'],
    ]);
```

on controller
```php
public functionn actionCreate(){
    .......
    .......
    if(Yii::$app->getRequest()->isAjax){
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }else{
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
```