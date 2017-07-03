<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Owner */

$this->title = Yii::t('app', 'Update: ', [
    'modelClass' => 'Owner',
]) . $model->ownerName.' '.$model->ownerLastName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ownerName, 'url' => ['view', 'id' => $model->id_owner]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="panel panel-info">
    <div class="panel-heading">

        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
