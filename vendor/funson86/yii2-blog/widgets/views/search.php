<h3><?= Yii::t('app', 'Search in Blog') ?></h3>
<form action="<?php echo Yii::$app->getUrlManager()->createUrl(["/blog/default/index"])?>" method="get">
    <input type="text" name="keyword" id="keyword" value="<?php if(isset($_GET['keyword']) && strlen($_GET['keyword'])>0) echo $_GET['keyword']; else echo Yii::t('app','Search and hit enter'); ?>" class="search_input" onblur="if(this.value=='') this.value='Search and hit enter';"onfocus="if(this.value=='Search and hit enter') this.value='';"/>
</form>