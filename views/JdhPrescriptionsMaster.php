<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_prescriptions = Container("jdh_prescriptions");
?>
<?php if ($jdh_prescriptions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_prescriptionsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_prescriptions->prescription_id->Visible) { // prescription_id ?>
        <tr id="r_prescription_id"<?= $jdh_prescriptions->prescription_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->prescription_id->caption() ?></td>
            <td<?= $jdh_prescriptions->prescription_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_id">
<span<?= $jdh_prescriptions->prescription_id->viewAttributes() ?>>
<?= $jdh_prescriptions->prescription_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $jdh_prescriptions->patient_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->patient_id->caption() ?></td>
            <td<?= $jdh_prescriptions->patient_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_patient_id">
<span<?= $jdh_prescriptions->patient_id->viewAttributes() ?>>
<?= $jdh_prescriptions->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->prescription_title->Visible) { // prescription_title ?>
        <tr id="r_prescription_title"<?= $jdh_prescriptions->prescription_title->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->prescription_title->caption() ?></td>
            <td<?= $jdh_prescriptions->prescription_title->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_title">
<span<?= $jdh_prescriptions->prescription_title->viewAttributes() ?>>
<?= $jdh_prescriptions->prescription_title->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->medicine_id->Visible) { // medicine_id ?>
        <tr id="r_medicine_id"<?= $jdh_prescriptions->medicine_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->medicine_id->caption() ?></td>
            <td<?= $jdh_prescriptions->medicine_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_medicine_id">
<span<?= $jdh_prescriptions->medicine_id->viewAttributes() ?>>
<?= $jdh_prescriptions->medicine_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->tabs->Visible) { // tabs ?>
        <tr id="r_tabs"<?= $jdh_prescriptions->tabs->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->tabs->caption() ?></td>
            <td<?= $jdh_prescriptions->tabs->cellAttributes() ?>>
<span id="el_jdh_prescriptions_tabs">
<span<?= $jdh_prescriptions->tabs->viewAttributes() ?>>
<?= $jdh_prescriptions->tabs->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->frequency->Visible) { // frequency ?>
        <tr id="r_frequency"<?= $jdh_prescriptions->frequency->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->frequency->caption() ?></td>
            <td<?= $jdh_prescriptions->frequency->cellAttributes() ?>>
<span id="el_jdh_prescriptions_frequency">
<span<?= $jdh_prescriptions->frequency->viewAttributes() ?>>
<?= $jdh_prescriptions->frequency->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->prescription_days->Visible) { // prescription_days ?>
        <tr id="r_prescription_days"<?= $jdh_prescriptions->prescription_days->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->prescription_days->caption() ?></td>
            <td<?= $jdh_prescriptions->prescription_days->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_days">
<span<?= $jdh_prescriptions->prescription_days->viewAttributes() ?>>
<?= $jdh_prescriptions->prescription_days->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->prescription_time->Visible) { // prescription_time ?>
        <tr id="r_prescription_time"<?= $jdh_prescriptions->prescription_time->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->prescription_time->caption() ?></td>
            <td<?= $jdh_prescriptions->prescription_time->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_time">
<span<?= $jdh_prescriptions->prescription_time->viewAttributes() ?>>
<?= $jdh_prescriptions->prescription_time->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions->prescription_date->Visible) { // prescription_date ?>
        <tr id="r_prescription_date"<?= $jdh_prescriptions->prescription_date->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions->TableLeftColumnClass ?>"><?= $jdh_prescriptions->prescription_date->caption() ?></td>
            <td<?= $jdh_prescriptions->prescription_date->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_date">
<span<?= $jdh_prescriptions->prescription_date->viewAttributes() ?>>
<?= $jdh_prescriptions->prescription_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
