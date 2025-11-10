@component('mail::message')

Xin chào <b>{{ $user->name }}</b>,

<p>Chúng tôi hiểu rằng đôi khi bạn có thể quên mật khẩu của mình.</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Đặt lại mật khẩu của bạn
@endcomponent

<p>Nếu bạn gặp bất kỳ vấn đề nào khi khôi phục mật khẩu, vui lòng liên hệ với chúng tôi để được hỗ trợ.</p>

Cảm ơn bạn,<br>
{{ config('app.name') }}
@endcomponent
