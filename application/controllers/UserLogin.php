<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
class UserLogin extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        //$this->load->library('encrypt');


    }
    public function index(){}

    public function userlogin() {
        if(isset($_POST['login']))
        {
            $this->unsetflashdatainfo();
            $this->load->helper(array('form', 'url'));

            $username = $this->input->post('username');
            $password= $this->input->post('password');
            //$password= md5($password);

            $passwordencrypted= md5($password);
            //  $passwordencrypteddd= $this->encrypt->decode($passwordencrypted);

            $res = $this->DbHandler->getStationIdAndRegion($username,  $passwordencrypted);

            //check in DB
            $result = $this->DbHandler->getUserLogInDetails($username, $passwordencrypted,$res,0);
            //True that user details
            if ($result) {


                foreach($result as $row){
                    $activeStatus = $row->Active;
                }

                if($activeStatus == 1){
                    $usersessiondata = array();


                //Create a user session
                foreach ($result as $row) {
                    $stationregion1 = $row->StationRegion;
                    $stationregion2 = $row->region_zone;
					
                    if($stationregion1 !=''){
                        $region = $stationregion1;
                    }elseif($stationregion2 !=''){
                        $region = $stationregion2;
                    }
                    $usersessiondata = array(
                        'Userid' => $row->Userid,
                        'FirstName' => $row->FirstName,
                        'SurName' => $row->SurName,
                        'UserName' => $row->UserName,
                        'UserEmail' => $row->UserEmail,
                        'UserStation' => $row->StationName,
                        'StationNumber' => $row->StationNumber,
                        'StationId' => $row->station_id,
                        'UserRole' => $row->UserRole,
                        'Reset' => $row->Reset,
                        'UserRegion' => $region

                    );
                }//end of foreach

                //Set the Session value
                // Add user data in session
                $this->session->set_userdata('logged_in', $usersessiondata);
                $session_data = $this->session->userdata('logged_in');
                $userrole=$session_data['UserRole'];
                //$this->session->set_userdata($usersessiondata);

                //if Reset value is 1
                if($session_data['Reset']==1){

                    $this->session->set_flashdata('success', 'Need to change your system password');
                    $this->load->view('resetPassword');



                }
                else{

                    //Display the nxt page.
                   // $test="hELLO";
                   // $guy =firstcharuppercase(chgtolowercase($test));
                    //$fname=firstcharuppercase($firstname);
                    $getdays=daysInAMonth('02','2017');
                    $name=$session_data['FirstName'] .' '. $session_data['SurName'];
                    $StationRegion=$session_data['StationRegion'];
                    $surname=$session_data['SurName'];
                    $this->session->set_flashdata('success', 'Hi '. $surname. $StationRegion.' you have logged in successfully!');

                    //Store User logs.
                    //Create user Logs
                    $userloginlogs = array('Userid' => $session_data['Userid'],
                         'Action' => 'Logged in',
                        'Details' => $name . ' logged into the system ',
                         'IP' => $this->input->ip_address());
                    $this->DbHandler->saveUserLogs($userloginlogs);

                    //Load the next page
                    if($userrole== "OC" || $userrole== "Observer" || $userrole=="ObserverDataEntrant")
                    redirect(base_url()."index.php/ObservationSlipForm/showWebmobiledata");
                    elseif($userrole=="WeatherForecaster")
                    redirect(base_url()."index.php/ObservationSlipForm/showWebmobiledata");
                    elseif($userrole=="ManagerStationNetworks")
                    redirect(base_url()."index.php/Stations");
                    elseif($userrole=="SeniorDataOfficer" || $userrole=="DataOfficer")
                    redirect(base_url()."index.php/DisplayArchivedObservationSlipFormData");
                    elseif($userrole=="ZonalOfficer" || $userrole=="SeniorZonalOfficer" || $userrole=="WeatherAnalyst")
                    redirect(base_url()."index.php/MetarReport");
                    elseif($userrole=="Manager" || $userrole=="ManagerData" )
                    redirect(base_url()."index.php/Users");
                    else
                    $this->load->view('dashboard');

                }  //end of else
                }//end of active status if//
                else{
                    $this->session->set_flashdata('error', 'Sorry, this Account has been DEACTIVATED.');
                    redirect('/Welcome');
                }

            } //end of if statement if there are results in the database
            //No User Details in the DB
            else {
                $this->session->set_flashdata('error', 'UserName or Password is wrong, please try again.');
                redirect('/Welcome');
            }
        }
    }




    public function logout() {
        //Destroy the user session.
        // Removing session data
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
		if($userrole=='ZonalOfficer'|| $userrole=='SeniorZonalOfficer'||$userrole=='DataOfficer'||$userrole=='SeniorDataOfficer'
		||$userrole=='ManagerData'||$userrole=='ManagerStationNetworks'){
			 $userstationId=0;
		}else{
        $userstationId=$session_data['StationId'];
		}
        $name=$session_data['FirstName'].' '.$session_data['SurName'];
        $id=$session_data['Userid'];
		
        
        $userlogoutlogs = array('Userid' => $id,'Action' => 'Signed Out',
                                  'Details' => $name . ' signed out of the system ',
                                     'IP' => $this->input->ip_address());
        //  save user logs
        if($userrole!=NULL || $userrole!="")
        $this->DbHandler->saveUserLogs($userlogoutlogs);
        //Destroy the Session.
        $this->session->unset_userdata('logged_in');
        //session_destroy();



        $this->session->set_flashdata('success', 'You have successfully logged out');
        $this->load->view('login');
    }
    public function userforgotpasswdview(){
        $this->unsetflashdatainfo();

        $this->load->view('forgotPassword');
    }
    public function userforgotpassword(){
        if(isset($_POST['reset_button']))
        {
            $this->unsetflashdatainfo();
            $this->load->helper(array('form', 'url'));


            $username = $this->input->post('username');
            $email= $this->input->post('email');
            //$email='antheamarthy@gmail.com';

            //Check in the Database if this user real exists
            $result = $this->DbHandler->checkUserDetails($username, $email);

            if ($result) {
                $userdetailsdata=array();
                foreach ($result as $res) {
                    $userdetailsdata=array(
                        'Userid' => $res->Userid,
                        'FirstName' => $res->FirstName,
                        'SurName' => $res->SurName,
                        'UserName' => $res->UserName,
                        'UserEmail' => $res->UserEmail,
                        'UserStation' => $res->UserStation,
                        'UserRole' => $res->UserRole,
                        'UserPhone' => $res->UserPhone,
                    );
                }
                //Generate a random  alpha-numeric password.
                $randompassword = $this->generatePasswdString();
                if($randompassword){
                    //Encrypt the random password generated.
                    $htmlmessage = 'Hello'.' '.$userdetailsdata['FirstName']
                        .' '.$userdetailsdata['SurName']
                        .'<br></br><br></br>'.
                        'Your WIMEA-ICT Web Interface  password has been reset.'.''.'<br></br><br></br>'.
                        'Your New Credentials are'.'<br></br><br></br>'.
                        'UserName:'.' '.$userdetailsdata['UserName'].'<br></br><br></br>'.
                        'Password:'.' '.$randompassword.'<br></br><br></br>'.
                        'Thank You'.'<br></br><b></br><b></br>'.'WIMEA-ICT.';

                    //$htmlmessage='Hello';

                    //If true an Email has been sent Update the DB with the password that has been sent.
                    $successfullysent=$this->sendMail($htmlmessage,$email);
                    if($successfullysent){

                        //Encrpty the password before inserting into the DB
                        $encryptedpassword=md5($randompassword);

                        //Save the New Password
                        $datatoupdate=array(
                            // 'FirstName' => $userdetailsdata[FirstName],
                            // 'Surname' => $userdetailsdata[SurName],
                            // 'Username' => $userdetailsdata[UserName],
                            // 'UserEmail' => $userdetailsdata[UserEmail],
                            // 'UserStation' => $userdetailsdata[UserStation],
                            // 'UserRole' => $userdetailsdata[UserRole],
                            // 'UserPhone' => $userdetailsdata[UserPhone],
                            'UserPassword' => $encryptedpassword,
                            'LastPasswdChange'=> date('Y-m-d H:i:s'),
                            'LastLoggedIn'=>date('Y-m-d H:i:s'),
                            'Reset'=>1
                        );

                        $userid=$userdetailsdata['Userid'];
                        // $userEmail = $userdetailsdata['UserEmail'];


                        //Reset the user's password.
                        $updatesuccess = $this->DbHandler->ResetUserPassword($datatoupdate,$userid,$email,$username);
                        if($updatesuccess){


                            $this->session->set_flashdata('success', 'An Email With your Password has been sent to you');
                            $this->load->view('login');

                        }else{
                            $this->session->set_flashdata('error', 'Password hasnt been reset but Email has been sent to you');
                            $this->load->view('forgotPassword');

                        }

                    } //end of if for sending email successfully
                    else{
                        $this->session->set_flashdata('error', 'Failed to Send Email');
                        $this->load->view('forgotPassword');

                    }


                }else{
                    $this->session->set_flashdata('error', 'Random Password not generated');
                    $this->load->view('forgotPassword');

                }


            } //User details entered to reset passwd are incorrect
            else{
                $this->session->set_flashdata('error', 'Invalid Username or Email pliz try again!');
                $this->load->view('forgotPassword');
            }


        }
    }
    public function userforgotpasswordtesting(){
        if(isset($_POST['reset']))
        {

            $htmlmessage='Hello';
            $email="antheamarthy@gmail.com";

            //If true an Email has been sent Else
            $this->sendMail($htmlmessage,$email);

        }
    }

    public function generatePasswdString(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('string'));

        return random_string('alnum', 8);
    }
    public function  sendMail($htmlmsgbody,$msgreceiver)
    {
        $this->unsetflashdatainfo();
        $this->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'wimeaictwdr@gmail.com';  //change it
        $config['smtp_pass'] = '1c7wimearepo.'; //change it
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';


        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->email->from('antheamarthy@gmail.com','WIMEA-ICT');   //change it
        $this->email->to($msgreceiver);       //change it
        $this->email->subject("WIMEA-ICT Web Interface Credentials");
        $this->email->message($htmlmsgbody);

        if($this->email->send()) {
            return true;
        } else {
            return false;
       }
       // if ($this->email->send()) {
           //return  'success';
        //    $data['success'] = 1;
           // return true;
       // } else {
        //   $data['success'] = 0;
         //   $data['error']= $this->email->print_debugger(array('headers'));
            //return false;
    //}
     //   echo "<pre>";
     //   print_r($data);
     //  echo "</pre>";

    }
    public function systemresetpassword(){
        if(isset($_POST['resetsystempassword']))
        {
            $this->unsetflashdatainfo();
        $password1 = $this->input->post('password1');
        $confirmpassword2= $this->input->post('confirmpassword1');
         $userid=$this->input->post('userid');


        if($password1!=$confirmpassword2){
            $this->session->set_flashdata('error', 'Your Password does not match.');
            $this->load->view('resetPassword');

        }
        elseif(($password1==$confirmpassword2)){
             //Encrypt the  password entered.
            $encryptedpassword=md5($confirmpassword2);

            //Save the New Password
            $updatedata=array(
                'UserPassword' => $encryptedpassword,
                'LastPasswdChange'=> date('Y-m-d H:i:s'),
                'LastLoggedIn'=>date('Y-m-d H:i:s'),
                'Reset'=> 0
            );



            //Reset the user's password.
            $email="";
            $username="";
            $updatesuccess = $this->DbHandler->ResetUserPassword($updatedata,$userid,$email,$username);
            if($updatesuccess){
                $this->session->set_flashdata('success', 'Hello your Password has been changed.');
                $this->load->view('login');

            }


            else{
                $this->session->set_flashdata('error', 'We Encountered an Error.Your Password has not been reset.');
                $this->load->view('resetPassword');
            }


        }//end of elseif

        }

    }
    public function showdashboardInfo(){
        $this->load->view('dashboard');


    }

    public function unsetflashdatainfo(){

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        elseif(isset($_SESSION['success'])){
            unset($_SESSION['success']);
        }
        elseif(isset($_SESSION['warning'])){
            unset($_SESSION['warning']);
        }
        elseif(isset($_SESSION['info'])){
            unset($_SESSION['info']);
        }

    }


}
