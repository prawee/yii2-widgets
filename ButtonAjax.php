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
    /* Title of button */
    public $title='Modal';

    /* getting content from this route
     * ['create'],
     * ['update','id'=>1] */
    public $route=['#'];

    /* options of button such as
     * @value   route of content
     * @id      id of button for javascript
     * @class   css class 
     */
    public $options=[];

    /* setting css of button */
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
