<body>
    <h1>Modification de compte</h1>
    <form action="/PiePHP/user/update" method="post">
        <label for="email">Modifier votre mail :</label>
        <input type="email" name="email" id="email">
        <label for="password">Modifier votre mot de passe :</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="subForm">
    </form>
</body>