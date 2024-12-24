<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <!--[if gte mso 9]>
      <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG />
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
      </xml>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <title></title>

    <style type="text/css">
        @media only screen and (min-width: 620px) {
            .u-row {
                width: 600px !important;
            }

            .u-row .u-col {
                vertical-align: top;
            }

            .u-row .u-col-100 {
                width: 600px !important;
            }
        }

        @media (max-width: 620px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }

            .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }

            .u-row {
                width: 100% !important;
            }

            .u-col {
                width: 100% !important;
            }

            .u-col>div {
                margin: 0 auto;
            }
        }

        body {
            margin: 0;
            padding: 0;
        }

        table,
        tr,
        td {
            vertical-align: top;
            border-collapse: collapse;
        }

        p {
            margin: 0;
        }

        .ie-container table,
        .mso-container table {
            table-layout: fixed;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors="true"] {
            color: inherit !important;
            text-decoration: none !important;
        }

        @media (max-width: 480px) {
            .hide-mobile {
                max-height: 0px;
                overflow: hidden;
                display: none !important;
            }
        }

        table,
        td {
            color: #000000;
        }

        #u_body a {
            color: #0000ee;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            #u_content_image_1 .v-src-width {
                width: auto !important;
            }

            #u_content_image_1 .v-src-max-width {
                max-width: 31% !important;
            }

            #u_content_menu_1 .v-padding {
                padding: 0px 9px 12px !important;
            }

            #u_content_heading_1 .v-container-padding-padding {
                padding: 520px 10px 0px !important;
            }

            #u_content_heading_1 .v-font-size {
                font-size: 28px !important;
            }

            #u_content_text_1 .v-container-padding-padding {
                padding: 10px !important;
            }

            #u_content_button_1 .v-container-padding-padding {
                padding: 10px !important;
            }

            #u_content_button_1 .v-size-width {
                width: 65% !important;
            }

            #u_content_button_1 .v-text-align {
                text-align: center !important;
            }

            #u_content_text_2 .v-container-padding-padding {
                padding: 10px 10px 40px !important;
            }

            #u_content_social_1 .v-container-padding-padding {
                padding: 30px 10px 10px !important;
            }

            #u_content_text_3 .v-container-padding-padding {
                padding: 10px 10px 20px !important;
            }

            #u_content_image_2 .v-container-padding-padding {
                padding: 20px 10px 30px !important;
            }
        }
    </style>

    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700&display=swap" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Federo&display=swap" rel="stylesheet" type="text/css" />
    <!--<![endif]-->
</head>

<body class="clean-body u_body"
    style="
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      background-color: #ecf0f1;
      color: #000000;
    ">
    <div style="width: 50%; margin: auto; padding: 10px 50px;">
        <h1 style="border-bottom: 1px solid #000; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-bottom: 10px; font-size: 14px;">Invoice Details</h1>
        <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">HELLO   <span style="font-weight: bold;">{{$details["name"]}}</span></p><br>
        <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;  margin-bottom: 10px;">Wellcome to <span style="font-weight: bold;">Load Serv</span>,
        </p>


        <h5>Invoice Number: {{$details["number"]}}</h5>
        <h5>Invoice Amount: {{$details["amount"]}} EGP</h5>


        <br><br>

        <div style="text-align: center">
            <a href="https://www.google.com" style="margin: 0px 4px;">Contact us</a>
            <a href="https://www.google.com" style="margin: 0px 4px;">FAQs</a>
            <a href="https://www.google.com" style="margin: 0px 4px;">About us</a>
            <a href="https://www.google.com" style="margin: 0px 4px;">Terms and conditions </a>
            <a href="https://www.google.com" style="margin: 0px 4px;">Privacy </a>

            <br>
        </div>
    </div>
</body>

</html>
