<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stripe Checkout</title>
</head>
<body>
<script src="https://js.stripe.com/v3"></script>
<script type="text/javascript">
    var session_id = "{{ $session_id }}";
    var stripe = Stripe("{{ $setPublicKey }}");

    stripe.redirectToCheckout({
        sessionId: session_id
    }).then(function (result) {
        if (result.error) {
            // Hiển thị lỗi nếu có vấn đề khi redirect
            alert(result.error.message);
        }
    });
</script>
</body>
</html>
