<footer>
  <hr>
    <h4>Espace <em>Administration</em></h4>
    <?php if ( isset( $_SESSION[ 'ID' ] ) AND isset( $_SESSION[ 'login' ] ) ): ?>
      <p>Bienvenue <em><?php echo $_SESSION['user_name'] ?></em> ! Vous êtes actuellement connecté.</p>
      <a class="button button-primary" href="index.php?page=admin-panel" title="accéder à la page d'administration">Tableau de bord</a>
      <form action="http://monblog.local/index.php?<?php echo $_SERVER['QUERY_STRING'] ?>&logoutattempt=true" method="post">
        <fieldset>
          <legend>Formulaire de déconnexion</legend>
          <div class="input-group">
            <input type="submit" name="logout-submit" value="Se déconnecter">
          </div>
        </fieldset>
      </form>
    <?php else: ?>
      <form class="container" action="http://monblog.local/index.php?<?php echo $_SERVER['QUERY_STRING'] ?>&loginattempt=true" method="post">
        <fieldset>
          <legend>Formulaire de connexion</legend>
          <div class="row">
            <div class="six columns">
              <label for="login-name">Pseudonyme :</label>
              <input type="text" class="u-full-width" name="login-name" placeholder="Pseudonyme...">
            </div>
            <div class="six columns">
              <label for="login-password">Mot de passe :</label>
              <input type="password" class="u-full-width" name="login-password">
            </div>
          </div>
          <div class="row">
            <input type="submit" class="button-primary u-full-width" name="login-submit" value="Se connecter" title="Seuls les modérateurs sont habilités à se connecter à l'espace Administration du site !">
            <?php if( isset( $_POST['alert'] ) ) : ?>
              <span class="alert"><?php echo $_POST['alert'] ?></span>
            <?php endif; ?>
          </div>
        </fieldset>
      </form>
    <?php endif; ?>
  <p><small>&copy; 2018 - Dimitri Grabette</small></p>
</footer>
