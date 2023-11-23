<?php namespace PHPMaker2024\jootidigitalhealthcare; ?>
<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$PatientAppointmentsCalendar = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Appointments: currentTable } });
var currentPageID = ew.PAGE_ID = "calendar";
var currentForm;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<div class="btn-toolbar ew-toolbar">
<?php
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Calendar report (begin) -->
<main class="report-calendar">
    <div class="ew-calendar">
<script>
var currentCalendar; // FullCalendar.Calendar
var calendarLoaded = loadjs.isDefined("fullcalendar");
if (!calendarLoaded) {
    ew.loadjs([
        ew.PATH_BASE + "fullcalendar/index.global.min.js?v=24.4.0",
        ew.PATH_BASE + "fullcalendar/bootstrap5/index.global.min.js?v=24.4.0"
    ], "fullcalendar");
    ew.ready(["fullcalendar", "luxon"], ew.PATH_BASE + "fullcalendar/luxon3/index.global.min.js?v=24.4.0");
}
loadjs.ready(
    ["luxon", "fullcalendar", "makerjs"],
    function () {
        // Override Bootstrap 5 styles and fonts
        FullCalendar.Bootstrap5.Internal.BootstrapTheme.prototype.classes = {
            ...FullCalendar.Bootstrap5.Internal.BootstrapTheme.prototype.classes,
            ...{ root: "fc-theme-bootstrap5", table: null, tableCellShaded: "fc-theme-bootstrap5-shaded" }
        }; // Use Bootstrap 5 styles
        FullCalendar.Bootstrap5.Internal.BootstrapTheme.prototype.baseIconClass = "fa-solid"; // Font Awesome 6 icons
        FullCalendar.Bootstrap5.Internal.BootstrapTheme.prototype.iconClasses = {
            close: "fa-xmark",
            prev: "fa-angle-left",
            next: "fa-angle-right",
            prevYear: "fa-angles-left",
            nextYear: "fa-angles-right",
            add: "fa-plus"
        };
        FullCalendar.Bootstrap5.Internal.BootstrapTheme.prototype.rtlIconClasses = {
            prev: "fa-angle-right",
            next: "fa-angle-left",
            prevYear: "fa-angles-right",
            nextYear: "fa-angles-left",
        };
        FullCalendar.globalLocales.push({ code: ew.LANGUAGE_ID.toLowerCase(), ...ew.language.phrase("fullcalendar") });
        let container = document.getElementById("full-calendar"),
            dropdown = document.getElementById("calendar-dropdown"),
            options = ew.deepAssign({}, ew.calendarOptions, <?= CurrentPage()->getCalendarOptions() ?>);
        try {
            currentCalendar = ew.fullCalendar(container, options, dropdown);
            if (calendarLoaded)
                currentCalendar.refetchEvents();
            currentCalendar.render();
        } finally {
            document.querySelector(".ew-calendar-card").classList.remove("border-transparent");
            if (!calendarLoaded)
                document.querySelector(".overlay").remove();
        }
        // Hide popover on modal shown
        $(".modal").on("show.bs.modal", () => $(".ew-event-popover.show").popover("hide"));
        // Enable right click
        container.addEventListener("contextmenu", (e) => {
            let eventEl = e.target.closest(".fc-event");
            if (eventEl) {
                e.preventDefault();
                e.stopPropagation();
                eventEl.dispatchEvent(new MouseEvent("click", e));
            }
        });
    }
);
</script>
<div class="overlay-wrapper ew-calendar-wrapper">
    <div class="card p-0 ew-calendar-card border-transparent">
        <div class="card-body p-0">
            <!-- Calendar -->
            <div id="full-calendar" class="ew-calendar"></div>
        </div>
    </div>
    <div class="dropdown ew-calendar-dropdown">
        <button class="dropdown-toggle d-none" type="button" id="calendar-dropdown" aria-expanded="false"></button>
        <ul class="dropdown-menu" aria-labelledby="full-calendar">
            <li><a class="dropdown-item" role="button" data-action="view"><?= $Language->phrase("ViewLink", null) ?></a></li>
            <li><a class="dropdown-item" role="button" data-action="edit"><?= $Language->phrase("EditLink", null) ?></a></li>
            <li><a class="dropdown-item" role="button" data-action="copy"><?= $Language->phrase("CopyLink", null) ?></a></li>
            <li><a class="dropdown-item" role="button" data-action="delete"><?= $Language->phrase("DeleteLink", null) ?></a></li>
        </ul>
    </div>
</div>
<script>
if (!calendarLoaded)
    document.querySelector(".ew-calendar-wrapper").insertAdjacentHTML("afterbegin", ew.overlayTemplate());
</script>
    </div><!-- /.ew-calendar -->
</main>
<!-- /.report-calendar -->
<!-- Calendar report (end) -->
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script type="text/html" data-name="event-popover" data-seq="10">
{{if extendedProps.timeSpan}}
<p>{{:extendedProps.timeSpan}}</p>
{{/if}}
{{:extendedProps.description}}
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
