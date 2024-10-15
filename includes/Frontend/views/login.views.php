<section class="login-section">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Log In</label>
                <label for="signup" class="slide signup">Sign Up</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <!-- Login form start -->
                <form class="login" method="post">
                    <div class="field">
                        <input type="username" placeholder="username" required name="username">
                    </div>
                    <div class="field">
                        <input type="password" placeholder="password" required name="password">
                    </div>
                    <div class="pass-link"><a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Log In">
                    </div>
                    <div class="signup-link">Haven't any an account? <span>Signup now</span></div>
                </form>
                <!-- Login form start -->

                <!-- Sign Up form start -->
                <form class="signup" method="post">
                    <div class="field">
                        <input type="text" placeholder="First Name" name="first_name" required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Last Name" name="last_name" required>
                    </div>
                    <div class="field">
                        <input type="username" placeholder="Username" name="username" required>
                    </div>
                    <div class="field">
                        <input type="email" placeholder="Your Email" name="email" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Confirm password" name="confirm_password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Sign Up">
                    </div>
                    <div class="login-link">Already have an account? <span>Log In</span></div>
                </form>
                <!-- Sign Up form end -->
            </div>
        </div>
    </div>
</section>