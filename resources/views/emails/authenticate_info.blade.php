<!DOCTYPE html>
<html>
<head>
    <title>Bienvenu sur HealthSync</title>
</head>
<body>
    <h1>Bienvenue sur HealthSync, {{ $user->name }}!</h1>
    <p>Voici vos informations de connexion :</p>
    <p>Email : {{ $user->email }}</p>
    <p>Mot de passe : {{ $password }}</p>
    <p>Cliquez <a href="http://127.0.0.1:8000/login">ici</a> pour vous connecter</p>
    <p>Merci de vous connecter et de changer votre mot de passe dès que possible.</p>
</body>
</html>