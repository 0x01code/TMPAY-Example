<?php

// ถ้าไม่ใช้ IP ของ TMPAY ไม่ให้เข้าหน้านี้
if ($_SERVER['REMOTE_ADDR'] != '203.146.127.112') {
    die('Access Denied');
}

/**
 * Callback ที่ TMPAY จะส่งมาให้
 * transaction_id   =>  Transaction ID ของผลการตรวจสอบ (A-Z,0-9 ความยาว 10 หลัก) เช่น XYZ1234567
 * password         =>  รหัสบัตรเงินสดทรูมันนี่ (0-9 ความยาว 14 หลัก) เช่น 01234567890123
 * real_amount      =>  จำนวนเงินที่ได้รับ เช่น 20.00, 50.00, 90.00, 150.00, 300.00, 500.00, 1000.00
 * status           =>  ผลการตรวจสอบ (1,3,4,5)
 *                      1 = การเติมเงินสำเร็จ
 *                      3 = บัตรเงินสดถูกใช้ไปแล้ว
 *                      4 = รหัสบัตรเงินสดไม่ถูกต้อง
 *                      5 = เป็นบัตรทรูมูฟ (ไม่ใช่บัตรทรูมันนี่)
 */

$transaction_id = $_GET['transaction_id'];
$password = $_GET['password'];
$amount = $_GET['real_amount'];
$status = $_GET['status'];

if ($status == 1) {
    /* Code เพิ่มเงินที่นี่ */
    /* เช่น
        $user_id_refill = $this->db->query( 'SELECT TOP 1 user_id FROM truemoney WHERE truemoney = ? ', password);
        $this->db->query( 'UPDATE point = pount + ? WHERE user_id = ? ', $amount, $user_id_refill);
    */
    die('SUCCEED|TOPPED_UP_THB_' . $amount . '_TO_' . $user_id_refill);
} else {
    /* ไม่สามารถเติมเงินได ้ */
    die('ERROR|ANY_REASONS');
}
