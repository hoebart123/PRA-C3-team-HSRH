<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Nieuwe beheerder aanvraag</title>
</head>
<body style="font-family: Arial, sans-serif; color:#222; line-height:1.5;">
    <h2 style="color:#3b3b3b">Nieuwe beheerder aanvraag</h2>

    <p>Er is een nieuwe aanvraag voor een beheeraccount:</p>

    <ul>
        <li><strong>Naam:</strong> {{ $beheerder->naam }}</li>
        <li><strong>E-mail:</strong> {{ $beheerder->email }}</li>
        <li><strong>School:</strong> {{ $beheerder->school ?? '-' }}</li>
    </ul>

    <p>Bezoek het beheerderspaneel om de aanvraag te beoordelen:</p>

    <p><a href="{{ route('beheerders.index') }}" style="display:inline-block;padding:10px 14px;background:#5b21b6;color:#fff;border-radius:4px;text-decoration:none;">Naar beheerdersoverzicht</a></p>

    <p>Groeten,<br>Stichting Paastoernooien</p>
</body>
</html>