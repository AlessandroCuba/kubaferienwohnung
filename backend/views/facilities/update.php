<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Roomfacility */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Facilities',
]) . $model->id_facility;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roomfacilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_facility, 'url' => ['view', 'id' => $model->id_facility]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="roomfacility-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
