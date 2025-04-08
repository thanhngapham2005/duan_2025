<?php
function connDBAss()
{
    $host = "mysql:host=localhost;dbname=duan;charset=utf8";
    $user = "root";
    $pass = "";
    try {
        $conn = new PDO($host, $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $th) {
        echo "kết nối lỗi:" . $th->getMessage();
        // return null;
    }
}
$conn = connDBAss();
function getOderStatus($status){
    $statuses = [
        0 => "Cho xac nhan",
        1 => "Da xac nhan",
        2 => "Cho lay hang",
        3 => "Dang van chuyen",
        4 => "Dang hoan tra hang",
        5 => "Giao hang thanh cong",
        6 => "Da huy",
    ];
    return $statuses[$status] ?? "Khong ton tai";
}
function renderOrders($orders) {
    if(!empty($orders)){
        $groupedOrders = [];
        foreach ($orders as $order) {
            $idBill = $order['id_bill'];
            if (!isset($groupedOrders[$idBill])) {
                $groupedOrders[$idBill] = [
                    'id_bill' => $idBill,
                    'quantity' => 0,
                    'total_price' => 0,
                    'status' => $order['status'],
                    'purchase_date' => $order['purchase_date'],
                ];
            }
            $groupedOrders[$idBill]['quantity'] += $order['quantity'];
            $groupedOrders[$idBill]['total_price'] += $order['price'] * $order['quantity'];
        }
        echo '<table class="table table-striped">
        <thead>
        <tr>
          <th>Ma don hang</th>
          <th>So luong san pham</th>
          <th>Tong gia tri</th>
          <th>Trang thai</th>
          <th>Ngay mua</th>
          <th>Thao tac</th>
        </tr>
        </thead>
        </tbody>';
        foreach ($groupedOrders as $order) {
            $totalPrice = number_format($order['total_price']);
           
            echo "<tr>
            <td>{$order['id_bill']}</td>
            <td>{$order['quantity']}</td>
            <td>{$totalPrice} d</td>
            <td>" . getOderStatus($order['status']) . "</td>
            <td>{$order['purchase_date']}</td>
            <td>
                <a href='?act=orderDetail&id={$order['id_bill']}' class='btn btn-primary'>Xem chi tiết</a>
            </td>
          </tr>";
    
        }
        echo '</tbody>
        </table>';





          
    }else{
        echo '<div class="text-center mt-5">
          <img src="https://frontend.tikicdn.com/_desktop-next/static/img/account/empty-order.png" alt="Empty orders" class="img-fluid mb-3" style="max-width: 150px;">
                <p>Chưa có đơn hàng</p>
        </div>';
    }
}
