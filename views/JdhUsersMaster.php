<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Table
$jdh_users = Container("jdh_users");
?>
<?php if ($jdh_users->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jdh_usersmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jdh_users->first_name->Visible) { // first_name ?>
        <tr id="r_first_name"<?= $jdh_users->first_name->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->first_name->caption() ?></td>
            <td<?= $jdh_users->first_name->cellAttributes() ?>>
<span id="el_jdh_users_first_name">
<span<?= $jdh_users->first_name->viewAttributes() ?>>
<?= $jdh_users->first_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_users->last_name->Visible) { // last_name ?>
        <tr id="r_last_name"<?= $jdh_users->last_name->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->last_name->caption() ?></td>
            <td<?= $jdh_users->last_name->cellAttributes() ?>>
<span id="el_jdh_users_last_name">
<span<?= $jdh_users->last_name->viewAttributes() ?>>
<?= $jdh_users->last_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_users->national_id->Visible) { // national_id ?>
        <tr id="r_national_id"<?= $jdh_users->national_id->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->national_id->caption() ?></td>
            <td<?= $jdh_users->national_id->cellAttributes() ?>>
<span id="el_jdh_users_national_id">
<span<?= $jdh_users->national_id->viewAttributes() ?>>
<?= $jdh_users->national_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_users->email_address->Visible) { // email_address ?>
        <tr id="r_email_address"<?= $jdh_users->email_address->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->email_address->caption() ?></td>
            <td<?= $jdh_users->email_address->cellAttributes() ?>>
<span id="el_jdh_users_email_address">
<span<?= $jdh_users->email_address->viewAttributes() ?>>
<?php if (!EmptyString($jdh_users->email_address->getViewValue()) && $jdh_users->email_address->linkAttributes() != "") { ?>
<a<?= $jdh_users->email_address->linkAttributes() ?>><?= $jdh_users->email_address->getViewValue() ?></a>
<?php } else { ?>
<?= $jdh_users->email_address->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_users->phone->Visible) { // phone ?>
        <tr id="r_phone"<?= $jdh_users->phone->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->phone->caption() ?></td>
            <td<?= $jdh_users->phone->cellAttributes() ?>>
<span id="el_jdh_users_phone">
<span<?= $jdh_users->phone->viewAttributes() ?>>
<?php if (!EmptyString($jdh_users->phone->getViewValue()) && $jdh_users->phone->linkAttributes() != "") { ?>
<a<?= $jdh_users->phone->linkAttributes() ?>><?= $jdh_users->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $jdh_users->phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_users->department_id->Visible) { // department_id ?>
        <tr id="r_department_id"<?= $jdh_users->department_id->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->department_id->caption() ?></td>
            <td<?= $jdh_users->department_id->cellAttributes() ?>>
<span id="el_jdh_users_department_id">
<span<?= $jdh_users->department_id->viewAttributes() ?>>
<?= $jdh_users->department_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jdh_users->role_id->Visible) { // role_id ?>
        <tr id="r_role_id"<?= $jdh_users->role_id->rowAttributes() ?>>
            <td class="<?= $jdh_users->TableLeftColumnClass ?>"><?= $jdh_users->role_id->caption() ?></td>
            <td<?= $jdh_users->role_id->cellAttributes() ?>>
<span id="el_jdh_users_role_id">
<span<?= $jdh_users->role_id->viewAttributes() ?>>
<?= $jdh_users->role_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
