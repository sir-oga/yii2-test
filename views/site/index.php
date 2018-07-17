<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $categories Category[] */
/* @var $model Category */

rmrevin\yii\fontawesome\AssetBundle::register($this);
$action = '/category/create';
$disabled = false;
$categoryParentAdd = [];
$formTitle = 'Create Category';
$categoryList = ArrayHelper::map(Category::find()->all(), 'id', 'name');
if (!$model->isNewRecord) {
    $parent = $model->parents(1)->one();
    $model->parentId = $parent ? $parent->id : 0;
    $action = '/category/update/' . $model->id;
    $disabled = true;
    $formTitle = 'Edit Category: ' . $model->name;
    $categoryList = array_merge([0 => 'None'],$categoryList);
}


?>
<div class="site-index">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?php foreach ($categories as $category):?>
            <?php $margin = 10 * ($category->depth);
                $deleteElementIcon = $category->depth
                    ? '<i class="far fa-trash-alt"></i>'
                    : '<i class="fas fa-eraser"></i>';
            ?>
                <div class="form-control tree-style" style="margin-left: <?=  $margin . 'px' ?>; width: calc(100% - <?= $margin . 'px'?> )">
                    <?= $category->name ?>
                    <a href="/category/delete/<?= $category->id ?>" class="pull-right"><?=$deleteElementIcon?></a>
                    <a href=" /<?= $category->id?>" class="pull-right" style="margin-right: 5px"><i class="fas fa-pencil-alt"></i></a>
                </div>
            <?php endforeach;?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?php $form = ActiveForm::begin(['action' => $action]); ?>
            <h4><?=$formTitle?></h4>

            <?= $form->field($model, 'parentId')->dropDownList($categoryList, ['disabled' => $disabled])->label('Parent') ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>


</div>
