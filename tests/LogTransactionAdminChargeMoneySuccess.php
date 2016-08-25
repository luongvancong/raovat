<?php

use Nht\Events\AdminChargeMoneySuccessEvent;

class LogTransactionAdminChargeMoneySuccess extends TestCase {

    public function setUp() {
        parent::setUp();
        $data = [
            'user_id' => 9999,
            'money' => 9999
        ];

        Event::fire(new AdminChargeMoneySuccessEvent($data));

    }

    public function testLogTransaction() {
        $data = [
            'user_id' => 9999,
            'money' => 9999
        ];

        $expect = 0;
        $actual = DB::table('transaction_histories')->where('user_id', 9999)->count();
        $this->assertNotEquals($expect, $actual);
    }
}