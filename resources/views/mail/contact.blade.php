<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 650px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .header {
            background: #1e3a8a;
            color: #ffffff;
            padding: 25px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
            color: #2d3748;
            font-size: 15px;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #1e3a8a;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }
        .content p {
            margin: 10px 0;
        }
        .label {
            font-weight: 600;
            color: #111827;
            display: inline-block;
            width: 80px;
        }
        .message-box {
            background: #f9fafb;
            border-left: 4px solid #1e3a8a;
            padding: 15px;
            margin-top: 20px;
            border-radius: 6px;
            font-style: italic;
            white-space: pre-line;
        }
        .footer {
            background: #f3f4f6;
            color: #6b7280;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>New Contact Message</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Contact Details</h2>
            <p><span class="label">Name:</span> {{ $contact['name'] }}</p>
            <p><span class="label">Email:</span> {{ $contact['email'] }}</p>
            <p><span class="label">Subject:</span> {{ $contact['subject'] ?? 'No subject provided' }}</p>

            <h2>Message</h2>
            <div class="message-box">
                {{ $contact['message'] }}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            {{-- Community Living and Support Services – Houston, Texas<br> --}}
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
