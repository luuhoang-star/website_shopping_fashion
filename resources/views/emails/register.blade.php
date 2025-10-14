@component('mail::message')

Hi <b>{{ $user->name }}</b>
    
<p>Bạn gần như đã sẵn sàng để bắt đầu tận hưởng những lợi ích của E-Commerce.</p>

<p>Chỉ cần nhấp vào nút bên dưới để xác minh địa chỉ email của bạn.</p>
<p>
@component('mail::button', ['url' => url('activate/'.base64_encode($user->id))])
Verify
@endcomponent
</p>
<p>Điều này sẽ xác minh địa chỉ email của bạn và sau đó bạn sẽ chính thức trở thành một phần của Khu vực E-Commerce</p>
@endcomponent