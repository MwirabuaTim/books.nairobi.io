<?php 

class Oauth2Controller extends BaseController
{

    // namespace OAuth2\OAuth2;
    // namespace OAuth2\Token_Access;
    // namespace OAuth2\Exception as OAuth2_Exception;

    public function getIndex($provider) {


        $provider = OAuth2::provider($provider, array(
        'id' => '182024725307187',
        'secret' => '7812599b4ecfde73c953bfb051094e9c',
        ));

        if(! isset($_GET['code'])) {

            return $provider->authorize();

        }

        else
        {
            // Howzit?
            try
            {
                $params = $provider->access($_GET['code']);

                    $token = new Token_Access(array(
                        'access_token' => $params->access_token
                    ));
                    $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>";
                var_dump($user);
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }
        }

    }
    public function email()
    {


        Mail::send('emails.auth.mail', array('token'=>'SAMPLE'), function($message){
            $message = Swift_Message::newInstance();
            $email = $_POST['email']; $name = $_POST['name'];
            $message->setFrom(array($email => $name));
            $message->setTo(array('leeibrah@gmail.com' => 'Lee Kassim'));   
            
            $subject = $_POST['subject'];   
            $message->setSubject($subject); 

            $msg = $_POST['msg'];   
            $message->setBody($msg);

            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')->setUsername('nightoutkenya')->setPassword('desparado');
            // $transport = Swift_SmtpTransport::newInstance('localhost', 25);
            //Supposed to allow local domain sending to work from what I read
            $transport->setLocalDomain('[127.0.0.1]');

            $mailer = Swift_Mailer::newInstance($transport);
            //Send the message
                $result = $mailer->send($message);
            if($result){
                
                 return Redirect::to('contactus')->with('success', 'You have posted successfully');
            }else{
                return Redirect::to('contactus')->with('fail', 'Your details were not submitted');
            }
        });
        return Redirect::back();
    }



}