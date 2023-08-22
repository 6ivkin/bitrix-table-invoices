<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Proxima\Service\Component\Form;

Extension::load(['ui.alerts', 'ui.forms', 'proxima.bootstrap4']);

/**@var CAllMain $APPLICATION */
/**@var CBitrixComponentTemplate $this */
/**@var CITBBurkovGameEdit $component */
$component = $this->getComponent();
$dateFrom = $_POST['DATE_FROM'] ?? '';
$dateTo = $_POST['DATE_TO'] ?? '';

$sum = $arResult['SUM'] ?? 0;
?>

<form method="post">
    <label for="date_from">Дата от:</label>
    <input type="text" class="date-from" name="DATE_FROM" value="<?= date("d.m.Y", time() - 86400); ?>" onclick="BX.calendar({node: this, field: this, bTime: false});">
    <label for="date_to">Дата до:</label>
    <input type="text" class="date-to" name="DATE_TO" value="<?= date("d.m.Y"); ?>" onclick="BX.calendar({node: this, field: this, bTime: false});">
    <button type="submit">Calculate Sum</button>
</form>

<p>Sum: <?= $sum ?></p>
