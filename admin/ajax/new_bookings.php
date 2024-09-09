<?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();
    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);
        $limit = 10;
        $page = $frm_data['page'];
        $start = ($page-1) *  $limit;
        $query = "SELECT bo.*, bd.* FROM `booking_order` bo
        INNER JOIN `booking_details` bd on bo.booking_id = bd.booking_id
        WHERE (bd.phonenum LIKE ? OR bd.user_name LIKE ?)
        ORDER BY bo.booking_id DESC";

        $res = select($query,["%$frm_data[search]%","%$frm_data[search]%"],'ss');
        $limit_query = $query ." LIMIT $start,$limit";
        $limit_res = select($limit_query,["%$frm_data[search]%","%$frm_data[search]%"],'ss');

        
        $total_rows = mysqli_num_rows($res);
        if($total_rows == 0){
            $output = json_encode(["table_data"=>"<b>No Data Found!</b>","pagination"=>'']);
            echo $output;
            exit;
        }
        
        $i = $start+1;
        $table_data = "";
        
        while($data = mysqli_fetch_assoc($limit_res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));
            $table_data .="
                <tr>
                    <td>$i</td>
                    <td>
                       <b>Name :</b> $data[user_name]
                       <br>
                       <b>Phone No:</b> $data[phonenum]
                    </td>
                    <td>
                        <b>Room:</b> $data[room_name]
                        <br>
                        <b>Price:</b> $data[price]
                    </td>
                    <td>
                        <b>Check in:</b> $checkin
                        <br>
                        <b>Check out:</b> $checkout
                        <br>
                        <b>Date:</b> $date
                    </td>
                </tr>
            ";
            $i++;
        }
         $pagination = "";

        if($total_rows>$limit)
        {
            $total_pages = ceil($total_rows/$limit);

            if($page!=1){
                $pagination .= "<li class='page-item'><button onclick='change_page(1)' class='page-link'>First</button></li>";
            }

            $disabled = ($page==1) ? "disabled" : "";
            $prev = $page-1;
            $pagination .= "<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'>Prev</button></li>";
            $disabled = ($page==$total_pages) ? "disabled" : "";
            $next = $page+1;
            $pagination .= "<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link'>Next</button></li>";
            if($page!=$total_pages){
                $pagination .= "<li class='page-item'><button onclick='change_page($total_pages)' class='page-link'>Last</button></li>";
            }
        }

        $output = json_encode(["table_data"=>$table_data,"pagination"=>$pagination]);
        echo $output;
    }
?>