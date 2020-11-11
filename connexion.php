<?php


require_once 'inc/header.php';
?>
        
        <section class="login-section">
            <section class="login-container mtxxl">
                <h3 class="loginh3">Connectez-vous</h3>
                <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
        
                <form id="signup" method="get">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" size="30" placeholder="Enter your email address" required>
        
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" size="30" placeholder="Enter your password" required>
        
                    <label class="checkbox"><input type="checkbox" name="save" value="" /> Conserver mes identifiants de connexion </label>
        
                    <a href="/forgot-password" class="forgot-link"> Vous avez oublié votre mot de passe ?</a>
        
                    <button id="login-submit" value="" type="submit">Connexion</button>
                </form>
            </section><!--
            
         --><section class="signup-container mtxxl">
                <h3 class="loginh3">Je crée mon compte </h3>
                <p class="explanatory-text">Pour suivre toutes les étapes de notre collaboration.</p>
        
                <form id="log-in"method="send">
                    <div class="name-container">
                        <div>
                            <label for="first-name">Votre prénom</label>
                            <input type="text" id="first-name" size="30" placeholder="Your first name" required>
                        </div>
        
                        <div>
                            <label for="last-name">Votre Nom</label>
                            <input type="text" id="last-name" size="30" placeholder="Your last name" required>
                        </div>
                    </div>
        
                    <label for="signup-email">Email</label>
                    <input type="email" id="singup-email" size="30" placeholder="Enter your email address" required>
        
                    <label for="signup-password">Mot de passe</label>
                    <input type="password" id="signup-password" size="30" placeholder="Enter a strong password" required>
        
                    <label class="checkbox"><input type="checkbox" name="accept-terms" value="" /> J'accepte les <a href="/terms" target="_blank">Terms &amp; Conditions</a></label>
        
                    <button id="signup-submit" value="" type="submit">Je m'enregistre</button>
                </form>
            </section>
            
            <section class="switcher-overlay">
                <svg    viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path  d="M 0,0 L 100,0 L 80,100 L 0,100 z"></path>
                </svg>
                <div class="signup-text">
                    <h3 class="loginh3">Vous n'avez pas crée votre compte?</h3>
                    <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
                    <button class="switch">Je m'enregistre</button>
                </div>
        
                <div class="login-text">
                    <h3 class="loginh3">Vous avez déjà un compte ?</h3>
                    <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
                    <button class="switch">Connexion</button>
                </div>
            </section>
        
        </section>



   

        <?php
require_once 'inc/footer.php';  