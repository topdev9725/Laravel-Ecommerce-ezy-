@extends('layouts.front')
@section('content')

<script src="//voguepay.com/js/voguepay.js"></script>

<script>
    closedFunction=function() {
        alert('window closed');
    }

     successFunction=function(transaction_id) {
        alert('Transaction was successful, Ref: '+transaction_id)
    }

     failedFunction=function(transaction_id) {
         alert('Transaction was not successful, Ref: '+transaction_id)
    }
</script>

 <script>
    function pay(item,price){
       //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: 'demo',
            total: price,
            cur: 'NGN',
            merchant_ref: 'ref123',
            memo:'Payment for '+item,
            developer_code: '5a61be72ab323',
            store_id:1,
           closed:closedFunction,
           success:successFunction,
           failed:failedFunction
       });
    }

 </script>

 <button type="button" onclick="pay('shirt',500)"> Pay for shirt </button>
 <button type="button" onclick="pay('shoe',10000)"> Pay for shoe </button>


@endsection