<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_vitals = Container("jdh_vitals");
?>
<?php if ($jdh_vitals->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_vitalsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_vitals->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $jdh_vitals->patient_id->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->patient_id->caption() ?></td>
            <td<?= $jdh_vitals->patient_id->cellAttributes() ?>>
<span id="el_jdh_vitals_patient_id">
<span<?= $jdh_vitals->patient_id->viewAttributes() ?>>
<?= $jdh_vitals->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->pressure->Visible) { // pressure ?>
        <tr id="r_pressure"<?= $jdh_vitals->pressure->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->pressure->caption() ?></td>
            <td<?= $jdh_vitals->pressure->cellAttributes() ?>>
<span id="el_jdh_vitals_pressure">
<span<?= $jdh_vitals->pressure->viewAttributes() ?>>
<?= $jdh_vitals->pressure->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->height->Visible) { // height ?>
        <tr id="r_height"<?= $jdh_vitals->height->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->height->caption() ?></td>
            <td<?= $jdh_vitals->height->cellAttributes() ?>>
<span id="el_jdh_vitals_height">
<span<?= $jdh_vitals->height->viewAttributes() ?>>
<?= $jdh_vitals->height->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->weight->Visible) { // weight ?>
        <tr id="r_weight"<?= $jdh_vitals->weight->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->weight->caption() ?></td>
            <td<?= $jdh_vitals->weight->cellAttributes() ?>>
<span id="el_jdh_vitals_weight">
<span<?= $jdh_vitals->weight->viewAttributes() ?>>
<?= $jdh_vitals->weight->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->body_mass_index->Visible) { // body_mass_index ?>
        <tr id="r_body_mass_index"<?= $jdh_vitals->body_mass_index->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->body_mass_index->caption() ?></td>
            <td<?= $jdh_vitals->body_mass_index->cellAttributes() ?>>
<span id="el_jdh_vitals_body_mass_index">
<span<?= $jdh_vitals->body_mass_index->viewAttributes() ?>>
<?= $jdh_vitals->body_mass_index->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->pulse_rate->Visible) { // pulse_rate ?>
        <tr id="r_pulse_rate"<?= $jdh_vitals->pulse_rate->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->pulse_rate->caption() ?></td>
            <td<?= $jdh_vitals->pulse_rate->cellAttributes() ?>>
<span id="el_jdh_vitals_pulse_rate">
<span<?= $jdh_vitals->pulse_rate->viewAttributes() ?>>
<?= $jdh_vitals->pulse_rate->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->respiratory_rate->Visible) { // respiratory_rate ?>
        <tr id="r_respiratory_rate"<?= $jdh_vitals->respiratory_rate->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->respiratory_rate->caption() ?></td>
            <td<?= $jdh_vitals->respiratory_rate->cellAttributes() ?>>
<span id="el_jdh_vitals_respiratory_rate">
<span<?= $jdh_vitals->respiratory_rate->viewAttributes() ?>>
<?= $jdh_vitals->respiratory_rate->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->temperature->Visible) { // temperature ?>
        <tr id="r_temperature"<?= $jdh_vitals->temperature->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->temperature->caption() ?></td>
            <td<?= $jdh_vitals->temperature->cellAttributes() ?>>
<span id="el_jdh_vitals_temperature">
<span<?= $jdh_vitals->temperature->viewAttributes() ?>>
<?= $jdh_vitals->temperature->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <tr id="r_random_blood_sugar"<?= $jdh_vitals->random_blood_sugar->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->random_blood_sugar->caption() ?></td>
            <td<?= $jdh_vitals->random_blood_sugar->cellAttributes() ?>>
<span id="el_jdh_vitals_random_blood_sugar">
<span<?= $jdh_vitals->random_blood_sugar->viewAttributes() ?>>
<?= $jdh_vitals->random_blood_sugar->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->spo_2->Visible) { // spo_2 ?>
        <tr id="r_spo_2"<?= $jdh_vitals->spo_2->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->spo_2->caption() ?></td>
            <td<?= $jdh_vitals->spo_2->cellAttributes() ?>>
<span id="el_jdh_vitals_spo_2">
<span<?= $jdh_vitals->spo_2->viewAttributes() ?>>
<?= $jdh_vitals->spo_2->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->submission_date->Visible) { // submission_date ?>
        <tr id="r_submission_date"<?= $jdh_vitals->submission_date->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->submission_date->caption() ?></td>
            <td<?= $jdh_vitals->submission_date->cellAttributes() ?>>
<span id="el_jdh_vitals_submission_date">
<span<?= $jdh_vitals->submission_date->viewAttributes() ?>>
<?= $jdh_vitals->submission_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_vitals->patient_status->Visible) { // patient_status ?>
        <tr id="r_patient_status"<?= $jdh_vitals->patient_status->rowAttributes() ?>>
            <td class="<?= $jdh_vitals->TableLeftColumnClass ?>"><?= $jdh_vitals->patient_status->caption() ?></td>
            <td<?= $jdh_vitals->patient_status->cellAttributes() ?>>
<span id="el_jdh_vitals_patient_status">
<span<?= $jdh_vitals->patient_status->viewAttributes() ?>>
<?= $jdh_vitals->patient_status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
