<?php
/* 2014-11-05
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 */
namespace prawee\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use auth\Asset;
class ButtonAjax extends Widget
{
    public $name;
    public $route;
    public $options=[];
    public $css;
    public function init()
    {
        parent::init();
        $this->css='btn btn-success';
        $this->options=[
            'value'=>  Url::to([$this->route]),
            'id'=>'btn-model-'.$this->getId(),
            'class'=>$this->css,
        ];
    }

    public function run(){
        $this->registerAssets();
        echo Html::button($this->name,$this->options);
    }
    protected function registerAssets()
    {
        $view = $this->getView();
        $js ='alert("ok");';
        $view->registerJs($js);
    }
}
