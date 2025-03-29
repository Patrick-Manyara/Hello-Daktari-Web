<?php

function get_products()
{
    $sql = "
       SELECT 
            *
        FROM 
            product
        ORDER BY
            product_date_created
        DESC
    ";

    return select_rows($sql);
}

function get_single_product($product_id)
{
    $sql = "
        SELECT 
            *
        FROM 
            product
        WHERE
            product_id =  '$product_id'
        
    ";

    return select_rows($sql)[0];
}

function get_featured_product($KEY)
{
    $sql = "SELECT * FROM product WHERE product_group = 'featured' ";
    return select_rows($sql)[$KEY];
}



//SHOP PAGE
function get_products_for_shop_page($start = 0, $order_by = 'product_date_created DESC', $limit = null)
{
    $sql = " SELECT  * FROM  product WHERE product_status = 'active' ";
    $sql .= " ORDER BY $order_by  LIMIT  $start ";
    if (!empty($limit)) {
        $sql .= ",$limit";
    }
    return select_rows($sql);
}

function get_all_products($order_by = 'product_date_created DESC',$limit = '')
{
    $sql = " SELECT  * FROM  product WHERE product_status = 'active'  ";
    if(!empty($order_by)){
        $sql .= " ORDER BY $order_by ";
    }
    if(!empty($limit)){
        $sql .= " LIMIT $limit  ";
    }
    return select_rows($sql);
}

function get_all_products2($order_by = 'product_date_created DESC', $start='', $limit = '')
{
    $sql = " SELECT  * FROM  product WHERE product_status = 'active'  ";
    $sql .= " ORDER BY $order_by ";
    $limit != '' ? $sql .= " LIMIT $limit OFFSET $start " : " ";
    return select_rows($sql);
    // echo $sql;
}


function get_products_by_type($type = '', $limit = '')
{
    $sql = "SELECT * FROM  product WHERE product_status = 'active' ";
    $type != '' ? $sql .= " AND product_group = '$type' " : " ";
    $sql .= " ORDER BY rand() ";
    $limit != '' ? $sql .= " LIMIT $limit " : " ";
    return select_rows($sql);
}

function get_products_on_sale($limit = '')
{
    $sql = "SELECT * FROM  product  WHERE product_offer_price > 0  AND product_status = 'active'  ORDER BY rand() ";
    $limit != '' ? $sql .= " LIMIT $limit " : " ";
    return select_rows($sql);
}

function get_products_count()
{
    $sql = "SELECT product_id FROM  product WHERE product_status = 'active'  ";
    return sql_counter($sql);
}


//CATEGORY PAGES
function get_products_for_category_page($start = 0, $order_by = 'product_date_created DESC', $limit = null, $category_id = "")
{
    $sql = " SELECT  * FROM  product WHERE category_id = '$category_id' AND product_status = 'active' ";
    $sql .= " ORDER BY $order_by  LIMIT  $start ";
    if (!empty($limit)) {
        $sql .= ",$limit";
    }
    return select_rows($sql);
}

function get_products_for_category_page2($order_by = 'product_date_created DESC', $category_id="", $start='', $limit = '')
{
    $sql = " SELECT  * FROM  product WHERE category_id = '$category_id' AND product_status = 'active'  ";
    $sql .= " ORDER BY $order_by ";
    return select_rows($sql);
    // echo $sql;
}

function get_products_for_category_page3($order_by = 'product_date_created DESC', $category_id="", $start='', $limit = '')
{
    $sql = " SELECT  * FROM  product WHERE category_id = '$category_id' AND product_status = 'active'  ";
    $sql .= " ORDER BY $order_by ";
    $limit != '' ? $sql .= " LIMIT $limit OFFSET $start " : " ";
    return select_rows($sql);
    // echo $sql;
}



function get_products_by_category($category_id, $order = '', $limit = '',$product_id='')
{
    $sql = "SELECT * FROM product WHERE category_id = '$category_id' AND product_status = 'active' ";
    $product_id != '' ? $sql .= " AND product_id != '$product_id' " : " ";
    $order      != '' ? $sql .= " ORDER BY $order " : " ORDER BY product_date_created DESC";
    $limit      != '' ? $sql .= " LIMIT $limit " : " ";
    return select_rows($sql);
}

