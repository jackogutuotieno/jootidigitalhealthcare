<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_invoice = Container("jdh_invoice");
?>
<?php if ($jdh_invoice->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_invoicemaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_invoice->id->Visible) { // id ?>
        <tr id="r_id"<?= $jdh_invoice->id->rowAttributes() ?>>
            <td class="<?= $jdh_invoice->TableLeftColumnClass ?>"><?= $jdh_invoice->id->caption() ?></td>
            <td<?= $jdh_invoice->id->cellAttributes() ?>>
<span id="el_jdh_invoice_id">
<span<?= $jdh_invoice->id->viewAttributes() ?>>
<?= $jdh_invoice->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_invoice->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $jdh_invoice->patient_id->rowAttributes() ?>>
            <td class="<?= $jdh_invoice->TableLeftColumnClass ?>"><?= $jdh_invoice->patient_id->caption() ?></td>
            <td<?= $jdh_invoice->patient_id->cellAttributes() ?>>
<span id="el_jdh_invoice_patient_id">
<span<?= $jdh_invoice->patient_id->viewAttributes() ?>>
<?= $jdh_invoice->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_invoice->invoice_title->Visible) { // invoice_title ?>
        <tr id="r_invoice_title"<?= $jdh_invoice->invoice_title->rowAttributes() ?>>
            <td class="<?= $jdh_invoice->TableLeftColumnClass ?>"><?= $jdh_invoice->invoice_title->caption() ?></td>
            <td<?= $jdh_invoice->invoice_title->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_title">
<span<?= $jdh_invoice->invoice_title->viewAttributes() ?>>
<?= $jdh_invoice->invoice_title->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_invoice->invoice_date->Visible) { // invoice_date ?>
        <tr id="r_invoice_date"<?= $jdh_invoice->invoice_date->rowAttributes() ?>>
            <td class="<?= $jdh_invoice->TableLeftColumnClass ?>"><?= $jdh_invoice->invoice_date->caption() ?></td>
            <td<?= $jdh_invoice->invoice_date->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_date">
<span<?= $jdh_invoice->invoice_date->viewAttributes() ?>>
<?= $jdh_invoice->invoice_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
