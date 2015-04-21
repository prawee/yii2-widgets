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
On view 
dev-master
```php
    use prawee\widgets\ButtonAjax;
    use yii\bootstrap\Modal;

    echo ButtonAjax::widget([
        'name'=>'Create',
        'route'=>['create'],
        'modalId'=>'#main-modal',
        'modalContent'=>'#main-content-modal',
        'options'=>[
            'class'=>'btn btn-success',
            'title'=>'Button for create application',
        ]
    ]);
    ....
    ....
    Modal::begin(['id'=>'main-modal']);
    echo '<div id="main-content-modal"></div>';
    Modal::end();
```

On controller

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

Update
------
2015-04-21 update document without 1.0 version that just keep how to using current version only. 
2014-11-27 added indicator.gif and set $modalContent is null before load content.