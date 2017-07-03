<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BoockStatus */

$this->title = Yii::t('app', 'Create Boock Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Boock Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boock-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
