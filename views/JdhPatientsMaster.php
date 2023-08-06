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
<?php if ($jdh_patients->patient_national_id->Visible) { // patient_national_id ?>
        <tr id="r_patient_national_id"<?= $jdh_patients->patient_national_id->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_national_id->caption() ?></td>
            <td<?= $jdh_patients->patient_national_id->cellAttributes() ?>>
<span id="el_jdh_patients_patient_national_id">
<span<?= $jdh_patients->patient_national_id->viewAttributes() ?>>
<?= $jdh_patients->patient_national_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_first_name->Visible) { // patient_first_name ?>
        <tr id="r_patient_first_name"<?= $jdh_patients->patient_first_name->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_first_name->caption() ?></td>
            <td<?= $jdh_patients->patient_first_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_first_name">
<span<?= $jdh_patients->patient_first_name->viewAttributes() ?>>
<?= $jdh_patients->patient_first_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_last_name->Visible) { // patient_last_name ?>
        <tr id="r_patient_last_name"<?= $jdh_patients->patient_last_name->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_last_name->caption() ?></td>
            <td<?= $jdh_patients->patient_last_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_last_name">
<span<?= $jdh_patients->patient_last_name->viewAttributes() ?>>
<?= $jdh_patients->patient_last_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_patients->patient_dob->Visible) { // patient_dob ?>
        <tr id="r_patient_dob"<?= $jdh_patients->patient_dob->rowAttributes() ?>>
            <td class="<?= $jdh_patients->TableLeftColumnClass ?>"><?= $jdh_patients->patient_dob->caption() ?></td>
            <td<?= $jdh_patients->patient_dob->cellAttributes() ?>>
<span id="el_jdh_patients_patient_dob">
<span<?= $jdh_patients->patient_dob->viewAttributes() ?>>
<?= $jdh_patients->patient_dob->getViewValue() ?></span>
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
    </tbody>
</table>
</div>
<?php } ?>
