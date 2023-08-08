<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_test_requests = Container("jdh_test_requests");
?>
<?php if ($jdh_test_requests->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_test_requestsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_test_requests->request_id->Visible) { // request_id ?>
        <tr id="r_request_id"<?= $jdh_test_requests->request_id->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->request_id->caption() ?></td>
            <td<?= $jdh_test_requests->request_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_id">
<span<?= $jdh_test_requests->request_id->viewAttributes() ?>>
<?= $jdh_test_requests->request_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_test_requests->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $jdh_test_requests->patient_id->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->patient_id->caption() ?></td>
            <td<?= $jdh_test_requests->patient_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_patient_id">
<span<?= $jdh_test_requests->patient_id->viewAttributes() ?>>
<?= $jdh_test_requests->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_test_requests->request_title->Visible) { // request_title ?>
        <tr id="r_request_title"<?= $jdh_test_requests->request_title->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->request_title->caption() ?></td>
            <td<?= $jdh_test_requests->request_title->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_title">
<span<?= $jdh_test_requests->request_title->viewAttributes() ?>>
<?= $jdh_test_requests->request_title->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_test_requests->request_category_id->Visible) { // request_category_id ?>
        <tr id="r_request_category_id"<?= $jdh_test_requests->request_category_id->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->request_category_id->caption() ?></td>
            <td<?= $jdh_test_requests->request_category_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_category_id">
<span<?= $jdh_test_requests->request_category_id->viewAttributes() ?>>
<?= $jdh_test_requests->request_category_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_test_requests->request_subcategory_id->Visible) { // request_subcategory_id ?>
        <tr id="r_request_subcategory_id"<?= $jdh_test_requests->request_subcategory_id->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->request_subcategory_id->caption() ?></td>
            <td<?= $jdh_test_requests->request_subcategory_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_subcategory_id">
<span<?= $jdh_test_requests->request_subcategory_id->viewAttributes() ?>>
<?= $jdh_test_requests->request_subcategory_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_test_requests->request_description->Visible) { // request_description ?>
        <tr id="r_request_description"<?= $jdh_test_requests->request_description->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->request_description->caption() ?></td>
            <td<?= $jdh_test_requests->request_description->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_description">
<span<?= $jdh_test_requests->request_description->viewAttributes() ?>>
<?= $jdh_test_requests->request_description->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_test_requests->request_date->Visible) { // request_date ?>
        <tr id="r_request_date"<?= $jdh_test_requests->request_date->rowAttributes() ?>>
            <td class="<?= $jdh_test_requests->TableLeftColumnClass ?>"><?= $jdh_test_requests->request_date->caption() ?></td>
            <td<?= $jdh_test_requests->request_date->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_date">
<span<?= $jdh_test_requests->request_date->viewAttributes() ?>>
<?= $jdh_test_requests->request_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
