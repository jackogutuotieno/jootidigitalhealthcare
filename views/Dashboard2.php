<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Dashboard Page object
$Dashboard2 = $Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Dashboard2: currentTable } });
var currentPageID = ew.PAGE_ID = "dashboard";
var currentForm;
var fDashboard2dashboard;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fDashboard2dashboard")
        .setPageId("dashboard")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar">
<?php
    $Page->ExportOptions->render("body");
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="ew-dashboard">
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Patients
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-users"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_patients";
                            $total_patients = ExecuteScalar($sql);
                            echo $total_patients;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Receptionists
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-phone-office"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=1";
                            $total_receptionists = ExecuteScalar($sql);
                            echo $total_receptionists;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Doctors
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-user-md"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=2";
                            $total_doctors = ExecuteScalar($sql);
                            echo $total_doctors;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Nurses
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-user-nurse"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=3";
                            $total_nurses = ExecuteScalar($sql);
                            echo $total_nurses;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Lab Technicians
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-flask-vial"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=4";
                            $total_lab_techs = ExecuteScalar($sql);
                            echo $total_lab_techs;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Pharmacists
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-pills"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=5";
                            $total_pharmacists = ExecuteScalar($sql);
                            echo $total_pharmacists;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Accountants
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-money-bill-transfer"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=6";
                            $total_accountants = ExecuteScalar($sql);
                            echo $total_accountants;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Inventory Managers
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-money-bill-transfer"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql = "SELECT COUNT(*) FROM jdh_users WHERE role_id=7";
                            $total_stores = ExecuteScalar($sql);
                            echo $total_stores;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card counters">
                <div class="card-header">
                    Total Income(KES)
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-file"></i></p>
                    <p class="record-count">
                        <?php
                            $conn =& DbHelper();
                            $sql1 = "SELECT SUM(service_cost) FROM jdh_lab_income";
                            $lab_income = ExecuteScalar($sql1);
                            $sql2 = "SELECT SUM(selling_price * units_given) FROM jdh_pharmacy_income";
                            $pharmacy_income = ExecuteScalar($sql2);
                            $sql3 = "SELECT SUM(service_cost) FROM jdh_registration_income";
                            $registration_income = ExecuteScalar($sql3);
                            $sql4 = "SELECT SUM(service_cost) FROM jdh_consultation_income";
                            $consultation_income = ExecuteScalar($sql4);
                            echo $pharmacy_income + $lab_income + $registration_income + $consultation_income;
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Patient Queues</h3>
            <?= $Dashboard2->renderItem($this, 1) ?>
        </div>
    </div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<script>
loadjs.ready("load", () => jQuery('[data-card-widget="card-refresh"]')
    .on("loaded.fail.lte.cardrefresh", (e, jqXHR, textStatus, errorThrown) => console.error(errorThrown))
    .on("loaded.success.lte.cardrefresh", (e, result) => !ew.getError(result) || console.error(result)));
</script>
<?php if ($Dashboard2->isExport() && !$Dashboard2->isExport("print")) { ?>
<script class="ew-export-dashboard">
loadjs.ready("load", function() {
    ew.exportCustom("ew-dashboard", "<?= $Dashboard2->Export ?>", "Dashboard2");
    loadjs.done("exportdashboard");
});
</script>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
