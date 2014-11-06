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

    /* setting css of button */
    public $css='btn btn-success';

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
        //id
        if(empty($this->id)){
            $this->id='#btn-modal-'.$this->getId();
        }

        //route
        if(empty($this->route)){
            throw new HttpException(404, 'please setting route options.');
        }else{
            $this->options['value']=Url::to($this->route);
        }
        
        //class 
        $this->options['id']=$this->id;

        //all options
        if($this->options){
            $this->options=  array_merge($this->options,[
                'class'=>$this->css,
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
        $js ='$("'.$this->id.'").click(function(){
            $("'.$this->modalId.'").modal("show")
            .find("'.$this->modalContent.'")
            .load($(this).attr("value"));
         });';
        $view->registerJs($js);
    }
}
