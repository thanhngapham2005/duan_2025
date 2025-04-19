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
        0 => "Chờ xác nhận ",
        1 => "Đã xác nhận",
        2 => "Chờ lấy hàng",
        3 => "Đang vận chuyển ",
        4 => "Đang hoàn trả hàng ",
        5 => "Giao hàng thành công ",
        6 => "Đã hủy ",
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
          <th>Mã đơn hàng </th>
          <th>Số lượng sản phẩm </th>
          <th>Tổng giá trị </th>
          <th>Trạng thái </th>
          <th>Ngày mua </th>
          <th>Thao tác </th>
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
