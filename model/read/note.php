<?php
function get_all_notes($doctor_id = '')
{
    $sql = "SELECT note.*, session.doctor_id, session.session_payment_status FROM session JOIN note ON session.session_id = note.session_id WHERE session.session_payment_status = 'paid' ";
    $doctor_id != '' ? $sql .= " AND session.doctor_id = '$doctor_id' " : " " ;
    $sql .= " ORDER BY note.note_date_created";
    return select_rows($sql);
}

?>