<div class="container">
    <div class="authform">
        <div class="brand">
            <img class="brand-logo" src="<?= BASEURL; ?>/img/LOGO.jpg" alt='logo'/>
        </div>
        <div class="main-form">
            <div class="title-form">
                <h2>Login</h2>
            </div>
            <form method="POST" action="<?= BASEURL; ?>/auth/authenticate" class="form" >
                <div class="form-group">
                    <input type="text" name="username" maxlength="50" id="username" class="form-input" required />
                    <label for="username" class="form-label">Username</label>
                </div>  
                <div class="form-group">
                    <input type="password" name="password" id="password" maxlength="6" class="form-input" required />
                    <label for="password" class="form-label">Password</label>
                </div>  
                <div class="form-button">
                    <button type="submit" name="login" class="btn-submit">LOGIN</button>
                    <div class="btn-back">
                        <a href="../../index.php">BATAL</a>
                    </div>
                </div>
                <div class="footer-form">
                    <a class="footer-link" href='../auth/forgetpassword.php'>Lupa password?</a>
                </div>
            </form>
        </div>
    </div>
</div>