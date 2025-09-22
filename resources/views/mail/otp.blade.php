<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #333;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .verification-code {

            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-align: center;
            margin: 20px 0;

            /* background-color: #ffffff; */
            border: solid 2px #0867ec;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #0867ec;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            padding: 12px 24px;
            text-decoration: none;
            text-transform: capitalize;
            display: flex;
            justify-content: center;
            width: fit-content;
            margin: auto;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h4>Email Verification</h4>
            <h2>{{ config('app.name') }}.</h2>
        </div>
        <div class="content">
            <p>Hello {{ $user->name ?? 'there' }},</p>

            <p>Thank you for registering with <strong>{{ config('app.name') }}</strong>! We're excited to have you on
                board.</p>

            <p>To complete your registration, please verify your email address using the verification code below:</p>

            <div style="font-size: 24px; font-weight: bold; margin: 20px 0; letter-spacing: 4px; text-align: center;">
                {{ $otp }}
            </div>

            <p>If you did not sign up for a {{ config('app.name') }} account, please disregard this email. No further
                action is required.</p>

            <p>Thank you for choosing <strong>{{ config('app.name') }}</strong>! If you have any questions or need
                assistance, feel free to reach out to our support team.</p>

            <p>Best regards,<br>
                The {{ config('app.name') }} Team</p>

        </div>
        <div class="footer">
            <p>{{ $systemSettings?->address ?? '' }}</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
