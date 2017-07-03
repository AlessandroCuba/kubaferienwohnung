<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Owner */

$this->title = Yii::t('app', 'Create Owner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-info">
    <div class="panel-heading">

        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
