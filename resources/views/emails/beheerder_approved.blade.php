<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Beheerder geactiveerd</title>
</head>
<body style="font-family: Arial, sans-serif; color:#222; line-height:1.5;">
    <h2 style="color:#3b3b3b">Je beheeraccount is geactiveerd</h2>

    <p>Hallo {{ $beheerder->naam }},</p>

    <p>Je beheeraccount is goedgekeurd en geactiveerd. Je kunt nu inloggen met je e-mailadres.</p>

    <p>
        <a href="{{ route('login') }}" style="display:inline-block;padding:10px 14px;background:#10b981;color:#fff;border-radius:4px;text-decoration:none;">
            Inloggen
        </a>
    </p>

    <p>Groeten,<br>Stichting Paastoernooien</p>
</body>
</html>