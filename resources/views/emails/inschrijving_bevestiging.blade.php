<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bevestiging inschrijving</title>
</head>
<body style="font-family:Arial, sans-serif; color:#222;">
    <h2>Bevestiging inschrijving</h2>

    <p>Bedankt voor je inschrijving. Dit zijn de doorgegeven gegevens:</p>

    <ul>
        <li><strong>School:</strong> {{ $data['schoolnaam'] ?? '-' }}</li>
        <li><strong>Contactpersoon:</strong> {{ $data['contactpersoon'] ?? '-' }}</li>
        <li><strong>E-mail:</strong> {{ $data['email'] ?? '-' }}</li>
        <li><strong>Opmerking:</strong> {{ $data['opmerking'] ?? '-' }}</li>
    </ul>

    <p>Wij nemen zo spoedig mogelijk contact op. Een kopie van deze bevestiging is ook naar de organisatie gestuurd.</p>

    <p>Groeten,<br>Stichting Paastoernooien</p>
</body>
</html>