function get_products_by_category_count($category_id)
{
    $sql = "SELECT product_id FROM product WHERE category_id = '$category_id' AND product_status = 'active' ";
    return sql_counter($sql);
}

function get_product_count_by_category($category_id)
{
    $sql = "SELECT * FROM product WHERE category_id = '$category_id'  AND product_status = 'active' ";
    return sql_counter($sql);
}


//SUBCATEGORY PAGES
function get_products_for_subcategory_page($start = 0, $order_by = 'product_date_created DESC', $limit = null, $subcategory_id="")
{
    $sql = " SELECT  * FROM  product WHERE subcategory_id = '$subcategory_id' AND product_status = 'active' ";
    $sql .= " ORDER BY $order_by  LIMIT  $start ";
    if (!empty($limit)) {
        $sql .= ",$limit";
    }
    return select_rows($sql);
}

function get_products_for_subcategory_page2($order_by = 'product_date_created DESC', $subcategory_id="")
{
    $sql = " SELECT  * FROM  product WHERE subcategory_id = '$subcategory_id' AND product_status = 'active' ";
    $sql .= " ORDER BY $order_by ";
    return select_rows($sql);
}

function get_products_for_subcategory_page3($order_by = 'product_date_created DESC', $category_id="", $start='', $limit = '')
{
    $sql = " SELECT  * FROM  product WHERE subcategory_id = '$category_id' AND product_status = 'active'  ";
    $sql .= " ORDER BY $order_by ";
    $limit != '' ? $sql .= " LIMIT $limit OFFSET $start " : " ";
    return select_rows($sql);
}

function get_products_by_subcategory($subcategory_id, $order = '', $limit = '',$product_id='')
{
    $sql = "SELECT * FROM product WHERE subcategory_id = '$subcategory_id' AND product_status = 'active' ";
    $product_id != '' ? $sql .= " AND product_id != '$product_id' " : " ";
    $order      != '' ? $sql .= " ORDER BY $order " : " ORDER BY product_date_created DESC";
    $limit      != '' ? $sql .= " LIMIT $limit " : " ";
    return select_rows($sql);
} 



function get_products_by_subcategory_count($id, $name, $subcategory_id)
{
    $sql = "SELECT product_id FROM product WHERE subcategory_id = '$subcategory_id' AND product_status = 'active' ";
    if (($id != null) && ($name != null)) $sql .= " AND $name = '$id'";
    return sql_counter($sql);
}



function get_product_count_by_subcategory($subcategory_id)
{
    $sql = "SELECT * FROM product WHERE subcategory_id = '$subcategory_id' AND product_status = 'active' ";
    return sql_counter($sql);
}

//BRANDS PAGES

function get_products_for_brand_page($start = 0, $order_by = 'product_date_created DESC', $limit = null, $brand_id="")
{
    $sql = " SELECT  * FROM  product WHERE brand_id = '$brand_id' AND product_status = 'active' ";
    $sql .= " ORDER BY $order_by  LIMIT  $start ";
    if (!empty($limit)) {
        $sql .= ",$limit";
    }
    return select_rows($sql);
}

function get_product_count_by_brand($brand_id)
{
    $sql = "SELECT * FROM product WHERE brand_id = '$brand_id' AND product_status = 'active' ";
    return sql_counter($sql);
}

function get_products_by_brand_count($id, $name, $brand_id)
{
    $sql = "SELECT product_id FROM product WHERE brand_id = '$brand_id' AND product_status = 'active' ";
    if (($id != null) && ($name != null)) $sql .= " AND $name = '$id'";
    return sql_counter($sql);
}

//SEARCH PAGE

function get_search_results($name, $cid = '', $order = '', $limit = '')
{
    $sql = "SELECT * FROM  product WHERE product_status = 'active' AND product_name LIKE '%$name%' ";
    $cid != '' ? $sql .= " AND category_id =  '$cid' " : " ";
    $order != '' ? $sql .= " ORDER BY $order " : " ORDER BY product_date_created DESC";
    $limit != '' ? $sql .= " LIMIT $limit " : " ";
    return select_rows($sql);
}


//JSON
function json_products()
{
    $sql = "SELECT product_name FROM product GROUP BY product_name ";
    $products = select_rows($sql);
    $products_array = array();
    foreach($products as $item){
        $products_array[] = $item['product_name'];
    }
    return json_encode($products_array);
}