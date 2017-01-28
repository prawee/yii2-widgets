<?php
/**
 * @link http://www.konkeanweb.com
 * 1/29/2017 AD 5:39 AM
 * @copyright Copyright (c) 2017 served
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 * @license BSD-3-Clause
 */
namespace prawee\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\HttpException;

class LinkAjax extends Widget
{
    public $id;
    public $name;
    public $route = [];
    public $options = [];
    public $modalId = '#main-modal';
    public $modalContent = '#main-content-modal';
    public $tag = 'a';
    public $routeTag = 'href';

    public function init()
    {
        parent::init();
        if (empty($this->id)) {
            $this->id = 'btn-modal-'.$this->getId();
        }
        if (empty($this->route)) {
            throw new \HttpException(404, 'please setting route options.');
        }
        if (empty($this->options['class'])) {
            $this->options['class'] = 'btn btn-default';
        }
        if ($this->options) {
            $this->options = array_merge($this->options, [
               'id' => $this->id,
                $this->routeTag => Url::to($this->route)
            ]);
        }
    }
    public function registerAssets()
    {
        $js = '
            $("#'.$this->id.'").click(function(){
                $("'.$this->modalId.'").modal("show")
                .find("'.$this->modalContent.'")
                .load($(this).attr("'.$this->routeTag.'"));
            });
        ';
        $this->getView()->registerJs($js);
    }
    public function run()
    {
        $this->registerAssets();
        return Html::tag($this->tag,$this->name,$this->options);
    }
}