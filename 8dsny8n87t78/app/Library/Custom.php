<?php 
namespace App\Library;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class Custom {


    /**
     * upload image and move to folder
     * 
     * @param array $request, string $param
     * 
     * @return string filename with path
     */
    public static function upload_image($request,$param)
    {
        $imageName = self::random_string(32).'.'.$request->file($param)->getClientOriginalExtension();
        //$request->file($param)->move('public/uploads/', $imageName);
        $filePath = "uploads/".$imageName;
        $filetype = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putObject(array(
            'Bucket'        => env('AWS_BUCKET'),
            'Key'           => $filePath,
            'Body'          => file_get_contents($request->$param),
            'ACL'           => 'public-read',
            'Expires'       => '',
            'CacheControl'  => 'max-age'
        ));
        return $imageName;
    }


    /**
     * upload image and move to folder
     * 
     * @param array $request, string $param
     * 
     * @return string filename
     */
    public static function restaurant_upload_image($request,$param)
    {
        $imageName = self::random_string(32).'.'.$request->file($param)->getClientOriginalExtension();
        //$request->file($param)->move('public/restaurant_uploads/', $imageName);
        $filePath = "restaurant_uploads/".$imageName;
        $filetype = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putObject(array(
            'Bucket'        => env('AWS_BUCKET'),
            'Key'           => $filePath,
            'Body'          => file_get_contents($request->$param),
            'ACL'           => 'public-read',
            'Expires'       => '',
            'CacheControl'  => 'max-age'
        ));
//dd($filetype);
        return $imageName;
    }

    public static function delete_image($image_path)
    {
        \File::delete($image_path);
        return true;
    }

    public function sendEmail($subject,$html){

        $url = 'https://api.elasticemail.com/v2/email/send';


        try{
            $post = array('from' => 'mailer@mrcity.in',
                'fromName' => 'SPARKOUT',
                'apikey' => '38868678-37e6-4a31-aacf-7e8a95e5b9de',
                'subject' => $subject,
                'to' => 'tickets@mrcity.in:leads@sparkouttech.com',
                'bodyHtml' => $html,
                'bodyText' => 'Text Body',
                'isTransactional' => false);

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => false
            ));

            $result=curl_exec ($ch);
            curl_close ($ch);

            //echo $html;
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }

       public static function random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    /**
     * upload image and move to folder
     * 
     * @param array $request, string $param
     * 
     * @return string filename with path
     */
    public static function common_upload_images($request,$param,$path)
    {
        $imageName = self::random_string(32).'.'.$request->file($param)->getClientOriginalExtension();
        //$request->file($param)->move($path, $imageName);
        $filePath = $path."/".$imageName;
        $filetype = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putObject(array(
            'Bucket'        => env('AWS_BUCKET'),
            'Key'           => $filePath,
            'Body'          => file_get_contents($request->$param),
            'ACL'           => 'public-read',
            'Expires'       => '',
            'CacheControl'  => 'max-age'
        ));
        return $imageName;
    }


}