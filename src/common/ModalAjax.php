<?php
/**
 * @link http://www.konkeanweb.com
 * 2/8/2017 AD 5:14 AM
 * @copyright Copyright (c) 2017 served
 * @author Prawee Wongsa <konkeanweb@gmail.com>
 * reference https://github.com/yiisoft/yii2/issues/7189
 * @license BSD-3-Clause
 */
namespace prawee\widgets;

use Yii;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\HttpException;

class ModalAjax extends Modal
{
    private $buttonId;
    public function init()
    {
        if (empty($this->toggleButton)) {
            throw new HttpException(404,'Please setting toggleButton on ModalAjax widgets.');
        }
        if (empty($this->options['toggleButton']['id'])) {
            $this->buttonId = 'btn-'.$this->id;
        }
        if (empty($this->toggleButton['ref'])) {
            throw new HttpException(404,'Please setting ref on ModalAjax["toggleButton"] widgets.');
        }
        $this->toggleButton['id'] = $this->buttonId;
        $this->toggleButton['ref'] = Url::to($this->toggleButton['ref']);
        parent::init();
    }
    public function run()
    {
        $this->registerAssets();
        parent::run();
    }
    public function registerAssets()
    {
        $js = <<<JS
        $('#$this->buttonId').click(function() {
            $('#$this->id').find(".modal-body").load($(this).attr('ref'));
        });
JS;
        $this->view->registerJs($js);
    }
}
