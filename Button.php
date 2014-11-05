<?php
/*
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 */
namespace prawee\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use auth\Asset;
class Button extends \yii\base\Widget
{
    public $name;
    public $route;
    public $options=[];
    public $css;
    public function init()
    {
        $this->css='btn btn-success';
        $this->options=[
            'value'=>  Url::to([$this->route]),
            'id'=>'btn-model-'.$this->getId(),
            'class'=>$this->css,
        ];
        parent::init();
    }

    public static function ajax(){
        $this->registerAssets();
        return Html::button($this->name,$this->options);
    }
    protected function registerAssets()
    {
        $view = $this->getView();
        Asset::register($view);
        $js ='';
        $view->registerJs($js);
    }
}
