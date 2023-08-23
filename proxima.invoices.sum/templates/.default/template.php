<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Proxima\Service\Component\Form;

Extension::load(['ui.alerts', 'ui.forms', 'proxima.bootstrap4']);

/**@var CAllMain $APPLICATION */
/**@var CBitrixComponentTemplate $this */
/**@var CITBBurkovGameEdit $component */
$component = $this->getComponent();

$sum = $arResult['SUM'] ?? 0;
?>

<?php if ($component->getRoute()->getAction() === $component->getRoute()->getDefaultAction()) : ?>
<?php $APPLICATION->SetTitle('Сумма оплаченных счетов'); ?>
<?php endif; ?>

<style>
    .form-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .submit-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }

    .sum-container {
        margin-top: 20px;
        text-align: center;
    }

    .sum {
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
    }
</style>

<form method="post">
    <label for="date_from">Дата от:</label>
    <select class="form-input" name="DATE_FROM">
        <?php
        $startDate = strtotime('-7 days'); // 7 days ago
        $endDate = time(); // current date

        for ($date = $startDate; $date <= $endDate; $date += 86400) {
            $dateFormatted = date('d.m.Y', $date);
            $selected = ($_POST['DATE_FROM'] ?? date('d.m.Y', time() - 86400)) === $dateFormatted ? 'selected' : '';
            echo '<option value="' . $dateFormatted . '" ' . $selected . '>' . $dateFormatted . '</option>';
        }
        ?>
    </select>

    <label for="date_to">Дата до:</label>
    <select class="form-input" name="DATE_TO">
        <?php
        for ($date = $startDate; $date <= $endDate; $date += 86400) {
            $dateFormatted = date('d.m.Y', $date);
            $selected = ($_POST['DATE_TO'] ?? date('d.m.Y')) === $dateFormatted ? 'selected' : '';
            echo '<option value="' . $dateFormatted . '" ' . $selected . '>' . $dateFormatted . '</option>';
        }
        ?>
    </select>

    <button type="submit" class="submit-button">Подсчет суммы</button>

    <?php if ($sum > 0): ?>
        <div class="sum-container">
            <p class="sum">Сумма: <?= number_format($sum, 2, '.', ' ') ?> руб.</p>
        </div>
    <?php endif; ?>
</form>
