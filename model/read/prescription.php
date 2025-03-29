<?php
function get_all_prescriptions($did = '',$pid ='')
{
    $sql = "SELECT * FROM  prescription ";
    $did != '' ? $sql .= " WHERE doctor_id = '$did' " : " ";
    $pid != '' ? $sql .= " WHERE user_id = '$pid' " : " ";
    $sql .= " ORDER BY prescription_date_created DESC ";
    return select_rows($sql);
}

function get_medication($id)
{
    $sql = "SELECT * FROM  medication WHERE prescription_id = '$id' ORDER BY medication_name ASC ";
    return select_rows($sql);
}

function get_medication_details($mid)
{
    $sql = "SELECT * FROM  medication WHERE medication_id = '$mid' ";
    $med =  select_rows($sql)[0];
    return $med['medication_name'] . " - " . $med['medication_dose'] . " - " . $med['medication_route'] . " - " . $med['medication_frequency'] . " - " . $med['medication_duration'];
}