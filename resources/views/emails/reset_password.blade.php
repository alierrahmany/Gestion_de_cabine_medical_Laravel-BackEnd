<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    <h1>Réinitialisation de mot de passe</h1>
    <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
    <a href="{{ url('/reset-password?token=' . $token) }}">Réinitialiser mon mot de passe</a>
</body>
</html>