<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.5;">
    <h2 style="margin-bottom: 12px;">New Contact Message</h2>

    <p><strong>Locale:</strong> {{ $locale }}</p>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Service:</strong> {{ $data['service'] ?: 'General Inquiry' }}</p>

    <h3 style="margin-top: 18px; margin-bottom: 8px;">Message</h3>
    <p style="white-space: pre-wrap;">{{ $data['msg'] }}</p>
</body>
</html>
