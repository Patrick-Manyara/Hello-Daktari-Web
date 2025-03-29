<?php
$page = 'home';
include_once 'header.php';

require 'google/vendor/autoload.php';
$clientID       = '477685653482-ve99eiatavqcqjhbuc8i7kt681fk8qgu.apps.googleusercontent.com';
$clientSecret   = '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';
$redirectUrl    = 'https://hellodaktari.org/login.php';


//CREATE CLIENT REQUEST TO GOOGLE
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->setAccessType('offline');


$client->addScope('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $token = $token['access_token'];
    $client->setAccessToken($token);
    $o_auth = new Google_Service_Oauth2($client);
    $user_data = $o_auth->userinfo_v2_me->get();

    $login = get_user($user_data['email'], 'user_email');

    if (empty($login)) {
        $id = $arr['user_id']   = create_id2('user', 'user_id');
        $password               = generateRandomString();
        $arr['user_password']   = password_hashing_hybrid_maker_checker($password);
        $arr['user_name']                    = $user_data['name'];
        $arr['user_email']                   = $user_data['email'];

        if (!build_sql_insert('user', $arr)) {
            $error['user'] = 139;
            error_checker($redirectUrl);
        }


        $name       = APP_NAME;
        $subject    = APP_NAME . " Sign Up";


        $body       = '<p style="font-family:Poppins, sans-serif; ">Welcome to ' . APP_NAME . ' ' . $arr['user_name'] . '  <br>';
        $body       .= 'We are so happy you have signed up.  <br>';
        $body       .= '<br><br>You may log in to your account <a href="https://jambosure.com/login.php" style="cursor:pointer;"><b> BY CLICKING HERE </b></a>';
        $body       .= '<br>';
        $body       .= 'Use <b><u>' . $password . '</u></b> as your password and feel free to change it once inside.';
        $body       .= '</p>';
        $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> JamboSure Management</p>';

        $session_login  = array(
            'user_login'        => true,
            'user_email'        => $user_data['email'],
            'user_name'         => $user_data['name'],
            'user_id'           => $id,
            'success'           => array('login' => 204)
        );

        $body2 = '<p style="font-family:Poppins, sans-serif; ">A new user has signed up to ' . APP_NAME . ' with the details: <br> <b>USERNAME: </b> ' . $arr['user_name'] . ' <br>';
        $body2 .= ' <b>EMAIL: </b> ' . $arr['user_email'] . ' <br> ';
        $body2 .= '</p>';

        session_assignment($session_login);

        email($arr['user_email'], $subject, $name, $body);
        email('info@jambosure.com', $subject, $name, $body2);
        $success['user'] = 230;
        render_success(base_url);
    }else{
         $session_login  = array(
        'user_login'        => true,
        'user_email'        => $user_data['email'],
        'user_name'         => $login['user_name'],
        'user_id'           => $login['user_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);
    render_success(base_url);
}
    }

   

?>


<section style="background:#FFF;" class="AppSection">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-12 MaxHeight">
            <img src="assets/img/images/curve1.PNG" class="CurvedImg" />
        </div>
        <div class="col-lg-6 col-sm-12 col-12">
            <div class="DeeFlex MaxHeight">
                <div class="AppointmentCard Margins">
                    <div class="AppointmentCardInner">
                        <h3 class="AitchOneLight" style="margin: 1em;">
                            Welcome Back
                        </h3>
                        <div>
                              <div class="sign__in text-center">
                                    <a href="<?= $client->createAuthUrl() ?>" style="color:#fff" class="sign__social g-plus text-start mb-15"><i class="fab fa-google-plus-g"></i>Sign Up with Google</a>
                                    <p style="text-align: center;"> <span>........</span> Or sign in with your email<span> ........</span> </p>
                                </div>

                        </div>
                        <div class="row Margins">
                            <form method='post' action="<?= model_url ?>user_login" style="width: 100%;">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group ModalFormInput">
                                        <div class="form-group ModalFormInput">
                                            <input type="email" name="user_email" class="form-control AppointmentInput" placeholder="Enter Your Email" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group ModalFormInput">
                                        <div class="form-group ModalFormInput">
                                            <input type="password" name="user_password" class="form-control AppointmentInput" placeholder="Enter Your Password" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="TransBtn FullWidth">
                                        Continue
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        width: 100%;
        margin: 10px 0em;
        height: 3em;
    }

    .sign__social {
        display: block;
        height: 50px;
        background: #e93e30;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        position: relative;
        line-height: 48px;
        padding-left: 23px;
        z-index: 1;
        overflow: hidden;
        font-size: 16px;
        color: #ffffff
    }

    .sign__social i {
        color: #ffffff;
        font-size: 16px;
        margin-right: 50px;
    }
</style>


<?php
include_once 'footer.php';
?>