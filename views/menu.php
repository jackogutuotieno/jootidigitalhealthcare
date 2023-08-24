<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(38, "mci_Administrator", $MenuLanguage->MenuPhrase("38", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-cogs", "", false, true);
$sideMenu->addMenuItem(18, "mi_jdh_users", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "jdhuserslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users'), false, false, "fa-user", "", false, true);
$sideMenu->addMenuItem(22, "mi_jdh_departments", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "jdhdepartmentslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(25, "mi_jdh_roles", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "jdhroleslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles'), false, false, "fa-cogs", "", false, true);
$sideMenu->addMenuItem(26, "mi_jdh_audittrail", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "jdhaudittraillist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail'), false, false, "fa-print", "", false, true);
$sideMenu->addMenuItem(28, "mi_jdh_exportlog", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "jdhexportloglist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog'), false, false, "fa-print", "", false, true);
$sideMenu->addMenuItem(102, "mci_Patients", $MenuLanguage->MenuPhrase("102", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-users", "", false, true);
$sideMenu->addMenuItem(10, "mi_jdh_patients", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "jdhpatientslist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients'), false, false, "fa-users", "", false, true);
$sideMenu->addMenuItem(1, "mi_jdh_appointments", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "jdhappointmentslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(69, "mi_Patient_Appointments", $MenuLanguage->MenuPhrase("69", "MenuText"), $MenuRelativePath . "patientappointments", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(9, "mi_jdh_patient_visits", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "jdhpatientvisitslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(8, "mi_jdh_patient_cases", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "jdhpatientcaseslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases'), false, false, "fa-notes-medical", "", false, true);
$sideMenu->addMenuItem(104, "mi_jdh_chief_complaints", $MenuLanguage->MenuPhrase("104", "MenuText"), $MenuRelativePath . "jdhchiefcomplaintslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints'), false, false, "fa-book-medical", "", false, true);
$sideMenu->addMenuItem(106, "mi_jdh_examination_findings", $MenuLanguage->MenuPhrase("106", "MenuText"), $MenuRelativePath . "jdhexaminationfindingslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings'), false, false, "fa-book-medical", "", false, true);
$sideMenu->addMenuItem(19, "mi_jdh_visit_types", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "jdhvisittypeslist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(20, "mi_jdh_vitals", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "jdhvitalslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals'), false, false, "fa-thermometer", "", false, true);
$sideMenu->addMenuItem(11, "mi_jdh_prescriptions", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "jdhprescriptionslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions'), false, false, "fa-file-prescription", "", false, true);
$sideMenu->addMenuItem(149, "mci_Investigations", $MenuLanguage->MenuPhrase("149", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-flask", "", false, true);
$sideMenu->addMenuItem(37, "mci_Laboratory", $MenuLanguage->MenuPhrase("37", "MenuText"), "", 149, "", IsLoggedIn(), false, true, "fa-flask", "", false, true);
$sideMenu->addMenuItem(3, "mi_jdh_lab_test_categories", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "jdhlabtestcategorieslist", 37, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories'), false, false, "fa-vial", "", false, true);
$sideMenu->addMenuItem(4, "mi_jdh_lab_test_subcategories", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "jdhlabtestsubcategorieslist", 37, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories'), false, false, "fa-vial", "", false, true);
$sideMenu->addMenuItem(17, "mi_jdh_test_requests", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "jdhtestrequestslist?cmd=resetall", 37, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests'), false, false, "fa-file-waveform", "", false, true);
$sideMenu->addMenuItem(16, "mi_jdh_test_reports", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "jdhtestreportslist?cmd=resetall", 37, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports'), false, false, "fa-file-medical", "", false, true);
$sideMenu->addMenuItem(68, "mci_Pharmacy", $MenuLanguage->MenuPhrase("68", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-suitcase-medical", "", false, true);
$sideMenu->addMenuItem(5, "mi_jdh_medicine_categories", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "jdhmedicinecategorieslist", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(7, "mi_jdh_medicines", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "jdhmedicineslist", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(141, "mci_Services", $MenuLanguage->MenuPhrase("141", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-file-circle-check", "", false, true);
$sideMenu->addMenuItem(12, "mi_jdh_service_category", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "jdhservicecategorylist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(13, "mi_jdh_service_subcategory", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "jdhservicesubcategorylist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(14, "mi_jdh_services", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "jdhserviceslist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services'), false, false, "fa-file-circle-check", "", false, true);
$sideMenu->addMenuItem(60, "mci_Financials", $MenuLanguage->MenuPhrase("60", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-money-bill-transfer", "", false, true);
$sideMenu->addMenuItem(30, "mi_jdh_insurance", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "jdhinsurancelist", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance'), false, false, "fa-shield-alt", "", false, true);
$sideMenu->addMenuItem(229, "mci_Billing", $MenuLanguage->MenuPhrase("229", "MenuText"), "", 60, "", IsLoggedIn(), false, true, "", "", false, true);
$sideMenu->addMenuItem(191, "mi_jdh_lab_billing", $MenuLanguage->MenuPhrase("191", "MenuText"), $MenuRelativePath . "jdhlabbillinglist", 229, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing'), false, false, "", "", false, true);
$sideMenu->addMenuItem(270, "mci_Inventory", $MenuLanguage->MenuPhrase("270", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-store", "", false, true);
$sideMenu->addMenuItem(230, "mi_jdh_medicine_stock", $MenuLanguage->MenuPhrase("230", "MenuText"), $MenuRelativePath . "jdhmedicinestocklist", 270, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(190, "mci_Reports", $MenuLanguage->MenuPhrase("190", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-file", "", false, true);
echo $sideMenu->toScript();
