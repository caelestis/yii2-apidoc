<?php

use yii\apidoc\helpers\ApiMarkdown;
use yii\apidoc\models\ClassDoc;
use yii\apidoc\models\InterfaceDoc;
use yii\apidoc\models\TraitDoc;
use yii\helpers\ArrayHelper;

/* @var $type ClassDoc|InterfaceDoc|TraitDoc */
/* @var $this yii\web\View */
/* @var $renderer \yii\apidoc\templates\html\ApiRenderer */
/* @var $property_type string */

$renderer = $this->context;

if ($property_type == 'public' && count($type->getPublicMethods()) == 0) {
    return;
}
if ($property_type == 'private' && count($type->getPrivateMethods()) == 0) {
    return;
}
if ($property_type == 'protected' && count($type->getProtectedMethods()) == 0) {
    return;
}?>

<div class="summary doc-method">
<h2>
    <?php if ($property_type == 'public'): ?>
        Public Methods
    <?php elseif ($property_type == 'private'): ?>
        Private Methods
    <?php elseif ($property_type == 'protected'): ?>
        Protected Methods
    <?php endif;?>
</h2>

<p><a href="#" class="toggle">Hide inherited methods</a></p>

<table class="summary-table table table-striped table-bordered table-hover">
<colgroup>
    <col class="col-method" />
    <col class="col-description" />
    <col class="col-defined" />
</colgroup>
<tr>
  <th>Method</th><th>Description</th><th>Defined By</th>
</tr>
<?php
$methods = $type->methods;
ArrayHelper::multisort($methods, 'name');
foreach ($methods as $method): ?>
    <?php if ($method->visibility == $property_type): ?>
    <tr<?= $method->definedBy != $type->name ? ' class="inherited"' : '' ?> id="<?= $method->name ?>()">
        <td><?= $renderer->createSubjectLink($method, $method->name.'()') ?></td>
        <td><?= ApiMarkdown::process($method->shortDescription, $method->definedBy, true) ?></td>
        <td><?= $renderer->createTypeLink($method->definedBy, $type) ?></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>
</table>
</div>
