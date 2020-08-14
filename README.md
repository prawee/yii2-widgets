Extends widgets classes for Yii2 and Bootstrap 4
============

The extends class for all widgets classes on views

contains
--------

- ButtonAjax    for make ajax button for showing modal
- LinkAjax      for make ajax link for showing modal


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist prawee/yii2-widgets "dev-master"
```

or add

```
"prawee/yii2-widgets": "dev-master"
```

to the require section of your `composer.json` file.

Usage
-----
 
### ButtonAjax | LinkAjax

#### on your views

```bash
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
...
Modal::begin(['id'=>'main-modal']);
echo '<div id="main-content-modal"></div>';
Modal::end();
```

#### on your controller

```bash
public functionn actionCreate(){
    ...
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
