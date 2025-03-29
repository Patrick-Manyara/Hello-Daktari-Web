<?php

function get_system_metadata () {
    $sql = "
        SELECT 
            dateUpdated,
            systemMetaDataId,
            systemMetaDataName,
            systemMetaDataValue,
            systemMetaDataMoreInfo
        FROM
            SYSTEMMETADATA
        WHERE
            systemMetaDataStatus = 'active'
    ";
    
    return select_rows($sql);
}

function get_a_metadata ($metadataId) {
    $sql = "
        SELECT 
            systemMetaDataType,
            systemMetaDataName,
            systemMetaDataValue
        FROM
            SYSTEMMETADATA
        WHERE
            systemMetaDataId = '$metadataId'
        AND 
            systemMetaDataStatus = 'active'
    ";
    
    return select_rows($sql)[0];
}
