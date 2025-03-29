<?php

const SUCCESS_DEFINITION = array(
    200 => 'registration successful, advice user to use the link sent to their email for password setup.',
    201 => 'user update successful',
    202 => 'Post update successful',
    203 => 'Post addition successful',
    204 => 'Welcome to ' . APP_NAME,
    205 => 'Images addition successful',
    206 => 'Images update successful',
    207 => 'admin addition successful',
    208 => 'admin update successful',
    209 => 'Message update successful, feedback sent to customer via email',
    210 => 'category update successful',
    211 => 'category addition successful',
    212 => 'Data Deleted successfully',
    213 => 'Delivery place added successful',
    214 => 'Delivery update successfully',
    215 => 'MetaData update successful',
    216 => 'Order update successful',
    217 => 'Submission update successful',
    218 => 'Doctor details updated successfully',
    219 => 'Doctor details added successfully',
    220 => 'data addition was successful',
    221 => 'info updated successfully',
    222 => 'Community Manager info updated successfully',
    223 => 'Community Manager info added successfully',
    224 => 'banner successfully edited',
    225 => 'banner successfully created',
    226 => 'User details edited successfully',
    227 => 'Session details logged successfully',
    228 => 'Review posted successfully',
    229 => 'Comment posted successfully',
    230 => 'Account successfully created. Check your email (mail or spam) for your login credentials',
    231 => 'Details received. Choose a doctor to proceed',
    232 => 'Prescription received successfully',
    233 => 'Comment edited successfully',
    234 => 'Records saved. Proceed to payment'
);

function render_success($location)
{
    global $success;

    if (!empty($success)) {
        $session_success = array('success' => array_filter(array_unique($success)));
        session_assignment($session_success, false);
        redirect_header($location);
    }

    return null;
}

function unset_session_success()
{
    if (isset($_SESSION['success'])) unset($_SESSION['success']);
}

require_once MODEL_PATH . 'warning.php';
