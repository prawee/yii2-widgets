<?php
/* 2014-11-05
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 */
namespace prawee\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class ButtonAjax extends Widget
{

    public $title='Modal';

    /*
     * ['create'],
     * ['update','id'=>1]
     */
    public $route=['#'];
    public $options=[];
    public $css='btn btn-success';
    public function init()
    {
        parent::init();
        $this->options=[
            'value'=>  Url::to($this->route),
            'id'=>'btn-modal-'.$this->getId(),
            'class'=>$this->css,
        ];
    }

    public function run(){
        $this->registerAssets();
        return Html::button($this->title,$this->options);
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
