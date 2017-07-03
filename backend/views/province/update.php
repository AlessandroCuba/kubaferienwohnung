<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Province */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Province',
]) . $model->id_province;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_province, 'url' => ['view', 'id' => $model->id_province]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="province-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
