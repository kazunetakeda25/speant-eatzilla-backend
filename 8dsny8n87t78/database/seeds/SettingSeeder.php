<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert(['key_word' => 'admin_commission','value' => 1, 'status' => 1,],
        ['key_word' => 'restaurant_commission','value' => 0,'status' => 1,'type' => 1,],
        ['key_word' => 'delivery_boy_commission','value' => 0,'status' => 1,'type' => 1,],
   		['key_word' => 'stripe_sk_key','value' => 'sk_test_BlD4SrbP60Qa94PrQ1pTHYtB','status' => 1,'type' => 3,],
	    ['key_word' => 'stripe_pk_key','value' => 'pk_test_uzFnOtl3tNwStqKIi5Vflq61', 'status' => 1,'type' => 3,],
	    ['key_word' => 'app_name','value' => 'Eatzilla','status' => 1,'type' => 1,],
	    ['key_word' => 'user_notification_key','value' => 'AIzaSyD5tCcm18TB_StcOlo5rNOcponUHxzX9Gg','status' => 1,'type' => 3,],
	    ['key_word' => 'partner_notification_key','value' => 'AIzaSyD5tCcm18TB_StcOlo5rNOcponUHxzX9Gg','status' => 1,'type' => 3,],
	    ['key_word' => 'default_radius','value' => 5,'status' => 1,'type' => 1,],
	    ['key_word' => 'highlight_color', 'value' => '#23262f','status' => 1,'type' => 1,],
	    ['key_word' => 'menu_color','value' => '#2C303B','status' => 1,'type' => 1,],
	    ['key_word' => 'site_contact','value' => '','status' => 1,'type' => 1,],
	    ['key_word' => 'site_email','value' => '','status' => 1,'type' => 1,],
	    ['key_word' => 'site_favicon','value' => 'facicon.ico','status' => 1,'type' => 1,],
	    ['key_word' => 'site_logo','value' => 'eatzilla1.jpg','status' => 1,'type' => 1,],
	    ['key_word' => 'default_unit','value' => 'KM','status' => 1,'type' => 1,],
	    ['key_word' => 'email_enable','value' => '0','status' => 1,'type' => 1,],
	    ['key_word' => 'sms_enable','value' => '0','status' => 1,'type' => 1,],
	    ['key_word' => 'email_user_name','value' => '','status' => 1,'type' => 2,],
	    ['key_word' => 'email_password','value' => '','status' => 1,'type' => 2,],
	    ['key_word' => 'time_zone','value' => 'UTC','status' => 1,'type' => 1,],
	    ['key_word' => 'firebase_url','value' => 'https://joldiasho-10cd9.firebaseio.com','status' => 1,'type' => 3,],
	    ['key_word' => 'google_api_key','value' => 'AIzaSyBWIomenTvO9o1V8ZfCbQBXV_UG9iDcNsg','status' => 1,'type' => 3,],
	    ['key_word' => 'order_prefix','value' => 'EATZILLA','status' => 1,'type' => 1,]);
    }
}
