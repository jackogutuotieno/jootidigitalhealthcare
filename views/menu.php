<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(271, "mi_Dashboard2", $Language->menuPhrase("271", "MenuText"), "dashboard2", -1, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard'), false, false, "fa-home", "", false, true);
$sideMenu->addMenuItem(38, "mci_Administrator", $Language->menuPhrase("38", "MenuText"), "", -1, "", true, false, true, "fa-cogs", "", false, true);
$sideMenu->addMenuItem(18, "mi_jdh_users", $Language->menuPhrase("18", "MenuText"), "jdhuserslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users'), false, false, "fa-user", "", false, true);
$sideMenu->addMenuItem(22, "mi_jdh_departments", $Language->menuPhrase("22", "MenuText"), "jdhdepartmentslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(292, "mi_jdh_facility_units", $Language->menuPhrase("292", "MenuText"), "jdhfacilityunitslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_facility_units'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(25, "mi_jdh_roles", $Language->menuPhrase("25", "MenuText"), "jdhroleslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles'), false, false, "fa-cogs", "", false, true);
$sideMenu->addMenuItem(276, "mi_jdh_doctor_charges", $Language->menuPhrase("276", "MenuText"), "jdhdoctorchargeslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_doctor_charges'), false, false, "fa-user-md", "", false, true);
$sideMenu->addMenuItem(285, "mi_jdh_branding", $Language->menuPhrase("285", "MenuText"), "jdhbrandinglist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_branding'), false, false, "fa-paintbrush", "", false, true);
$sideMenu->addMenuItem(282, "mi_jdh_wards", $Language->menuPhrase("282", "MenuText"), "jdhwardslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_wards'), false, false, "fa-hospital", "", false, true);
$sideMenu->addMenuItem(290, "mi_jdh_beds", $Language->menuPhrase("290", "MenuText"), "jdhbedslist", 38, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_beds'), false, false, "fa-bed", "", false, true);
$sideMenu->addMenuItem(102, "mci_Patients", $Language->menuPhrase("102", "MenuText"), "", -1, "", true, false, true, "fa-users", "", false, true);
$sideMenu->addMenuItem(10, "mi_jdh_patients", $Language->menuPhrase("10", "MenuText"), "jdhpatientslist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients'), false, false, "fa-users", "", false, true);
$sideMenu->addMenuItem(69, "mi_Patient_Appointments", $Language->menuPhrase("69", "MenuText"), "patientappointments", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(8, "mi_jdh_patient_cases", $Language->menuPhrase("8", "MenuText"), "jdhpatientcaseslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases'), false, false, "fa-notes-medical", "", false, true);
$sideMenu->addMenuItem(104, "mi_jdh_chief_complaints", $Language->menuPhrase("104", "MenuText"), "jdhchiefcomplaintslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints'), false, false, "fa-book-medical", "", false, true);
$sideMenu->addMenuItem(279, "mi_jdh_patient_queue", $Language->menuPhrase("279", "MenuText"), "jdhpatientqueuelist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_queue'), false, false, "fa-tasks", "", false, true);
$sideMenu->addMenuItem(106, "mi_jdh_examination_findings", $Language->menuPhrase("106", "MenuText"), "jdhexaminationfindingslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings'), false, false, "fa-book-medical", "", false, true);
$sideMenu->addMenuItem(19, "mi_jdh_visit_types", $Language->menuPhrase("19", "MenuText"), "jdhvisittypeslist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types'), false, false, "fa-calendar-days", "", false, true);
$sideMenu->addMenuItem(20, "mi_jdh_vitals", $Language->menuPhrase("20", "MenuText"), "jdhvitalslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals'), false, false, "fa-thermometer", "", false, true);
$sideMenu->addMenuItem(11, "mi_jdh_prescriptions", $Language->menuPhrase("11", "MenuText"), "jdhprescriptionslist?cmd=resetall", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions'), false, false, "fa-file-prescription", "", false, true);
$sideMenu->addMenuItem(291, "mi_jdh_ipd_admission", $Language->menuPhrase("291", "MenuText"), "jdhipdadmissionlist", 102, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_ipd_admission'), false, false, "fa-bed", "", false, true);
$sideMenu->addMenuItem(289, "mi_subscriptions", $Language->menuPhrase("289", "MenuText"), "subscriptionslist", -1, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}subscriptions'), false, false, "fa-cog", "", false, true);
$sideMenu->addMenuItem(149, "mci_Investigations", $Language->menuPhrase("149", "MenuText"), "", -1, "", true, false, true, "fa-flask", "", false, true);
$sideMenu->addMenuItem(3, "mi_jdh_lab_test_categories", $Language->menuPhrase("3", "MenuText"), "jdhlabtestcategorieslist", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories'), false, false, "fa-vial", "", false, true);
$sideMenu->addMenuItem(4, "mi_jdh_lab_test_subcategories", $Language->menuPhrase("4", "MenuText"), "jdhlabtestsubcategorieslist", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories'), false, false, "fa-vial", "", false, true);
$sideMenu->addMenuItem(17, "mi_jdh_test_requests", $Language->menuPhrase("17", "MenuText"), "jdhtestrequestslist?cmd=resetall", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests'), false, false, "fa-file-waveform", "", false, true);
$sideMenu->addMenuItem(16, "mi_jdh_test_reports", $Language->menuPhrase("16", "MenuText"), "jdhtestreportslist?cmd=resetall", 149, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports'), false, false, "fa-file-medical", "", false, true);
$sideMenu->addMenuItem(68, "mci_Pharmacy", $Language->menuPhrase("68", "MenuText"), "", -1, "", true, false, true, "fa-suitcase-medical", "", false, true);
$sideMenu->addMenuItem(5, "mi_jdh_medicine_categories", $Language->menuPhrase("5", "MenuText"), "jdhmedicinecategorieslist", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(7, "mi_jdh_medicines", $Language->menuPhrase("7", "MenuText"), "jdhmedicineslist", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(273, "mi_jdh_prescriptions_actions", $Language->menuPhrase("273", "MenuText"), "jdhprescriptionsactionslist?cmd=resetall", 68, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions'), false, false, "fa-file-prescription", "", false, true);
$sideMenu->addMenuItem(141, "mci_Services", $Language->menuPhrase("141", "MenuText"), "", -1, "", true, false, true, "fa-file-circle-check", "", false, true);
$sideMenu->addMenuItem(12, "mi_jdh_service_category", $Language->menuPhrase("12", "MenuText"), "jdhservicecategorylist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(13, "mi_jdh_service_subcategory", $Language->menuPhrase("13", "MenuText"), "jdhservicesubcategorylist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(14, "mi_jdh_services", $Language->menuPhrase("14", "MenuText"), "jdhserviceslist", 141, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services'), false, false, "fa-file-circle-check", "", false, true);
$sideMenu->addMenuItem(60, "mci_Financials", $Language->menuPhrase("60", "MenuText"), "", -1, "", true, false, true, "fa-money-bill-transfer", "", false, true);
$sideMenu->addMenuItem(293, "mi_jdh_invoice", $Language->menuPhrase("293", "MenuText"), "jdhinvoicelist", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_invoice'), false, false, "fa-print", "", false, true);
$sideMenu->addMenuItem(294, "mi_jdh_invoice_items", $Language->menuPhrase("294", "MenuText"), "jdhinvoiceitemslist?cmd=resetall", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_invoice_items'), false, false, "fa-print", "", false, true);
$sideMenu->addMenuItem(30, "mi_jdh_insurance", $Language->menuPhrase("30", "MenuText"), "jdhinsurancelist", 60, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance'), false, false, "fa-shield-alt", "", false, true);
$sideMenu->addMenuItem(270, "mci_Inventory", $Language->menuPhrase("270", "MenuText"), "", -1, "", true, false, true, "fa-store", "", false, true);
$sideMenu->addMenuItem(230, "mi_jdh_medicine_stock", $Language->menuPhrase("230", "MenuText"), "jdhmedicinestocklist", 270, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock'), false, false, "fa-pills", "", false, true);
$sideMenu->addMenuItem(190, "mci_Reports", $Language->menuPhrase("190", "MenuText"), "", -1, "", true, false, true, "fa-file", "", false, true);
$sideMenu->addMenuItem(274, "mi_jdh_pharmacy_income", $Language->menuPhrase("274", "MenuText"), "jdhpharmacyincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(275, "mi_jdh_registration_income", $Language->menuPhrase("275", "MenuText"), "jdhregistrationincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_registration_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(277, "mi_jdh_consultation_income", $Language->menuPhrase("277", "MenuText"), "jdhconsultationincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_consultation_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(278, "mi_jdh_lab_income", $Language->menuPhrase("278", "MenuText"), "jdhlabincomelist", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_income'), false, false, "fa-file-invoice", "", false, true);
$sideMenu->addMenuItem(280, "mi_Patient_Queues", $Language->menuPhrase("280", "MenuText"), "patientqueues", 190, "", AllowListMenu('{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Queues'), false, false, "fa-file-invoice", "", false, true);
echo $sideMenu->toScript();
