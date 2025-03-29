<?php

const WARNING_DEFINITION = array(
    300 => 'Kindly login to continue',
    301 => 'Your session have been logged out, login to continue',
    302 => 'Logout failed because request blocked because of expired token',
    303 => 'The original price cannot be less the new price',
    304 => 'fraud alert, request blocked',
    305 => 'request blocked because of expired token'
);

function render_warning($location)
{
    global $warning;

    if (!empty($warning)) {
        $session_warning = array('warning' => array_filter(array_unique($warning)));
        session_assignment($session_warning, false);
        redirect_header($location);
    }

    return null;
}

function unset_session_warning()
{
    if (isset($_SESSION['warning'])) unset($_SESSION['warning']);
}
