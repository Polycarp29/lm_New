<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for reaching us out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-image: #ffffff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
            margin: 20px auto;
        }
        .logo-container {
            background-image: url('storage/download.jpeg');
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
            border-radius: 50%;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);

        }
        .logo-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background-color: #ffffff;
            padding: 20px;

        }
        .message h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 12px;
        }
        .message p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .footer {
            margin-top: 24px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
        }
        .footer p {
            margin: 6px 0;
            font-size: 14px;
            color: #666;
        }
        .footer .company {
            font-weight: bold;
            font-size: 16px;
            color: #222;
        }
        .footer .email {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            @foreach($logo as $logo)
            @if($logo)
                <img src="{{ asset('storage/' . $logo->logo) }}" alt="Company Logo">
            @endif
            @endforeach
        </div>
        <div class="message">
            <h3>Dear Customer, {{ $name .' '. $surname }}</h3>
          <p>
            We sincerely appreciate you reaching out to us.  We are grateful for the opportunity to assist you.
            Our team has received your request and is reviewing it with care. We are committed to providing you with the best service experience and will get back to you within the next six hours with further details.
            If you have any additional information or specific preferences, please don't hesitate to reply to this email. Thank you for choosing us—we look forward to serving you!
        </p>

        </div>
        <div class="footer">
            <p>Sincerely,</p>
            <p class="company">Lee Marketing Services</p>
            <p><a href="mailto:info@leemarketing.io" class="email">info@leemarketing.io</a></p>
        </div>
    </div>
</body>
</html>

