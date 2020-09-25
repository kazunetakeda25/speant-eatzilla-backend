<!DOCTYPE html>
<head>
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<html>
<body style="/* padding-left: 30%;padding-right: 10%;      width: 60%;margin: 0px;*/">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33%" align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:2px; color:#ffffff;">.</td>
    <td width="35%" align="center" valign="top">
      <section style="background-image: url('{{BASE_URL}}{{UPLOADS_EMAIL_PATH}}header_bg.png');padding: 20px 0px 100px 30px;background-repeat: no-repeat;background-position: right;background-size: cover;">
		<div style="width: 50%;max-width: 50%;display: inline-block;">
			<img src="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_LOGO)}}" alt="{{APP_NAME}} Logo" style="width: 170px;">
		</div>
		<div style="float: right;width: 50%;">
			<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 16px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.6px;color: #686868;text-align: center;"><span>Total: </span><span>{{DEFAULT_CURRENCY_SYMBOL}} {{$data->bill_amount}}</span></p>
			<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 16px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.6px;color: #686868;text-align: center;">{{date('D, M d, Y',strtotime($data->ordered_time))}}</p>

		</div>
		<h2>
			<span style="font-family: 'Maven Pro', sans-serif;font-size: 30px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.4;letter-spacing: 0.6px;text-align: left;color: #353535;">Thanks for Ordering</span><br><span style="font-size: 35px;font-weight: bold;letter-spacing: 0.7px;">@if(!empty($data->Users)) {{$data->Users->name}} @else Guest User @endif
			</span>
		</h2>
		<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.8px;text-align: left;color: #686868;">Here's your receipt for<br>@if(!empty($data->Restaurants)){{$data->Restaurants->restaurant_name}} @endif - @if(!empty($data->Restaurants->Area)){{$data->Restaurants->Area->area}} @endif</p>
		
	</section>
	<table style="width: 100%;padding-top: 30px;">
		<tr style="width: 88px;height: 35px;font-family: 'Maven Pro', sans-serif;font-size: 35px;font-weight: bold;font-style: normal;font-stretch: normal;line-height: 1.26;letter-spacing: 0.7px;text-align: left;color: #353535;">
			<td style="padding-left: 40px;">Total</td>
			<td style="float: right;padding-right: 100px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->bill_amount}}</td>
		</tr>
	</table>
	<div style="border: 1px solid #79636370;width: 690px;margin-left: 35px;margin-top: 20px;"></div>
	<table style="width: 100%;padding-top: 30px;padding-left: 30px;">
		<tbody>
			@php $i=1; @endphp
			@foreach($data->Requestdetail as $value)
			<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.7;letter-spacing: 0.8px;text-align: left;color: #686868;">
				<td style="padding-left: 15px;">{{$i}}</td>
				<td>@if(!empty($value->Foodlist)) {{$value->Foodlist->name}} @else - @endif</td>
				<td>@if(!empty($value->Foodlist)) {{DEFAULT_CURRENCY_SYMBOL}} {{$value->Foodlist->price}} @else - @endif</td>
			</tr>
			@php $i=$i+1; @endphp
			@endforeach
		</tbody>
	</table>
	<div style="border: 1px solid #79636370;width: 690px;margin-left: 35px;margin-top: 20px;"></div>
	<table style="width: 100%;padding-top: 30px;padding-left: 30px;">
		<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.7;letter-spacing: 0.8px;text-align: left;color: #686868;">
			<td style="padding-left: 15px;">Subtotal</td>
			<td style="float: right;padding-right: 60px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->item_total}}</td>
		</tr>
		<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.7;letter-spacing: 0.8px;text-align: left;color: #686868;">
			<td style="padding-left: 15px;">Tax</td>
			<td style="float: right;padding-right: 60px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->tax}}</td>
		</tr>
		<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.7;letter-spacing: 0.8px;text-align: left;color: #686868;">
			<td style="padding-left: 15px;">Delivery Fee</td>
			<td style="float: right;padding-right: 60px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->delivery_charge}}</td>
		</tr>
		<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.7;letter-spacing: 0.8px;text-align: left;color: #686868;">
			<td style="padding-left: 15px;">Discount</td>
			<td style="float: right;padding-right: 60px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->offer_discount+$data->restaurant_discount}}</td>
		</tr>
		<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.7;letter-spacing: 0.8px;text-align: left;color: #686868;">
			<td style="padding-left: 15px;">Package Charge</td>
			<td style="float: right;padding-right: 60px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->restaurant_packaging_charge}}</td>
		</tr>
	</table>
	<div style="border: 1px solid #79636370;width: 690px;margin-left: 35px;margin-top: 20px;"></div>
	<table style="width: 100%;padding-top: 30px;padding-left: 30px;">
		<tr style="font-family: 'Source Sans Pro', sans-serif;font-size: 20px;font-weight: 700;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.8px;text-align: left;color: #686868;">
			<td style="padding-left: 15px;">Paid in cash</td>
			<td style="float: right;padding-right: 100px;">{{DEFAULT_CURRENCY_SYMBOL}} {{$data->bill_amount}}</td>
		</tr>
	</table>
	<section style="background-color: #f7f7f7;">
		
		<table style="width: 100%;padding-top: 30px;padding-left: 30px;">
			<tr>
				<td style="padding-left: 15px;">
					<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 17px;font-weight: 600;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.3px;text-align: left;color: #686868;">Pickup Location</p>
				</td>
				<td style="padding-left: 15px;">
					<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 17px;font-weight: 600;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.3px;text-align: left;color: #686868;">Delivery Location</p>
				</td>
			</tr>
			<tr>
				<td style="padding-left: 15px;">
					<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 17px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.7px;text-align: left;">
						<span style="font-weight: 600;color: #2a8c37;">@if(!empty($data->Restaurants)) {{$data->Restaurants->restaurant_name}}</span><br>
						{{$data->Restaurants->address}} @endif
					</p>
				</td>
				<td>
					<p style="font-family: 'Source Sans Pro', sans-serif;font-size: 17px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.7px;text-align: left;">
						<span style="font-weight: 600;color: #2a8c37;">@if(!empty($data->Users)) {{$data->Users->name}} @endif</span><br>
						{{$data->delivery_address}}
					</p>
				</td>
			</tr>
		</table>
		<div style="border: 1px solid #79636370;width: 690px;margin-left: 35px;margin-top: 20px;"></div>
		<!-- <table style="width: 100%;padding-top: 30px;padding-left: 30px;">
			<tr>
				<td style="width: 80px;padding-left: 15px;">
					<img src="{{BASE_URL}}{{DRIVER_IMAGE_PATH}}" alt="Customer" style="width: 55.1px;border-radius: 50%;">
				</td>
				<td>
					<p style=" font-family: 'Source Sans Pro', sans-serif;font-size: 17px;font-weight: 600;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.7px;text-align: left;color: #686868;">Delivered by <span style="color: #2a8c37;">Manik Badsha</span></p>
				</td>
			</tr>
		</table> -->
	</section>
	    <!-- filter: invert(100%); -->
	<section style="background-color: #000000;padding-bottom: 30px;">
		<table style="width: 100%;padding-top: 30px;padding-left: 30px;">
			<tr>
				<td>
					<img src="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_LOGO)}}" alt="{{APP_NAME}} Logo" style="width: 170px;filter: invert(100%);">
				</td>
				<td>
					<span style="background-color: white;border-radius: 50%;padding: 16px 3px 6px 6px;">
						<img src="{{BASE_URL}}{{UPLOADS_EMAIL_PATH}}instagram.png" alt="Instagram" style="width: 28px;">
					</span>
					<span style=" background-color: white; border-radius: 50%; padding: 16px 3px 6px 6px; margin-left: 8px;">
						<img src="{{BASE_URL}}{{UPLOADS_EMAIL_PATH}}linkedin.png" alt="Linkedin" style="width: 28px;">
					</span>
					<span style=" background-color: white; border-radius: 50%; padding: 19px 3px 6px 6px; margin-left: 8px;">
						<img src="{{BASE_URL}}{{UPLOADS_EMAIL_PATH}}facebook.png" alt="Facebook" style="width: 28px;">
					</span>
					<span style=" background-color: white; border-radius: 50%; padding: 16px 6px 6px 6px; margin-left: 8px;">
						<img src="{{BASE_URL}}{{UPLOADS_EMAIL_PATH}}youtube.png" alt="Youtube" style="width: 28px;">
					</span>
				</td>
			</tr>
		</table>
		<div style="border: 1px solid #79636370;width: 690px;margin-left: 35px;margin-top: 20px;"></div>
		<table style="width: 100%;padding-top: 30px;padding-left: 30px;">
			<tr>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.77;letter-spacing: 0.6px;text-align: left;color: #ffffff;">FAQ</td>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.6px;text-align: left;color: #b2b2b2;">{{APP_NAME}}</td>
			</tr>
			<tr>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.77;letter-spacing: 0.6px;text-align: left;color: #ffffff;">Forgot Password</td>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.6px;text-align: left;color: #b2b2b2;">980 Post Oak Blvd,</td>
			</tr>
			<tr>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.77;letter-spacing: 0.6px;text-align: left;color: #ffffff;">Privacy</td>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.2;letter-spacing: 0.6px;text-align: left;color: #b2b2b2;">Houston, Texas, 77056.</td>
			</tr>
			<tr>
				<td style="font-family: 'Source Sans Pro', sans-serif;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.77;letter-spacing: 0.6px;text-align: left;color: #ffffff;">Terms</td>
				<td></td>
			</tr>
		</table>
	</section>
    </td>
    <td width="33%" align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:2px; color:#ffffff;">.</td>
  </tr>
</table>

</body>
</html>