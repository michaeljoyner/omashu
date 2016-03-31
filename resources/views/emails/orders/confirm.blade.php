<p>{{ $customer_name }} 您好</p>
<p>謝謝您在The Garlic Box所下的訂單。</p>

<p>
    當您的包裹寄出時，我們會寄送一封含有連結的電子郵件來追蹤訂單。<br>
    如果您對訂單有任何問題，請聯絡：contact@omashuimports.com 或致電：04-25222019。<br>
    您的訂單確認如下，再次謝謝您的惠顧。
</p>
<p style="font-size: 1.2em; color: #428D90;">訂單號碼#{{ $order_number }}</p>

<p><strong>寄送地址</strong></p>
<p>{{ $del_address }}</p>

<p><strong>您的訂單如下</strong></p>
@include('emails.partials.itemtable')

<p><strong>匯款資料</strong></p>
<p>
    接受銀行或郵局轉帳/匯款，我們僅提供銀行帳號<br>
    匯款收款人: 楊紫淇<br>
    匯款至:<br>
    銀行名稱 :豐原三民路郵局(代號700)<br>
    帳戶號碼 :0141043 0392231<br>
    請於三日內匯款<br>
    超過三日一律取消訂單<br>
    當您完成匯款時<br>
    請透過電子郵件 (contact@omashuimports.com)聯絡我們<br>
    通知匯款完成時請提供<br>
    1.訂單編號或收件人姓名<br>
    2.匯款帳號後五碼及金額，以便確認您的款項，也請保存您的匯款收據與訂單號碼，以便日後查詢。<br>
</p>
