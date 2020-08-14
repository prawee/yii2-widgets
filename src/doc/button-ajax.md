view
----

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

controller
----------

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


