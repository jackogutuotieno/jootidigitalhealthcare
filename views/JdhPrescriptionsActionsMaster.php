<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_prescriptions_actions = Container("jdh_prescriptions_actions");
?>
<?php if ($jdh_prescriptions_actions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_prescriptions_actionsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_prescriptions_actions->id->Visible) { // id ?>
        <tr id="r_id"<?= $jdh_prescriptions_actions->id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->id->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_id">
<span<?= $jdh_prescriptions_actions->id->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions_actions->prescription_id->Visible) { // prescription_id ?>
        <tr id="r_prescription_id"<?= $jdh_prescriptions_actions->prescription_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->prescription_id->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->prescription_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_prescription_id">
<span<?= $jdh_prescriptions_actions->prescription_id->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->prescription_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions_actions->medicine_id->Visible) { // medicine_id ?>
        <tr id="r_medicine_id"<?= $jdh_prescriptions_actions->medicine_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->medicine_id->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->medicine_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_medicine_id">
<span<?= $jdh_prescriptions_actions->medicine_id->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->medicine_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions_actions->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $jdh_prescriptions_actions->patient_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->patient_id->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->patient_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_patient_id">
<span<?= $jdh_prescriptions_actions->patient_id->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions_actions->units_given->Visible) { // units_given ?>
        <tr id="r_units_given"<?= $jdh_prescriptions_actions->units_given->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->units_given->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->units_given->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_units_given">
<span<?= $jdh_prescriptions_actions->units_given->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->units_given->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions_actions->submittedby_user_id->Visible) { // submittedby_user_id ?>
        <tr id="r_submittedby_user_id"<?= $jdh_prescriptions_actions->submittedby_user_id->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->submittedby_user_id->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->submittedby_user_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_submittedby_user_id">
<span<?= $jdh_prescriptions_actions->submittedby_user_id->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->submittedby_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_prescriptions_actions->submission_date->Visible) { // submission_date ?>
        <tr id="r_submission_date"<?= $jdh_prescriptions_actions->submission_date->rowAttributes() ?>>
            <td class="<?= $jdh_prescriptions_actions->TableLeftColumnClass ?>"><?= $jdh_prescriptions_actions->submission_date->caption() ?></td>
            <td<?= $jdh_prescriptions_actions->submission_date->cellAttributes() ?>>
<span id="el_jdh_prescriptions_actions_submission_date">
<span<?= $jdh_prescriptions_actions->submission_date->viewAttributes() ?>>
<?= $jdh_prescriptions_actions->submission_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
