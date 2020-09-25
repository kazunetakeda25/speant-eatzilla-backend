<button id='linkButton'>Open Plaid Link</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script>
var linkHandler = Plaid.create({
  env: "{{env('PLAID_ENV')}}",
  clientName: 'Stripe/Plaid Test',
  key: "{{env('PLAID_PUBLIC_KEY')}}",
  product: ["{{env('PLAID_PRODUCTS')}}"],
  selectAccount: true,
  onSuccess: function(public_token, metadata) {
    // Send the public_token and account ID to your app server.
    console.log('public_token: ' + public_token);
    console.log('account ID: ' + metadata.account_id);
    $.post('http://167.71.153.176:3030/get_access_token', {
        public_token: public_token,
      }).done(function( data ) {
      console.log( "Data Loaded: " + data );
    });
  },
  onExit: function(err, metadata) {
    // The user exited the Link flow.
    if (err != null) {
      // The user encountered a Plaid API error prior to exiting.
    }
  },
});

linkHandler.open();

// Trigger the Link UI
document.getElementById('linkButton').onclick = function() {
  linkHandler.open();
};
</script>