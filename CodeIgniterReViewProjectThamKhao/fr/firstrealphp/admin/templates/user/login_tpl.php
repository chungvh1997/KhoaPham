
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(public/images/bg-3.jpg);">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#"><img src="public/images/logo.png"></a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Sign In To Admin</h3>
                        </div>
                        <form action="index.php?post=user&action=login" method="post" class="m-login__form m-form">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" name="username" value="admin" placeholder="Username" type="text">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" name="password" value='Eplus.vn123' placeholder="Password" type="password">
                            </div>

                            <div class="m-login__form-action">
                                <button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" id="m_login_signin_submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>