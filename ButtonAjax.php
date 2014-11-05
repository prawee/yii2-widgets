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
        return Html::button($this->name,$this->options);
    }
    protected function registerAssets()
    {
        $view = $this->getView();
        $js ='$("#btn-modal-'.$this->getId().'").click(function(){
            $("#main-modal").modal({backdrop:"static",keyboard:false})
            .find("#main-content-modal")
            .load($(this).attr("value"));
         });';
        $view->registerJs($js);
    }
}
