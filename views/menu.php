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
$sideMenu->addMenuItem(271, "mi_Dashboard2", $MenuLanguage->MenuPhrase("271", "MenuText"), $MenuRelativePath . "dashboard2", -1, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard'), false, false, "fa-home", "", false, true);
$sideMenu->addMenuItem(38, "mci_Administrator", $MenuLanguage->MenuPhrase("38", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-cogs", "", false, true);
$sideMenu->addMenuItem(18, "mi_jdh_users", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "jdhuserslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users'), false, false, "fa-user", "", false, true);
$sideMenu->addMenuItem(22, "mi_jdh_departments", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "jdhdepartmentslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(292, "mi_jdh_facility_units", $MenuLanguage->MenuPhrase("292", "MenuText"), $MenuRelativePath . "jdhfacilityunitslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_facility_units'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(25, "mi_jdh_roles", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "jdhroleslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles'), false, false, "fa-cogs", "", false, true);
$sideMenu->addMenuItem(276, "mi_jdh_doctor_charges", $MenuLanguage->MenuPhrase("276", "MenuText"), $MenuRelativePath . "jdhdoctorchargeslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_doctor_charges'), false, false, "fa-user-md", "", false, true);
$sideMenu->addMenuItem(285, "mi_jdh_branding", $MenuLanguage->MenuPhrase("285", "MenuText"), $MenuRelativePath . "jdhbrandinglist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_branding'), false, false, "fa-paintbrush", "", false, true);
$sideMenu->addMenuItem(282, "mi_jdh_wards", $MenuLanguage->MenuPhrase("282", "MenuText"), $MenuRelativePath . "jdhwardslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_wards'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(290, "mi_jdh_beds", $MenuLanguage->MenuPhrase("290", "MenuText"), $MenuRelativePath . "jdhbedslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_beds'), false, false, "fa-bed", "", false, true);
$sideMenu->addMenuItem(102, "mci_Patients", $MenuLanguage->MenuPhrase("102", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-users", "", false, true);
$sideMenu->addMenuItem(10, "mi_jdh_patients", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "jdhpatientslist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients'), false, false, "fa-users", "", false, true);
$sideMenu->addMenuItem(69, "mi_Patient_Appointments", $MenuLanguage->MenuPhrase("69", "MenuText"), $MenuRelativePath . "patientappointments", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(8, "mi_jdh_patient_cases", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "jdhpatientcaseslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases'), false, false, "fa-notes-medical", "", false, true);
$sideMenu->addMenuItem(104, "mi_jdh_chief_complaints", $MenuLanguage->MenuPhrase("104", "MenuText"), $MenuRelativePath . "jdhchiefcomplaintslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints'), false, false, "fa-book-medical", "", false, true);
$sideMenu->addMenuItem(279, "mi_jdh_patient_queue", $MenuLanguage->MenuPhrase("279", "MenuText"), $MenuRelativePath . "jdhpatientqueuelist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_queue'), false, false, "fa-tasks", "", false, true);
$sideMenu->addMenuItem(106, "mi_jdh_examination_findings", $MenuLanguage->MenuPhrase("106", "MenuText"), $MenuRelativePath . "jdhexaminationfindingslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings'), false, false, "fa-book-medical", "", false, true);
$sideMenu->addMenuItem(19, "mi_jdh_visit_types", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "jdhvisittypeslist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(20, "mi_jdh_vitals", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "jdhvitalslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals'), false, false, "fa-thermometer", "", false, true);
$sideMenu->addMenuItem(11, "mi_jdh_prescriptions", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "jdhprescriptionslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions'), false, false, "fa-file-prescription", "", false, true);
$sideMenu->addMenuItem(291, "mi_jdh_ipd_admission", $MenuLanguage->MenuPhrase("291", "MenuText"), $MenuRelativePath . "jdhipdadmissionlist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_ipd_admission'), false, false, "fa-bed", "", false, true);
$sideMenu->addMenuItem(289, "mi_subscriptions", $MenuLanguage->MenuPhrase("289", "MenuText"), $MenuRelativePath . "subscriptionslist", -1, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}subscriptions'), false, false, "fa-cog", "", false, true);
$sideMenu->addMenuItem(149, "mci_Investigations", $MenuLanguage->MenuPhrase("149", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-flask", "", false, true);
$sideMenu->addMenuItem(3, "mi_jdh_lab_test_categories", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "jdhlabtestcategorieslist", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories'), false, false, "fa-vial", "", false, true);
$sideMenu->addMenuItem(4, "mi_jdh_lab_test_subcategories", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "jdhlabtestsubcategorieslist", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories'), false, false, "fa-vial", "", false, true);
$sideMenu->addMenuItem(17, "mi_jdh_test_requests", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "jdhtestrequestslist?cmd=resetall", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests'), false, false, "fa-file-waveform", "", false, true);
$sideMenu->addMenuItem(16, "mi_jdh_test_reports", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "jdhtestreportslist?cmd=resetall", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports'), false, false, "fa-file-medical", "", false, true);
$sideMenu->addMenuItem(68, "mci_Pharmacy", $MenuLanguage->MenuPhrase("68", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-suitcase-medical", "", false, true);
$sideMenu->addMenuItem(5, "mi_jdh_medicine_categories", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "jdhmedicinecategorieslist", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(7, "mi_jdh_medicines", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "jdhmedicineslist", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(273, "mi_jdh_prescriptions_actions", $MenuLanguage->MenuPhrase("273", "MenuText"), $MenuRelativePath . "jdhprescriptionsactionslist?cmd=resetall", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions'), false, false, "fa-file-prescription", "", false, true);
$sideMenu->addMenuItem(141, "mci_Services", $MenuLanguage->MenuPhrase("141", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-file-circle-check", "", false, true);
$sideMenu->addMenuItem(12, "mi_jdh_service_category", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "jdhservicecategorylist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(13, "mi_jdh_service_subcategory", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "jdhservicesubcategorylist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(14, "mi_jdh_services", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "jdhserviceslist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services'), false, false, "fa-file-circle-check", "", false, true);
$sideMenu->addMenuItem(60, "mci_Financials", $MenuLanguage->MenuPhrase("60", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-money-bill-transfer", "", false, true);
$sideMenu->addMenuItem(293, "mi_jdh_invoice", $MenuLanguage->MenuPhrase("293", "MenuText"), $MenuRelativePath . "jdhinvoicelist", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_invoice'), false, false, "fa-print", "", false, true);
$sideMenu->addMenuItem(294, "mi_jdh_invoice_items", $MenuLanguage->MenuPhrase("294", "MenuText"), $MenuRelativePath . "jdhinvoiceitemslist?cmd=resetall", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_invoice_items'), false, false, "fa-print", "", false, true);
$sideMenu->addMenuItem(30, "mi_jdh_insurance", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "jdhinsurancelist", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance'), false, false, "fa-shield-alt", "", false, true);
$sideMenu->addMenuItem(270, "mci_Inventory", $MenuLanguage->MenuPhrase("270", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-store", "", false, true);
$sideMenu->addMenuItem(230, "mi_jdh_medicine_stock", $MenuLanguage->MenuPhrase("230", "MenuText"), $MenuRelativePath . "jdhmedicinestocklist", 270, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(190, "mci_Reports", $MenuLanguage->MenuPhrase("190", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-file", "", false, true);
$sideMenu->addMenuItem(274, "mi_jdh_pharmacy_income", $MenuLanguage->MenuPhrase("274", "MenuText"), $MenuRelativePath . "jdhpharmacyincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(275, "mi_jdh_registration_income", $MenuLanguage->MenuPhrase("275", "MenuText"), $MenuRelativePath . "jdhregistrationincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_registration_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(277, "mi_jdh_consultation_income", $MenuLanguage->MenuPhrase("277", "MenuText"), $MenuRelativePath . "jdhconsultationincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_consultation_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(278, "mi_jdh_lab_income", $MenuLanguage->MenuPhrase("278", "MenuText"), $MenuRelativePath . "jdhlabincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(280, "mi_Patient_Queues", $MenuLanguage->MenuPhrase("280", "MenuText"), $MenuRelativePath . "patientqueues", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Queues'), false, false, "fa-file-invoice", "", false, true);
echo $sideMenu->toScript();
