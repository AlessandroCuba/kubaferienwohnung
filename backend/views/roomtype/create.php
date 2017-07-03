<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Roomtype */

$this->title = Yii::t('app', 'Create Roomtype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roomtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
