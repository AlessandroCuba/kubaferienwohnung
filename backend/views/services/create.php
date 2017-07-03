<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Houseservices */

$this->title = Yii::t('app', 'Create Houseservices');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houseservices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houseservices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
