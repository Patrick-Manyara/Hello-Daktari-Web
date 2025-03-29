<?php

function registration_mail($userId, $userName)
{
    $userId = encrypt($userId, 1);
    $userName = encrypt($userName, 1);
    $verifyBefore = encrypt(time(), 1);

    $consolidated_link_value = $userId . '_' . $userName . '_' . $verifyBefore;
    $link_value = encrypt($consolidated_link_value, 1);

    $link = model_url . 'mail&auth=' . $link_value;

    $message = "
        <p>Welcome to PsychX. Your account was successfully created.</p> 
        <p>
            Before you can start adding your products, we kindly request that you verify your email by clicking
            <a href='$link'> link.</a>
        </p> 
        If you didn't try to sign up to Nicola Realty and you didn't enter your details on our registration page, 
        kindly contact; <br />
        Customer Care through: <b>wm</b>or <b>CUSTOMERCARE NUMBER</b> 
        and we'll see how we can assist you.<br />
        Thank you for choosing Nicola Realty 
    ";

    return $message;
}