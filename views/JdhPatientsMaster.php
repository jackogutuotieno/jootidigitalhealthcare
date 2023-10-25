<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_patients = Container("jdh_patients");
?>
<?php if ($jdh_patients->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_patientsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_patients->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $jdh_patients->patient_id->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_id->caption() ?></td>
            <td<?= $jdh_patients->patient_id->cellAttributes() ?>>
<span id="el_jdh_patients_patient_id">
<span<?= $jdh_patients->patient_id->viewAttributes() ?>>
<?= $jdh_patients->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_ip_number->Visible) { // patient_ip_number ?>
        <tr id="r_patient_ip_number"<?= $jdh_patients->patient_ip_number->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_ip_number->caption() ?></td>
            <td<?= $jdh_patients->patient_ip_number->cellAttributes() ?>>
<span id="el_jdh_patients_patient_ip_number">
<span<?= $jdh_patients->patient_ip_number->viewAttributes() ?>>
<?= $jdh_patients->patient_ip_number->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $jdh_patients->patient_name->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_name->caption() ?></td>
            <td<?= $jdh_patients->patient_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_name">
<span<?= $jdh_patients->patient_name->viewAttributes() ?>>
<?= $jdh_patients->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_dob_year->Visible) { // patient_dob_year ?>
        <tr id="r_patient_dob_year"<?= $jdh_patients->patient_dob_year->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_dob_year->caption() ?></td>
            <td<?= $jdh_patients->patient_dob_year->cellAttributes() ?>>
<span id="el_jdh_patients_patient_dob_year">
<span<?= $jdh_patients->patient_dob_year->viewAttributes() ?>>
<?= $jdh_patients->patient_dob_year->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_age->Visible) { // patient_age ?>
        <tr id="r_patient_age"<?= $jdh_patients->patient_age->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_age->caption() ?></td>
            <td<?= $jdh_patients->patient_age->cellAttributes() ?>>
<span id="el_jdh_patients_patient_age">
<span<?= $jdh_patients->patient_age->viewAttributes() ?>>
<?= $jdh_patients->patient_age->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_gender->Visible) { // patient_gender ?>
        <tr id="r_patient_gender"<?= $jdh_patients->patient_gender->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_gender->caption() ?></td>
            <td<?= $jdh_patients->patient_gender->cellAttributes() ?>>
<span id="el_jdh_patients_patient_gender">
<span<?= $jdh_patients->patient_gender->viewAttributes() ?>>
<?= $jdh_patients->patient_gender->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_phone->Visible) { // patient_phone ?>
        <tr id="r_patient_phone"<?= $jdh_patients->patient_phone->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_phone->caption() ?></td>
            <td<?= $jdh_patients->patient_phone->cellAttributes() ?>>
<span id="el_jdh_patients_patient_phone">
<span<?= $jdh_patients->patient_phone->viewAttributes() ?>>
<?php if (!EmptyString($jdh_patients->patient_phone->getViewValue()) && $jdh_patients->patient_phone->linkAttributes() != "") { ?>
<a<?= $jdh_patients->patient_phone->linkAttributes() ?>><?= $jdh_patients->patient_phone->getViewValue() ?></a>
<?php } else { ?>
<?= $jdh_patients->patient_phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_registration_date->Visible) { // patient_registration_date ?>
        <tr id="r_patient_registration_date"<?= $jdh_patients->patient_registration_date->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_registration_date->caption() ?></td>
            <td<?= $jdh_patients->patient_registration_date->cellAttributes() ?>>
<span id="el_jdh_patients_patient_registration_date">
<span<?= $jdh_patients->patient_registration_date->viewAttributes() ?>>
<?= $jdh_patients->patient_registration_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->is_inpatient->Visible) { // is_inpatient ?>
        <tr id="r_is_inpatient"<?= $jdh_patients->is_inpatient->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->is_inpatient->caption() ?></td>
            <td<?= $jdh_patients->is_inpatient->cellAttributes() ?>>
<span id="el_jdh_patients_is_inpatient">
<span<?= $jdh_patients->is_inpatient->viewAttributes() ?>>
<?= $jdh_patients->is_inpatient->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
