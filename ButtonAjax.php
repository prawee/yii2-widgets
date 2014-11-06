<?php
/* 2014-11-05
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 * @reference http://www.yiiframework.com/wiki/690/render-a-form-in-a-modal-popup-using-ajax/
 */
namespace prawee\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;

class ButtonAjax extends Widget
{
    /* name of button */
    public $name='Modal';

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
        //route
        if(!$this->route){
            throw new ForbiddenHttpException(Yii::t('yii','please setting route options.'));
        }else{
            $this->options['value']=Url::to($this->route);
        }

        if($this->options==null){
            $this->options=[
                //'value'=>  Url::to($this->route),
                'id'=>'btn-modal-'.$this->getId(),
                'class'=>$this->css,
            ];
        }
        

    }

    public function run(){
        $this->registerAssets();
        return Html::button($this->name,$this->options);
    }
    protected function registerAssets()
    {
        $view = $this->getView();
        $js ='$("#btn-modal-'.$this->getId().'").click(function(){
            $("#main-modal").modal("show")
            .find("#main-content-modal")
            .load($(this).attr("value"));
         });';
        $view->registerJs($js);
    }
}
