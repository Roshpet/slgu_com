<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <title>Certificate of Marriage</title>
    <style>
        @media print {
            @page {
                size: 8.5in 14in; /* Updated to Legal size (14in) to prevent splitting */
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                display: block !important; /* Override flex display to prevent centering issues */
            }
            
            /* Ensure container fits exactly on one page */
            .page-container {
                width: 8.5in !important;
                height: 14in !important;
                max-height: 14in !important;
                overflow: hidden !important; /* Cut off any overflow that creates a 2nd page */
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
            }
            .no-print {
                display: none !important;
            }

            /* Data Only Printing Mode */
            body.print-data-only * {
                visibility: hidden !important;
                /* Reset borders and backgrounds just in case */
                border: none !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            /* Make sure the structure takes up space */
            body.print-data-only .page-container {
                visibility: visible !important; /* The container itself must be visible for positioning context? */
                /* Actually, if container is hidden, children can be visible, but background of container is gone. */
                position: relative;
            }

            /* Show Input Values */
            body.print-data-only input,
            body.print-data-only textarea {
                visibility: visible !important;
                color: #fffb00ff !important;
                background: transparent !important;
                border: none !important;
                /* Ensure inputs don't have borders even if they had them before */
                border-bottom: none !important; 
            }
            
            /* Hide Placeholders in print mode */
            body.print-data-only ::placeholder {
                color: transparent !important;
            }

            /* Collapse headers in print mode */
            body.print-data-only .header-top,
            body.print-data-only .header-center,
            body.print-data-only .registry-block {
                display: none !important;
                height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* Hide Labels and collapse container space for Province/City */
            body.print-data-only .info-row {
                height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                overflow: visible !important; /* Allow absolute inputs to show */
            }
            body.print-data-only .info-label {
                display: none !important;
            }

            /* Custom Checkbox Printing - Disabled per request */
            body.print-data-only input[type="checkbox"] {
                display: none !important;
            }

            /* Shift printed data upward for pre-printed forms */
            /* Province and City - ABSOLUTE POSITIONING based on User Measurements */
            /* Top Edge -> Province: 1.10in */
            #input-province {
                position: absolute !important;
                top: 1.10in !important;
                left: 1.50in !important; /* Adjusted for label width */
                transform: none !important;
                width: 4.72in !important;
            }
            /* Province -> City: 0.31in (Total Top: 1.42in) */
            #input-city {
                position: absolute !important;
                top: 1.34in !important;
                left: 1.77in !important;
                transform: none !important;
                width: 4.72in !important;
            }
            
            /* Main Form Data (1-14) */
            /* Force the table itself to start at the correct vertical position */
            /* User measured Table Edge to Paper Edge = 1.46in */
            /* Adjusted Down by 0.12in per user request -> 1.57in */
            /* We use position: absolute to FORCE this location, ignoring flow/headers */
            
            table.main-form {
                position: static !important;
                margin-top: 1.38in !important; /* Reduced from 1.57in to compensate for padding */
                width: 100% !important;
            }

            body.print-data-only .bottom-section {
                margin-top: 0.12in !important;
                position: static !important;
            }

            /* Set height for Section 1 Row to ensure Section 2 starts 0.39in below */
            table.main-form tbody tr:first-child {
                height: 0.39in !important;
            }

            /* Husband (Col 2) - Reset absolute, let it flow in the table */
            table.main-form tbody tr:first-child td:nth-child(2) input {
                position: static !important;
                transform: none !important;
                width: 100% !important;
            }
            /* Wife (Col 3) - Reset absolute, let it flow in the table */
            table.main-form tbody tr:first-child td:nth-child(3) input {
                position: static !important;
                transform: translate(0.75in, 0in) !important; /* Keep the X-shift for wife column if needed */
                width: 100% !important;
            }
            
            /* Re-enable general transform for table inputs if needed, or rely on flow */
            /* Let's try to rely on flow + row height adjustments now */
            
            /* Section 1 (Name) */
            /* If we pushed the whole table down to 1.81in, Section 1 should be close. */
            /* Adjust Section 1 specifically if needed */
            table.main-form tbody tr:first-child input {
                 /* Fine tune Y if the margin-top 1.81in isn't perfect for the text baseline */
                 transform: translateY(-0.08in) !important; 
            }
            
            /* Wife (Col 3) specific X shift */
            table.main-form td:nth-child(3) input {
                transform: translateX(0.75in) !important;
            }

            /* Section 2 (Date of Birth) Specific Shift: 0.39in below Section 1 */
            /* We set Row 1 height to 0.39in, so Row 2 starts at 0.39in. */
            /* Reset Y-transform to 0 or adjust slightly */
            /* Husband (Col 2) */
            table.main-form tbody tr:nth-child(2) td:nth-child(2) input {
                transform: translate(0.20in, 0.0in) !important; /* Kept X, reset Y */
            }
            /* Wife (Col 3) */
            /* User Request: Distance of wife column from husband column should be 0.39in */
            /* Previously X-shift was 0.94in. Reducing to 0.39in to bring it closer (or align to 0.39in gap) */
            table.main-form tbody tr:nth-child(2) td:nth-child(3) input {
                transform: translate(0.39in, 0.0in) !important; /* Adjusted X-shift from 0.94in to 0.39in */
            }

            /* Set height for Section 2 Row to ensure Section 3 starts 0.31in below */
            table.main-form tbody tr:nth-child(2) {
                height: 0.31in !important;
            }

            /* Section 3 (Place of Birth) Specific Shift: Down 0.12in (was -0.12in -> 0.0in) */
            /* Now handled by Row 2 Height being 0.31in */
            /* Husband (Col 2) */
            table.main-form tbody tr:nth-child(3) td:nth-child(2) input {
                transform: translate(0.20in, 0.0in) !important;
            }
            /* Wife (Col 3) */
            table.main-form tbody tr:nth-child(3) td:nth-child(3) input {
                transform: translate(0.94in, 0.0in) !important;
            }
            /* Set height for Section 3 Row to ensure Section 4 starts 0.31in below */
            table.main-form tbody tr:nth-child(3) {
                height: 0.31in !important;
            }

            /* Section 4 (Sex / Citizenship) Specific Shift: 0.31in below Section 3 */
            
            /* Husband (Col 2) Container Override */
            table.main-form tbody tr:nth-child(4) td:nth-child(2) div:last-child {
                gap: 0 !important; /* Disable default gap to use precise margin */
            }
            /* Husband (Col 2) Sex (4a) */
            table.main-form tbody tr:nth-child(4) td:nth-child(2) input:nth-of-type(1) {
                transform: translateY(0.0in) !important;
                margin-right: 1.18in !important; /* Distance to Citizenship */
                width: 0.59in !important; /* Force width to avoid wrapping or stretching */
                flex: none !important; /* Disable flex-grow */
            }
            /* Husband (Col 2) Citizenship (4b) */
            table.main-form tbody tr:nth-child(4) td:nth-child(2) input:nth-of-type(2) {
                transform: translateY(0.0in) !important;
                flex: 1 !important; /* Let citizenship take remaining space */
                text-align: left !important; /* Reset alignment if needed */
            }

            /* Wife (Col 3) Container Override */
            table.main-form tbody tr:nth-child(4) td:nth-child(3) div:last-child {
                gap: 0 !important;
            }
            /* Wife (Col 3) Sex (4a) */
            table.main-form tbody tr:nth-child(4) td:nth-child(3) input:nth-of-type(1) {
                transform: translate(0.35in, 0.0in) !important; /* Keep the 0.35in shift for Wife col */
                margin-right: 1.18in !important;
                width: 0.59in !important;
                flex: none !important;
            }
            /* Wife (Col 3) Citizenship (4b) */
            table.main-form tbody tr:nth-child(4) td:nth-child(3) input:nth-of-type(2) {
                transform: translate(0.35in, 0.0in) !important;
                flex: 1 !important;
                text-align: left !important;
            }

            /* Set height for Section 4 Row to ensure Section 5 starts 0.63in below */
            table.main-form tbody tr:nth-child(4) {
                height: 0.63in !important;
            }

            /* Section 5, 6, 7 Specific Shift: Down 0.12in (was 0.0in -> 0.12in) */
            /* Husband (Col 2) */
            /* Section 5: Reset Y to 0.0in as we use Row Height now */
            table.main-form tbody tr:nth-child(5) td:nth-child(2) input {
                 transform: translateY(0.0in) !important;
            }
            /* Set height for Section 5 Row to ensure Section 6 starts 0.20in below */
            table.main-form tbody tr:nth-child(5) {
                height: 0.20in !important;
            }

            /* Section 6, 7 Specific Shift: Down 0.12in (was 0.0in -> 0.12in) */
            /* Husband (Col 2) */
            /* Section 6: Reset Y to 0.0in as we use Row Height now */
            table.main-form tbody tr:nth-child(6) td:nth-child(2) input {
                 transform: translateY(0.0in) !important;
            }
            /* Set height for Section 6 Row to ensure Section 7 starts 0.31in below */
            table.main-form tbody tr:nth-child(6) {
                height: 0.31in !important;
            }

            /* Section 7 */
            table.main-form tbody tr:nth-child(7) td:nth-child(2) input {
                transform: translateY(0.0in) !important;
            }
            /* Set height for Section 7 Row to ensure Section 8 starts 0.20in below */
            table.main-form tbody tr:nth-child(7) {
                height: 0.20in !important;
            }

            /* Wife (Col 3) */
            /* Section 5: Reset Y to 0.0in, keep X shift (maybe 0.35in? or 0.75in?) */
            /* User previously set Wife X to 0.35in for Sec 4, and 0.39in for Sec 2. */
            /* Let's keep 0.75in for now unless specified, but reset Y */
            table.main-form tbody tr:nth-child(5) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }
            /* Section 6, 7 */
            /* Section 6: Reset Y to 0.0in, keep X */
            table.main-form tbody tr:nth-child(6) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }
            /* Section 7 */
            table.main-form tbody tr:nth-child(7) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }

            /* Section 8 Specific Shift: Down 0.12in (was 0.0in -> 0.12in) */
            /* Husband (Col 2) */
            table.main-form tbody tr:nth-child(8) td:nth-child(2) input {
                transform: translateY(0.0in) !important;
            }
            /* Set height for Section 8 Row to ensure Section 9 starts 0.20in below */
            table.main-form tbody tr:nth-child(8) {
                height: 0.20in !important;
            }

            /* Section 9 Specific Shift: Down 0.12in (was 0.12in -> 0.24in) */
            /* Husband (Col 2) */
            table.main-form tbody tr:nth-child(9) td:nth-child(2) input {
                transform: translateY(0.0in) !important;
            }
            /* Set height for Section 9 Row to ensure Section 10 starts 0.28in below */
            table.main-form tbody tr:nth-child(9) {
                height: 0.28in !important;
            }

            /* Section 10 Husband (Col 2): Down 0.12in (was 0.04in -> 0.16in) */
            table.main-form tbody tr:nth-child(10) td:nth-child(2) input {
                transform: translateY(0.0in) !important;
            }

            /* Wife (Col 3) */
            /* Section 8 */
            table.main-form tbody tr:nth-child(8) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }
            /* Section 9 */
            table.main-form tbody tr:nth-child(9) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }
            /* Section 10 Wife (Col 3): Down 0.12in (was 0.04in -> 0.16in) */
            table.main-form tbody tr:nth-child(10) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }
            /* Set height for Section 10 Row to ensure Section 11 starts 0.20in below */
            table.main-form tbody tr:nth-child(10) {
                height: 0.20in !important;
            }

            /* Section 11 Specific Shift: Down 0.12in (was 0.16in -> 0.28in) */
            /* Husband (Col 2) */
            table.main-form tbody tr:nth-child(11) td:nth-child(2) input {
                transform: translateY(0.0in) !important;
            }
            /* Wife (Col 3) */
            table.main-form tbody tr:nth-child(11) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }
            /* Set height for Section 11 Row to ensure Section 12 starts 0.31in below */
            table.main-form tbody tr:nth-child(11) {
                height: 0.31in !important;
            }

            /* Section 12, 13, 14 Specific Shift: Down 0.12in (was 0.20in -> 0.31in) */
            /* Husband (Col 2) */
            table.main-form tbody tr:nth-child(12) td:nth-child(2) input,
            table.main-form tbody tr:nth-child(13) td:nth-child(2) input,
            table.main-form tbody tr:nth-child(14) td:nth-child(2) input {
                transform: translateY(0.0in) !important;
            }
            /* Wife (Col 3) */
            table.main-form tbody tr:nth-child(12) td:nth-child(3) input,
            table.main-form tbody tr:nth-child(13) td:nth-child(3) input,
            table.main-form tbody tr:nth-child(14) td:nth-child(3) input {
                transform: translate(0.75in, 0.0in) !important;
            }

            /* Set height for Section 12 Row to ensure Section 13 starts 0.20in below */
            table.main-form tbody tr:nth-child(12) {
                height: 0.20in !important;
            }

            /* Set height for Section 13 Row to ensure Section 14 starts 0.31in below */
            table.main-form tbody tr:nth-child(13) {
                height: 0.31in !important;
            }

            /* Age Input Specific Shifts (Right 0.20in relative to column base) */
            /* Husband Age (Col 2): Down 0.12in (was -0.31in -> -0.20in) */
            table.main-form td:nth-child(2) input.age-input {
                transform: translate(0.31in, -0.20in) !important;
            }
            /* Wife Age (Col 3): Down 0.12in (was -0.31in -> -0.20in) */
            table.main-form td:nth-child(3) input.age-input {
                transform: translate(0.51in, -0.20in) !important;
            }

            /* Item 15 (Place of Marriage): Right 0.20in, Y aligned via section margin */
            .item-15-row input {
                transform: translate(0.20in, 0.0in) !important;
            }

            /* Section 16 & 17 Container: 0.31in below Section 15 */
            .bottom-section > div:nth-child(2) {
                margin-top: 0.31in !important;
            }

            /* Item 16 (Date of Marriage): Reset Y */
            .item-16-input {
                transform: translateY(0.0in) !important;
            }

            /* Item 17 (Time of Marriage): Right 0.75in, Reset Y */
            .item-17-input {
                transform: translate(0.75in, 0.0in) !important;
            }

            /* Section 18 (Certification): 0.39in below Section 16/17 */
            .section-18-container {
                margin-top: 0.39in !important;
                position: relative !important;
            }
            .section-19-container {
                position: static !important;
            }

            /* Item 18 (Certification of Contracting Parties) */
            /* First Input: Absolute Position for precision */
            .item-18-input-1 {
                position: absolute !important;
                top: 0 !important;
                left: 1.97in !important; /* Adjusted to align with blank after 'That I,' */
                transform: none !important;
            }
            /* Item 18 Second Input: Absolute Position for precision */
            .item-18-input-2 {
                position: absolute !important;
                top: 0 !important;
                left: 4.72in !important; /* Adjusted to align with blank after 'and I,' */
                transform: none !important;
            }

            /* Item 18 (Day of Month): Aligned with Month, 0.31in below Names (approx 0.59in from top) */
            .day-input {
                position: absolute !important;
                top: 0.59in !important;
                left: 4.72in !important; /* Adjusted left position */
                transform: none !important;
            }

            /* Item 18 (Month of Year): Aligned with Day */
            .month-input {
                position: absolute !important;
                top: 0.59in !important;
                left: 5.91in !important; /* Adjusted left position */
                transform: none !important;
            }

            /* Section 19 Container: Positioned relative to Section 18 inputs */
            /* User wants 1.10in from Sec 18 Day/Month to Sec 19a inputs */
            /* Sec 18 Day/Month are at top: 0.59in. So Sec 19a needs to be at approx 0.59in + 1.10in = 1.69in relative to Sec 18 container top */
            /* Or we can just push the Sec 19 container down */
            /* Let's target the Section 19 text container */
            
            .certification-text + .signatures-row + .certification-text {
                margin-top: 1.10in !important; 
            }
            
            /* And reset internal spacing for Section 19a row if needed, or let it flow */
            /* Item 18 Checkboxes: Down 0.12in (was 0.51in -> 0.63in), Left 0.35in */
            .item-18-checkbox {
                transform: translate(-0.35in, 0.63in) !important;
            }

            /* Item 19a (Marriage License): Fixed position above Solemnizing Officer */
            .item-19a-row {
                position: absolute !important;
                top: 10.15in !important;
                left: 1.14in !important;
                transform: none !important;
                margin-top: 0 !important;
                width: 100% !important;
            }
            .item-19b-row {
                position: absolute !important;
                top: 10.45in !important;
                left: 1.14in !important;
                width: 100% !important;
            }
            .item-19c-row {
                position: absolute !important;
                top: 10.60in !important;
                left: 1.14in !important;
                width: 100% !important;
            }
            .item-19a-row input,
            .item-19b-row input,
            .item-19c-row input {
                visibility: visible !important;
                display: inline-block !important;
            }
            /* Item 19a Checkbox Specific: Left 1.06in relative to row */
            .item-19a-row input[type="checkbox"],
            .item-19b-row input[type="checkbox"],
            .item-19c-row input[type="checkbox"] {
                transform: translate(-1.06in, 0.0in) !important;
                display: none !important;
            }

            /* Solemnizing Officer Container: Fixed position below Section 19b (0.39in gap) */
            .solemnizing-officer-row {
                position: absolute !important;
                top: 10.84in !important;
                left: 0 !important;
                width: 100% !important;
                margin-top: 0 !important;
            }

            /* Witnesses Section (20a): Fixed position below Solemnizing Officer (0.7in gap) */
            .witnesses-section {
                position: absolute !important;
                top: 11.54in !important;
                left: 0 !important;
                width: 100% !important;
                margin-top: 0 !important;
            }

            /* Item 19 (Solemnizing Officer): Horizontal shift only */
            .solemnizing-officer,
            .position-designation,
            .religion-designation {
                transform: translate(0.59in, 0in) !important;
                visibility: visible !important;
            }

            /* Item 20a (Witnesses): Horizontal shift only */
            .item-20a-grid input {
                transform: translate(0.39in, 0in) !important;
                padding: 0 0.04in !important;
            }

            /* Section 21 & 22 (Footer): Fixed position at the bottom (0.7in gap from 20a) */
            .footer-grid {
                position: absolute !important;
                top: 12.24in !important;
                left: 0 !important;
                width: 100% !important;
                margin-top: 0 !important;
            }
            /* Section 21 Specific: Horizontal shift only */
            .footer-grid .footer-half:first-child input {
                transform: translate(0.51in, 0in) !important;
                visibility: visible !important;
            }
            /* Section 22 Specific: Horizontal shift only */
            .footer-grid .footer-half:nth-child(2) input {
                transform: translate(0.75in, 0in) !important;
                visibility: visible !important;
            }
            /* Barcode Strip: Right 0.16in, Down 0.12in (was 3.15in -> 3.27in) */
            .barcode-strip input {
                transform: translate(0.16in, 3.27in) !important;
            }
        }

        /* Screensaver Styles */
        #screensaver-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        #screensaver-overlay.active {
            display: flex;
        }
        .screensaver-bg-blur {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(12px);
            transform: scale(1.05);
            z-index: -1;
            pointer-events: none;
        }
        .screensaver-logo {
            max-width: 600px;
            width: 80%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }
        .blend-remove-white {
            mix-blend-mode: multiply;
            filter: contrast(1.15) saturate(1.1);
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9pt;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .page-container {
            width: 8.5in;
            min-height: 14in; /* Legal Size */
            background: white;
            padding: 0.1969in 0.9449in 0.6693in 0.1969in; /* Top 0.5cm, Right 2.4cm, Bottom 1.7cm, Left 0.5cm */
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            box-sizing: border-box;
            position: relative;
        }

        /* Header Layout */
        .header-top {
            position: relative;
            height: 0; /* Allow center header to flow naturally */
            font-size: 8pt;
        }
        .header-left-text { position: absolute; left: 0; top: 0; text-align: left; }
        .header-right-text { position: absolute; right: 0; top: 0; text-align: right; }

        .header-center {
            text-align: center;
            line-height: 1.2;
            margin-top: 0;
            margin-left: -0.18in; /* Center relative to paper (compensate for asymmetric padding) */
        }
        .header-center h4 { margin: 0; font-weight: normal; font-size: 10pt; }
        .header-center h2 { margin: 0; font-size: 18pt; font-weight: bold; font-family: "Arial Black", Arial, sans-serif; letter-spacing: 1px; }
        
        .registry-block {
            text-align: right;
            margin-top: 5px; /* Removed negative margin to prevent overlap */
            margin-bottom: 5px;
        }

        /* Top Info Rows */
        .info-row {
            display: flex;
            border-bottom: 1px solid black;
            padding-bottom: 2px;
            margin-bottom: 2px;
            align-items: flex-end;
        }
        .info-label {
            width: 120px;
            font-size: 9pt;
        }
        .info-value {
            flex: 1;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
        }

        /* Main Table */
        table.main-form {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
            table-layout: fixed;
            margin-top: 5px;
        }

        table.main-form th {
            border: 1px solid black;
            padding: 2px;
            background-color: #eee;
            text-align: center;
            font-weight: bold;
            font-size: 9pt;
        }
        
        table.main-form td {
            border: 1px solid black;
            padding: 2px 4px; /* Tighter padding for better fit */
            vertical-align: top;
            font-size: 9pt;
            position: relative;
        }

        /* Column Widths */
        .col-label { width: 18%; background-color: #f9f9f9; font-weight: bold; font-size: 8pt; }
        .col-husband { width: 41%; }
        .col-wife { width: 41%; }

        /* Input Styling */
        input[type="text"], input[type="date"], input[type="number"] {
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: 10pt;
            font-weight: bold;
            color: #000;
            width: 100%;
            padding: 1px 0; /* Slight padding adjustment */
            margin: 0;
            text-transform: uppercase; /* Official forms use uppercase */
            line-height: 1.2;
        }
        
        /* Specific tweaks for image match */
        .field-sublabel {
            font-size: 7pt;
            color: #444;
            font-style: normal;
        }
        
        .checkbox-label {
            font-size: 8pt;
            display: inline-flex;
            align-items: center;
            margin-right: 10px;
            white-space: nowrap;
        }
        
        .bottom-section {
            border: 2px solid black;
            border-top: none;
            padding: 5px;
            font-size: 8pt;
        }
        
        .certification-text {
            text-align: justify;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .signatures-row {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            margin-bottom: 10px;
        }
        
        .signature-line-box {
            border-top: 1px solid black;
            width: 80%;
            text-align: center;
            padding-top: 2px;
            font-weight: bold;
        }

        .footer-grid {
            display: flex;
            border: 2px solid black;
            margin-top: 2px;
        }
        .footer-half {
            flex: 1;
            padding: 5px;
            border-right: 1px solid black;
        }
        .footer-half:last-child { border-right: none; }

        .barcode-strip {
            margin-top: 10px;
            border: 2px solid black;
            padding: 5px;
            font-family: Arial, sans-serif;
            font-size: 8pt;
            font-weight: bold;
        }
        .barcode-inputs {
            display: flex;
            align-items: flex-end;
            margin-top: 5px;
        }
        .barcode-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 5px;
        }
        .barcode-label {
            font-size: 7pt;
            margin-bottom: 2px;
            text-align: center;
            width: 100%;
        }
        .barcode-boxes {
            display: flex;
        }
        .barcode-box {
            width: 15px;
            height: 20px;
            border: 1px solid black;
            border-right: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .barcode-box:last-child {
            border-right: 1px solid black;
        }
        .barcode-box input {
            width: 100%;
            height: 100%;
            border: none;
            text-align: center;
            font-size: 10pt;
            padding: 0;
            margin: 0;
            background: transparent;
        }
        
        /* Helper for stacked inputs in table cells */
        .stacked-input {
            margin-bottom: 2px;
        }
        .stacked-input span {
            margin-right: 5px;
        }


        /* Print Button */
        .controls {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="controls no-print" style="width: 300px;">
    <button class="btn" onclick="window.print()" style="width: 100%; margin-bottom: 10px;">🖨️ Print Form</button>
    
    <div style="background: #f8f9fa; padding: 10px; border-radius: 4px; border: 1px solid #ddd;">
        <label style="cursor: pointer; display: block; margin-bottom: 10px;">
            <input type="checkbox" id="dataOnlyToggle" onchange="toggleDataOnly(this)"> 
            <strong>Print Data Only</strong>
            <div style="font-size: 0.8em; color: #666; margin-left: 20px;">For pre-printed forms</div>
        </label>

        <div id="advanced-controls" style="display: block;">
        <hr style="margin: 10px 0; border: 0; border-top: 1px solid #ddd;">
        
        <strong>Paper Size:</strong>
        <select id="paperSize" onchange="updatePaperSize()" style="width: 100%; margin-bottom: 10px; padding: 5px;">
            <option value="legal">Legal (8.5" x 14")</option>
            <option value="folio">Long/Folio (8.5" x 13")</option>
        </select>

        <strong>Alignment Adjustment (mm):</strong>
        <div style="display: flex; gap: 10px; margin-bottom: 5px;">
            <div style="flex:1">
                <label style="font-size: 0.9em;">Top:</label>
                <input type="number" id="marginTop" value="0" style="width: 100%;" onchange="updateTransform()">
            </div>
            <div style="flex:1">
                <label style="font-size: 0.9em;">Left:</label>
                <input type="number" id="marginLeft" value="0" style="width: 100%;" onchange="updateTransform()">
            </div>
        </div>

        <strong>Scale (%):</strong>
        <div style="margin-bottom: 5px;">
             <input type="number" id="scale" value="100" style="width: 100%;" onchange="updateTransform()">
             <div style="font-size: 0.8em; color: #666;">Use < 100 to shrink if printing too big</div>
        </div>
        </div>
    </div>
</div>

<style>
    /* Dynamic Page Size Style Block */
    @media print {
        @page {
            margin: 0;
            /* size will be injected here */
        }
    }
</style>

<div class="page-container">
    <!-- Header -->
    <div class="header-top">
        <div class="header-left-text">Municipal Form No. 97<br>(Revised August 2016)</div>
        <div class="header-right-text">(To be accomplished in quadruplicate using black ink)</div>
    </div>
    
    <div class="header-center">
        <h4>Republic of the Philippines</h4>
        <h4>OFFICE OF THE CIVIL REGISTRAR GENERAL</h4>
        <h2>CERTIFICATE OF MARRIAGE</h2>
    </div>

    <div class="registry-block">
        Registry No. <input type="text" style="width: 150px; border-bottom: 1px solid black; display: inline-block;">
    </div>

    <div class="info-row">
        <span class="info-label">Province</span>
        <input type="text" id="input-province" class="info-value" value="" placeholder="Enter Province">
    </div>
    <div class="info-row">
        <span class="info-label">City/Municipality</span>
        <input type="text" id="input-city" class="info-value city-input" value="" placeholder="Enter City/Municipality">
    </div>

    <table class="main-form">
        <thead>
            <tr>
                <th class="col-label"></th>
                <th class="col-husband">HUSBAND</th>
                <th class="col-wife">WIFE</th>
            </tr>
        </thead>
        <tbody>
            <!-- 1. Name -->
            <tr>
                <td>1. Name of Contracting Parties</td>
                <td>
                    <div style="display: flex; margin-bottom: 2px;">
                        <span class="field-sublabel" style="width: 40px;">(First)</span>
                        <input type="text" style="flex:1" value="" placeholder="Enter Husband's First Name">
                    </div>
                    <div style="display: flex; margin-bottom: 2px;">
                        <span class="field-sublabel" style="width: 40px;">(Middle)</span>
                        <input type="text" style="flex:1" value="" placeholder="Enter Husband's Middle Name">
                    </div>
                    <div style="display: flex;">
                        <span class="field-sublabel" style="width: 40px;">(Last)</span>
                        <input type="text" style="flex:1" value="" placeholder="Enter Husband's Last Name">
                    </div>
                </td>
                <td>
                    <div style="display: flex; margin-bottom: 2px;">
                        <span class="field-sublabel" style="width: 40px;">(First)</span>
                        <input type="text" style="flex:1" value="" placeholder="Enter Wife's First Name">
                    </div>
                    <div style="display: flex; margin-bottom: 2px;">
                        <span class="field-sublabel" style="width: 40px;">(Middle)</span>
                        <input type="text" style="flex:1" value="" placeholder="Enter Wife's Middle Name">
                    </div>
                    <div style="display: flex;">
                        <span class="field-sublabel" style="width: 40px;">(Last)</span>
                        <input type="text" style="flex:1" value="" placeholder="Enter Wife's Last Name">
                    </div>
                </td>
            </tr>
            <!-- 2. Birth -->
            <tr>
                <td>2a. Date of Birth<br>2b. Age</td>
                <td>
                    <div style="display: flex; gap: 5px; text-align: center;">
                        <div style="flex:1"><span class="field-sublabel">(Day)</span><br><input type="text" value="" placeholder="Day" style="text-align:center"></div>
                        <div style="flex:2"><span class="field-sublabel">(Month)</span><br><input type="text" value="" placeholder="Month" style="text-align:center"></div>
                        <div style="flex:1"><span class="field-sublabel">(Year)</span><br><input type="text" value="" placeholder="Year" style="text-align:center"></div>
                        <div style="flex:1"><span class="field-sublabel">(Age)</span><br><input type="text" class="age-input" value="" placeholder="Age" style="text-align:center"></div>
                    </div>
                </td>
                <td>
                    <div style="display: flex; gap: 5px; text-align: center;">
                        <div style="flex:1"><span class="field-sublabel">(Day)</span><br><input type="text" value="" placeholder="Day" style="text-align:center"></div>
                        <div style="flex:2"><span class="field-sublabel">(Month)</span><br><input type="text" value="" placeholder="Month" style="text-align:center"></div>
                        <div style="flex:1"><span class="field-sublabel">(Year)</span><br><input type="text" value="" placeholder="Year" style="text-align:center"></div>
                        <div style="flex:1"><span class="field-sublabel">(Age)</span><br><input type="text" class="age-input" value="" placeholder="Age" style="text-align:center"></div>
                    </div>
                </td>
            </tr>
            <!-- 3. Place of Birth -->
            <tr>
                <td>3. Place of Birth</td>
                <td>
                    <div style="display:flex; justify-content:space-between; font-size:7pt; color:#444;">
                        <span>(City/Municipality)</span><span>(Province)</span><span>(Country)</span>
                    </div>
                    <input type="text" class="auto-resize" value="" placeholder="Enter Husband's Place of Birth">
                </td>
                <td>
                    <div style="display:flex; justify-content:space-between; font-size:7pt; color:#444;">
                        <span>(City/Municipality)</span><span>(Province)</span><span>(Country)</span>
                    </div>
                    <input type="text" class="auto-resize" value="" placeholder="Enter Wife's Place of Birth">
                </td>
            </tr>
            <!-- 4. Sex / Citizenship -->
            <tr>
                <td>4a. Sex<br>4b. Citizenship</td>
                <td>
                    <div style="text-align: right; margin-bottom: 2px;">
                        <span class="field-sublabel" style="white-space: nowrap;">(Citizenship)</span>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" value="" placeholder="Sex" style="flex: 1; text-align: left;">
                        <input type="text" value="" placeholder="Citizenship" style="flex: 1; text-align: right;">
                    </div>
                </td>
                <td>
                    <div style="text-align: right; margin-bottom: 2px;">
                        <span class="field-sublabel" style="white-space: nowrap;">(Citizenship)</span>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" value="" placeholder="Sex" style="flex: 1; text-align: left;">
                        <input type="text" value="" placeholder="Citizenship" style="flex: 1; text-align: right;">
                    </div>
                </td>
            </tr>
            <!-- 5. Residence -->
            <tr>
                <td>5. Residence</td>
                <td>
                    <div style="text-align: right; font-size: 7pt; color:#444;">(House No., St., Barangay, City/Municipality, Province, Country)</div>
                    <input type="text" class="auto-resize" value="" placeholder="Enter Husband's Residence"`>
                </td>
                <td>
                    <div style="text-align: right; font-size: 7pt; color:#444;">(House No., St., Barangay, City/Municipality, Province, Country)</div>
                    <input type="text" class="auto-resize" value="" placeholder="Enter Wife's Residence">
                </td>
            </tr>
            <!-- 6. Religion -->
            <tr>
                <td>6. Religion/Religious Sect</td>
                <td><input type="text" value="" placeholder="Enter Husband's Religion"></td>
                <td><input type="text" value="" placeholder="Enter Wife's Religion"></td>
            </tr>
            <!-- 7. Civil Status -->
            <tr>
                <td>7. Civil Status</td>
                <td><input type="text" value="" placeholder="Enter Husband's Civil Status"></td>
                <td><input type="text" value="" placeholder="Enter Wife's Civil Status"></td>
            </tr>
            <!-- 8. Name of Father -->
            <tr>
                <td>8. Name of Father</td>
                <td>
                    <div style="text-align: center;">
                        <span class="field-sublabel">(First, Middle, Last)</span><br>
                        <input type="text" value="" placeholder="Enter Husband's Father's Full Name">
                    </div>
                </td>
                <td>
                    <div style="text-align: center;">
                        <span class="field-sublabel">(First, Middle, Last)</span><br>
                        <input type="text" value="" placeholder="Enter Wife's Father's Full Name">
                    </div>
                </td>
            </tr>
            <!-- 9. Citizenship Father -->
            <tr>
                <td>9. Citizenship</td>
                <td><input type="text" value="" placeholder="Enter Husband's Father's Citizenship"></td>
                <td><input type="text" value="" placeholder="Enter Wife's Father's Citizenship"></td>
            </tr>
            <!-- 10. Name of Mother -->
            <tr>
                <td>10. Maiden Name of Mother</td>
                <td>
                    <div style="text-align: center;">
                        <span class="field-sublabel">(First, Middle, Last)</span><br>
                        <input type="text" value="" placeholder="Enter Husband's Mother's Full Name">
                    </div>
                </td>
                <td>
                    <div style="text-align: center;">
                        <span class="field-sublabel">(First, Middle, Last)</span><br>
                        <input type="text" value="" placeholder="Enter Wife's Mother's Full Name">
                    </div>
                </td>
            </tr>
            <!-- 11. Citizenship Mother -->
            <tr>
                <td>11. Citizenship</td>
                <td><input type="text" value="" placeholder="Enter Husband's Mother's Citizenship"></td>
                <td><input type="text" value="" placeholder="Enter Wife's Mother's Citizenship"></td>
            </tr>
            <!-- 12. Consent Person -->
            <tr>
                <td>12. Name of Person/Who Gave Consent or Advice</td>
                <td>
                    <div style="text-align: center;">
                        <span class="field-sublabel">(First, Middle, Last)</span><br>
                        <input type="text" class="auto-resize" value="" placeholder="Enter Husband's Consent Person's Full Name">
                    </div>
                </td>
                <td>
                    <div style="text-align: center;">
                        <span class="field-sublabel">(First, Middle, Last)</span><br>
                        <input type="text" class="auto-resize" value="" placeholder="Enter Wife's Consent Person's Full Name">
                    </div>
                </td>
            </tr>
            <!-- 13. Relationship -->
            <tr>
                <td>13. Relationship</td>
                <td><input type="text" value="" placeholder="Enter Husband's Relationship"></td>
                <td><input type="text" value="" placeholder="Enter Wife's Relationship"></td>
            </tr>
            <!-- 14. Residence -->
            <tr>
                <td>14. Residence</td>
                <td>
                    <div style="text-align: right; font-size: 7pt; color:#444;">(House No., St., Barangay, City/Municipality, Province, Country)</div>
                    <input type="text" class="auto-resize" value="" placeholder="Enter Residence">
                </td>
                <td>
                    <div style="text-align: right; font-size: 7pt; color:#444;">(House No., St., Barangay, City/Municipality, Province, Country)</div>
                    <input type="text" class="auto-resize" value="" placeholder="Enter Residence">
                </td>
            </tr>
        </tbody>
    </table>

    <div class="bottom-section">
        <div class="item-15-row" style="display: flex; border-bottom: 1px dotted #ccc; padding-bottom: 5px; margin-bottom: 5px;">
            <div style="width: 150px;">15. Place of Marriage:</div>
            <div style="flex: 1;">
                <input type="text" class="auto-resize" value="" placeholder="Place of Marriage" style="font-weight: bold; width: 100%; border-bottom: 1px solid black;">
                <div style="font-size: 7pt; text-align: center;">(Office of the/House of/Barangay of/Church of/Mosque of)</div>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <input type="text" class="auto-resize" value="" placeholder="Enter City/Municipality" style="font-weight: bold; text-align: center; width: 100%; border-bottom: 1px solid black;">
                <div style="font-size: 7pt; text-align: center;">(City/Municipality)</div>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <input type="text" class="auto-resize" value="" placeholder="Enter Province" style="font-weight: bold; text-align: center; width: 100%; border-bottom: 1px solid black;">
                <div style="font-size: 7pt; text-align: center;">(Province)</div>
            </div>
        </div>
        
        <div style="display: flex; margin-bottom: 5px;">
            <div style="width: 150px;">16. Date of Marriage:</div>
            <div style="flex: 1; display: flex; gap: 10px;">
                <div style="text-align: center;"><input type="text" class="item-16-input" value="" placeholder="Day" style="width: 40px; text-align: center;"><br><span class="field-sublabel">(Day)</span></div>
                <div style="text-align: center;"><input type="text" class="item-16-input" value="" placeholder="Month" style="width: 100px; text-align: center;"><br><span class="field-sublabel">(Month)</span></div>
                <div style="text-align: center;"><input type="text" class="item-16-input" value="" placeholder="Year" style="width: 60px; text-align: center;"><br><span class="field-sublabel">(Year)</span></div>
            </div>
            <div style="width: 300px; display: flex;">
                17. Time of Marriage: 
                <input type="text" class="item-17-input" value="" placeholder="Time" style="flex: 1; text-align: center; border-bottom: 1px solid black; margin: 0 5px;"> am/pm
            </div>
        </div>

        <div class="certification-text section-18-container">
            18. CERTIFICATION OF THE CONTRACTING PARTIES:<br>
            THIS IS TO CERTIFY: That I, <input type="text" class="item-18-input-1" value="" placeholder="Name of Husband" style="width: 250px; border-bottom: 1px solid black;"> and I, <input type="text" class="item-18-input-2" value="" placeholder="name of wife" style="width: 250px; border-bottom: 1px solid black;">, both of legal age, of our own free will and accord, and in the presence of the person solemnizing this marriage and of the witnesses named below, take each other as husband and wife and certifying further that we: <input type="checkbox" class="item-18-checkbox"> have entered, a copy of which is hereto attached / <input type="checkbox" class="item-18-checkbox"> have not entered into a marriage settlement.
            <br>
            IN WITNESS WHEREOF, we have signed/marked with our fingerprint this certificate in quadruplicate this <input type="text" class="day-input" value="" placeholder="Day" style="width: 50px; border-bottom: 1px solid black;"> day of <input type="text" class="month-input" value="" placeholder="Month-Year" style="width: 150px; border-bottom: 1px solid black;">.
        </div>

        <div class="signatures-row">
            <div style="flex: 1; text-align: center;">
                {{-- <div class="signature-line-box">AIRO NIKKO SOLPICO</div> --}}
                (Signature of Husband)
            </div>
            <div style="flex: 1; text-align: center;">
                {{-- <div class="signature-line-box">KRISTIN JUCEL TAMAYO</div> --}}
                (Signature of Wife)
            </div>
        </div>
        
        <div class="certification-text section-19-container">
            19. CERTIFICATION OF THE SOLEMNIZING OFFICER:<br>
            THIS IS TO CERTIFY: THAT BEFORE ME, on the date and place above-written, personally appeared the above-mentioned parties, with their mutual consent, lawfully joined together in marriage which was solemnized by me in the presence of the witnesses named below, all of legal age.<br>
            I CERTIFY FURTHER THAT:<br>
            <div style="margin-left: 20px;">
                <div class="item-19a-row">
                    <input type="checkbox"> a. Marriage License No. <input type="text" value="" placeholder="License No." style="width: 100px; border-bottom: 1px solid black;"> issued on <input type="text" value="" placeholder="MM/DD/YYYY" style="width: 150px; border-bottom: 1px solid black;"> at <input type="text" value="" placeholder="City/Province" style="width: 150px; border-bottom: 1px solid black;"> in favor of said parties, was exhibited to me.
                </div>
                <div class="item-19b-row">
                    <input type="checkbox"> b. no marriage license was necessary, the marriage being solemnized under Art. <input type="text" style="width: 30px; border-bottom: 1px solid black;"> of Executive Order No. 209.
                </div>
                <div class="item-19c-row">
                    <input type="checkbox"> c. the marriage was solemnized in accordance with the provisions of Presidential Decree No. 1083.
                </div>
            </div>
        </div>

        <div class="solemnizing-officer-row" style="display: flex; margin-top: 30px; text-align: center; justify-content: space-between; align-items: flex-start;">
            <div style="flex: 1;">
                <input type="text" class="solemnizing-officer" value="" placeholder="Name of Solemnizing Officer" style="width: 80%; margin: 0 auto; font-weight: bold; text-align: center; border-bottom: 1px solid black; display: block;">
                (Signature Over Printed Name of Solemnizing Officer)
            </div>
            <div style="flex: 1;">
                <input type="text" class="position-designation" value="" placeholder="Position/Designation" style="width: 80%; margin: 0 auto; font-weight: bold; text-align: center; border-bottom: 1px solid black; display: block;">
                (Position/Designation)
            </div>
            <div style="flex: 1;">
                <input type="text" class="religion-designation" value="" style="width: 80%; margin: 0 auto; text-align: center; border-bottom: 1px solid black; display: block;">
                (Religion/Religious Sect, Registry No. and Expiration Date, if applicable)
            </div>
        </div>

        <div class="witnesses-section" style="margin-top: 15px;">
            20a. WITNESSES (Print Name and Sign):<br>
            <div style="font-size: 7pt; margin-left: 20px;">Additional at the back</div>
            <div class="item-20a-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px; margin-top: 6px;">
                <div style="text-align: center; border-bottom: 1px dotted black; height: 18px; display: flex; align-items: flex-end; justify-content: center; box-sizing: border-box;">
                    <input type="text" class="auto-resize" value="" placeholder="Witness Name" style="width: 100%; border: none; background: transparent; padding: 0; margin: 0; font-weight: bold; text-align: center; box-sizing: border-box; outline: none;">
                </div>
                <div style="text-align: center; border-bottom: 1px dotted black; height: 18px; display: flex; align-items: flex-end; justify-content: center; box-sizing: border-box;">
                    <input type="text" class="auto-resize" value="" placeholder="Witness Name" style="width: 100%; border: none; background: transparent; padding: 0; margin: 0; font-weight: bold; text-align: center; box-sizing: border-box; outline: none;">
                </div>
                <div style="text-align: center; border-bottom: 1px dotted black; height: 18px; display: flex; align-items: flex-end; justify-content: center; box-sizing: border-box;">
                    <input type="text" class="auto-resize" value="" placeholder="Witness Name" style="width: 100%; border: none; background: transparent; padding: 0; margin: 0; font-weight: bold; text-align: center; box-sizing: border-box; outline: none;">
                </div>
                <div style="text-align: center; border-bottom: 1px dotted black; height: 18px; display: flex; align-items: flex-end; justify-content: center; box-sizing: border-box;">
                    <input type="text" class="auto-resize" value="" placeholder="Witness Name" style="width: 100%; border: none; background: transparent; padding: 0; margin: 0; font-weight: bold; text-align: center; box-sizing: border-box; outline: none;">
                </div>
            </div>
        </div>
    </div>

    <div class="footer-grid">
        <div class="footer-half">
            21. RECEIVED BY<br>
            <div style="margin-top: 20px;">
                <div style="display: flex; margin-bottom: 5px;">
                    <span style="width: 80px;">Signature</span>
                    <div style="border-bottom: 1px solid black; flex: 1;"></div>
                </div>
                <div style="display: flex; margin-bottom: 5px;">
                    <span style="width: 80px;">Name in Print</span>
                    <input type="text" value="" placeholder="Name in Print" style="flex: 1; font-weight: bold; border-bottom: 1px solid black;">
                </div>
                <div style="display: flex; margin-bottom: 5px;">
                    <span style="width: 80px;">Title or Position</span>
                    <input type="text" value="" placeholder="Title or Position" style="flex: 1; border-bottom: 1px solid black;">
                </div>
                <div style="display: flex;">
                    <span style="width: 80px;">Date</span>
                    <input type="text" value="" placeholder="Date" style="flex: 1; border-bottom: 1px solid black;">
                </div>
            </div>
        </div>
        <div class="footer-half">
            22. REGISTERED AT THE OFFICE OF THE CIVIL REGISTRAR<br>
            <div style="margin-top: 20px;">
                <div style="display: flex; margin-bottom: 5px;">
                    <span style="width: 80px;">Signature</span>
                    <div style="border-bottom: 1px solid black; flex: 1;"></div>
                </div>
                <div style="display: flex; margin-bottom: 5px;">
                    <span style="width: 80px;">Name in Print</span>
                    <input type="text" value="" placeholder="Name in Print" style="flex: 1; font-weight: bold; border-bottom: 1px solid black;">
                </div>
                <div style="display: flex; margin-bottom: 5px;">
                    <span style="width: 80px;">Title or Position</span>
                    <input type="text" value="" placeholder="Title or Position" style="flex: 1; border-bottom: 1px solid black;">
                </div>
                <div style="display: flex;">
                    <span style="width: 80px;">Date</span>
                    <input type="text" value="" placeholder="Date" style="flex: 1; border-bottom: 1px solid black;">
                </div>
            </div>
        </div>
    </div>
    
    <div style="font-size: 8pt; margin-top: 2px; border: 1px solid black; border-top: none; padding: 2px;">
        REMARKS/ANNOTATIONS (For LCRO/OCRG/Shari'a Circuit Registrar Use Only)
        <textarea style="width: 100%; height: 50px; border: none; font-family: inherit; font-size: 9pt; resize: none; overflow: hidden; background: transparent;"></textarea>
    </div>

    <div class="barcode-strip no-print">
        <div>TO BE FILLED-UP AT THE OFFICE OF THE CIVIL REGISTRAR</div>
        <div class="barcode-inputs">
            <!-- 4bH -->
            <div class="barcode-group">
                <div class="barcode-label">4bH</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
            <!-- 4bW -->
            <div class="barcode-group">
                <div class="barcode-label">4bW</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
            <!-- 5H -->
            <div class="barcode-group">
                <div class="barcode-label">5H</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
            <!-- 5W -->
            <div class="barcode-group">
                <div class="barcode-label">5W</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
            <!-- 6H -->
            <div class="barcode-group">
                <div class="barcode-label">6H</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
            <!-- 6W -->
            <div class="barcode-group">
                <div class="barcode-label">6W</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
            <!-- 7H -->
            <div class="barcode-group">
                <div class="barcode-label">7H</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
             <!-- 7W -->
             <div class="barcode-group">
                <div class="barcode-label">7W</div>
                <div class="barcode-boxes">
                    <div class="barcode-box"><input type="text" value=""></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleDataOnly(checkbox) {
        if (checkbox.checked) {
            document.body.classList.add('print-data-only');
        } else {
            document.body.classList.remove('print-data-only');
        }
    }

    function updatePaperSize() {
        const size = document.getElementById('paperSize').value;
        const container = document.querySelector('.page-container');
        const styleBlock = document.getElementById('dynamic-print-style') || document.createElement('style');
        styleBlock.id = 'dynamic-print-style';
        
        if (size === 'legal') {
            container.style.minHeight = '14in';
            styleBlock.innerHTML = '@media print { @page { size: 8.5in 14in; margin: 0; } }';
        } else {
            container.style.minHeight = '13in';
            styleBlock.innerHTML = '@media print { @page { size: 8.5in 13in; margin: 0; } }';
        }
        document.head.appendChild(styleBlock);
    }

    function updateTransform() {
        const top = document.getElementById('marginTop').value; // mm
        const left = document.getElementById('marginLeft').value; // mm
        const scaleVal = document.getElementById('scale').value;
        const scale = scaleVal / 100;
        
        // Save to storage
        localStorage.setItem('printConfig', JSON.stringify({top, left, scale: scaleVal}));
        
        const container = document.querySelector('.page-container');
        
        // Convert mm to pixels (approx 3.78 px per mm) or use translate unit
        // Using mm directly in translate is supported
        container.style.transform = `translate(${left}mm, ${top}mm) scale(${scale})`;
        container.style.transformOrigin = 'top left';
        
        // Visual indicator that transform is active
        if (top != 0 || left != 0 || scale != 1) {
            container.style.border = '2px dashed orange'; // Warn on screen
        } else {
            container.style.border = 'none';
        }
    }
    
    // Initialize
    // Load saved settings
    const savedConfig = JSON.parse(localStorage.getItem('printConfig') || '{}');
    if (savedConfig.top !== undefined) document.getElementById('marginTop').value = savedConfig.top;
    if (savedConfig.left !== undefined) document.getElementById('marginLeft').value = savedConfig.left;
    if (savedConfig.scale !== undefined) document.getElementById('scale').value = savedConfig.scale;

    updatePaperSize();
    updateTransform(); // Apply loaded settings
    adjustAutoResizeInputs();

    // Auto-resize font for long text
    function adjustAutoResizeInputs() {
        const inputs = document.querySelectorAll('.auto-resize');
        inputs.forEach(input => {
            const resize = () => {
                let currentSize = 10; // Start with default size (10pt)
                input.style.fontSize = currentSize + 'pt';
                
                // Reduce size until it fits width or hits minimum (5pt)
                while (input.scrollWidth > input.clientWidth && currentSize > 5) {
                    currentSize -= 0.5;
                    input.style.fontSize = currentSize + 'pt';
                }
            };
            
            input.addEventListener('input', resize);
            // Run on load/init
            resize();
        });
    }
</script>

<!-- Screensaver Overlay -->
@php
    $bgCandidates = [
        'images/sogod-municipal.jpg',
        'images/sogod-municipal.jpeg',
        'images/sogod-municipal.png',
        'sogod-municipal.jpg',
        'sogod-municipal.jpeg',
        'sogod-municipal.png',
    ];
    $bgFound = null;
    foreach ($bgCandidates as $bp) {
        if (file_exists(public_path($bp))) { $bgFound = $bp; break; }
    }

    $logoCandidates = [
        'images/sogod-logo.png',
        'images/sogod-logo.jpg',
        'images/sogod-logo.gif',
        'sogod-logo.png',
        'sogod-logo.jpg',
        'sogod-logo.gif',
    ];
    $logoFound = null;
    foreach ($logoCandidates as $p) {
        if (file_exists(public_path($p))) {
            $logoFound = $p;
            break;
        }
    }
@endphp

<div id="screensaver-overlay">
    @if ($bgFound)
        <div class="screensaver-bg-blur" style="background-image: url('{{ asset($bgFound) }}');"></div>
    @endif
    
    <div style="text-align: center;">
        @if ($logoFound)
            @php
                $ext = strtolower(pathinfo($logoFound, PATHINFO_EXTENSION));
                $needsBlend = in_array($ext, ['gif','jpg','jpeg']);
            @endphp
            <img class="screensaver-logo {{ $needsBlend ? 'blend-remove-white' : '' }}" src="{{ asset($logoFound) }}" alt="Municipality of Sogod, Southern Leyte Logo">
        @endif
        <div style="font-size: 12pt; color: #555; margin-top: 20px;">Press any key or click to continue</div>
    </div>
</div>

<script>
    // Screensaver Logic
    (function() {
        let idleTimer;
        const screensaver = document.getElementById('screensaver-overlay');
        const IDLE_TIMEOUT = 60000; // 1 minute in milliseconds

        function showScreensaver() {
            screensaver.classList.add('active');
        }

        function hideScreensaver() {
            if (screensaver.classList.contains('active')) {
                screensaver.classList.remove('active');
            }
        }

        function resetTimer() {
            // Only hide if it's currently showing to avoid flickering or unnecessary DOM updates
            if (screensaver.classList.contains('active')) {
                hideScreensaver();
            }
            clearTimeout(idleTimer);
            idleTimer = setTimeout(showScreensaver, IDLE_TIMEOUT);
        }

        // Event listeners for activity
        ['mousemove', 'mousedown', 'keypress', 'touchstart', 'scroll', 'click', 'keydown'].forEach(evt => {
            window.addEventListener(evt, resetTimer, true);
        });

        // Initial timer start
        resetTimer();
    })();
</script>

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                })
                .catch(err => {
                    console.log('ServiceWorker registration failed: ', err);
                });
        });
    }
</script>

</body>
</html>
