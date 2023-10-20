<?php

global $wpdb;




/* Payment Notify
 * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
 * Các bước thực hiện:
 * Kiểm tra checksum 
 * Tìm giao dịch trong database
 * Kiểm tra số tiền giữa hai hệ thống
 * Kiểm tra tình trạng của giao dịch trước khi cập nhật
 * Cập nhật kết quả vào Database
 * Trả kết quả ghi nhận lại cho VNPAY
 */

$servername = "localhost";
$username = "revica";
$password = "s2AoHZAuQd8SC566JIZb";
$dbname = "revica";

$vnp_HashSecret = "KCCPYGTZEVTVLMQJOEYDVRRRAQVXSYWR"; //Chuỗi bí mật

$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
if ($secureHash == $vnp_SecureHash) {
    if ($_GET['vnp_ResponseCode'] == '00') {

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $code = str_replace('RVC','',$_GET['vnp_TxnRef']);

        $sql = "SELECT ID FROM wp_posts WHERE ID = " . $code;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $sql = "UPDATE wp_posts SET post_status = 'wc-completed' WHERE ID = " . $row["ID"];
                if ($conn->query($sql) === TRUE) {
                    ?>

                    <script>
                        window.onload = function () {
                            window.location.href = "https://www.revica.org/manager-order/?orderID=<?php echo $code; ?>";
                        };
                    </script>

               <?php } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        } else {
            ?>
            <script>
                window.onload = function () {
                    window.location.href = "https://www.revica.org/manager-order/";
                };
            </script>
            <?php
        }
        // Đóng kết nối
        $conn->close();
    } else {
        ?>
        <script>
            window.onload = function () {
                window.location.href = "https://www.revica.org/manager-order/";
            };
        </script>
        <?php
    }
} else {
    ?>
    <script>
        window.onload = function () {
            window.location.href = "https://www.revica.org/manager-order/";
        };
    </script>
<?php
}
