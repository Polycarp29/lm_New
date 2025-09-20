<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEO Analysis Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #f9fafb;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .logo-container {
            width: 96px;
            height: 96px;
            background-color: white;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }
        .message h3 {
            font-size: 20px;
            padding: 16px 0;
        }
        .message p {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            margin-top: 16px;
        }
        .footer p {
            margin: 4px 0;
        }
        .footer .company {
            font-weight: bold;
            font-size: 16px;
        }
        .footer .email {
            font-size: 14px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="{{ asset('assets/images/logo.png')}}" alt="Company Logo" width="80" height="80">
        </div>
        <div class="message">
            <h3>Hi,</h3>
            <p>
                Hello, We have received your email request for SEO analysis of site <strong>poltechsolutions.com.</strong>
                Our team will reach out to you with a full analysis of your site and possible recommendations.
            </p>
        </div>
        <div class="footer">
            <p>Sincerely,</p>
            <p class="company">Lee Marketing Services</p>
            <p class="email">info@leemarketing.io</p>
        </div>
    </div>
</body>
</html>
