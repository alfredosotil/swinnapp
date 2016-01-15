<?php 
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Ideas';
$this->params['breadcrumbs'][] = $this->title;
?>

<a href="<?php echo Url::toRoute("ideas/think")?>"><i class='fa fa-fw fa-lightbulb-o'></i><span>Think Idea</span></a>
<a href="<?php echo Url::toRoute("ideas/admin")?>"><i class='fa fa-fw fa-cubes'></i><span>Admin Ideas</span></a>