<?php

require_once 'TMPAY.php';

$tmpay = new TMPAY('TEST', 'https://0x01code.me/TMPAY.Webhook.php', 'truemoney');
if ($tmpay->tmn_refill('55555555555551')) {
    echo 'ทำรายการสำเร็จ';
} else {
    echo 'เกิดข้อผิดพลาด';
}
