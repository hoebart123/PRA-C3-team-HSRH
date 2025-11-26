<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Beheerder verwijderd</title>
</head>
<body style="font-family: Arial, sans-serif; color:#222; line-height:1.5;">
    <h2 style="color:#3b3b3b">Beheerder verwijderd</h2>

    <p>De volgende beheerder is verwijderd:</p>

    <ul>
        <li><strong>Naam:</strong> {{ $beheerder->naam }}</li>
        <li><strong>E-mail:</strong> {{ $beheerder->email }}</li>
    </ul>

    <p>Indien dit een fout is, neem contact op met de organisatie.</p>

    <p>Groeten,<br>Stichting Paastoernooien</p>
</body>
</html>