<?php
/* 2014-11-05
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 * @reference http://www.yiiframework.com/wiki/690/render-a-form-in-a-modal-popup-using-ajax/
 * @version 1.0
 */
namespace prawee\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\HttpException;

class ButtonAjax extends Widget
{
    /*
     * id for javascript
     * @since 1.0
     */
    public $id;
    
    /* name of button */
    public $name='ButtonAjax';

    /*
     * @route array
     * getting content from this route
     * ['create'],
     * ['update','id'=>1]
     */
    public $route=[];

    /*
     * options of button such as
     * @value   route of content
     * @id      id of button for javascript
     * @class   css class 
     */
    public $options=[];

    /*
     * id of modal
     * @since 1.0
     */
    public $modalId='#main-modal';

    /*
     * content of modal
     * @since 1.0
     */
    public $modalContent='#main-content-modal';
    
    public function init()
    {
        parent::init();
        if(empty($this->id)){
            $this->id='btn-modal-'.$this->getId();
        }

        if(empty($this->route)){
            throw new HttpException(404, 'please setting route options.');
        }

        if(empty($this->options['class'])){
            $this->options['class']='btn btn-default';
        }
       
        if($this->options){
            $this->options=  array_merge($this->options,[
                'id'=>$this->id,
                'value'=>Url::to($this->route),
            ]);
        }
    }

    public function run(){
        $this->registerAssets();
        return Html::button($this->name,$this->options);
    }
    protected function registerAssets()
    {
        $view = $this->getView();
        $js ='$("#'.$this->id.'").click(function(){
            $("'.$this->modalContent.'").val("");
            $("'.$this->modalId.'").modal("show")
            .find("'.$this->modalContent.'")
            .load($(this).attr("value"));
         });';
        $view->registerJs($js);
    }
}
