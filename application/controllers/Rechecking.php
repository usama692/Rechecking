<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rechecking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');   
        $this->clear_cache();
    }

    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    public function index()
    {
        $this->load->library('session');

        if($this->session->flashdata('error'))
        {
            $error = array('error'=>$this->session->flashdata('error'));  
        }
        else
        {
            $error = array('error'=>"");
        }

        //DebugBreak();

        if(strtotime(date("d-m-Y")) > strtotime(LASTDATE))  
        {
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php');
            $this->load->view('Rechecking/Footer.php');
        }
        else
        {
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php');
            $this->load->view('Rechecking/GetInfo.php',$error);
            $this->load->view('Rechecking/Footer.php');
        }
    }

    public function LoadData()
    {
        //DebugBreak();

        $this->load->library('session');
        $this->load->model('Rechecking_Model'); 


        @$data['challan'] = $_POST['challan'];
        @$data['bName'] = $_POST['bName'];
        @$data['paidDate'] = $_POST['paidDate'];
        @$data['amount'] = $_POST['amount'];
        @$data['matRno'] = $_POST['matRno'];

        if(CLS == 9 || CLS == 10){
            @$data['dob'] = $_POST['dob'];
        }
        else if(CLS == 11 || CLS == 12){
            @$data['interRno'] = $_POST['interRno'];    
        }

        @$bName = $data['bName'];
        @$challan = $data['challan'];
        @$paidDate = $data['paidDate'];
        @$amount =  $data['amount'];

        @$postArray = array('bName' => $bName, 'challan' => $challan, 'paidDate' => $paidDate, 'amount' => $amount);

        @$challanCheckArray['challan'] = $_POST['challan'];
        @$challanCheckArray['paidDate'] =  $_POST['paidDate'];       

        @$challanCheck = $this->Rechecking_Model->checkAlreadyChallan($challanCheckArray);


        if(@$challanCheck == -1)
        {
            $exception   = $this->db->error();
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/errorPage.php', array('exception' => $exception));
            $this->load->view('Rechecking/Footer.php');
            return;
        }

        if($challanCheck[0]['total'] != 0)
        {
            @$chalanAppId = $challanCheck[0]['app_id'];
            $error['noRecordFound'] = 'The Challan No. you entered already has been submitted by Application id <b> '.$chalanAppId.' </b>';
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php',  array('error' => $error));
            $mydata = array('data'=>$_POST);
            $this->load->view('Rechecking/GetInfo.php',  array('error' => $mydata));
            $this->load->view('Rechecking/Footer.php'); 
            return;
        }

        @$data = $this->Rechecking_Model->LoadData_Model($data);

        if(@$data == -1)
        {
            $exception   = $this->db->error();
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/errorPage.php', array('exception' => $exception));
            $this->load->view('Rechecking/Footer.php');
            return;
        } 
        if(!$data)
        {
            $error['noRecordFound'] = 'Record Not Found Against Your Criteria';
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php',  array('error' => $error));
            $mydata = array('data'=>$_POST);
            $this->load->view('Rechecking/GetInfo.php',  array('error' => $mydata));
            $this->load->view('Rechecking/Footer.php'); 
            return;
        }

        else if($data[0]['status'] == 4)
        {
            $error['noRecordFound'] = 'You was Absent. You are not Eligible to Apply for Rechecking';
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php',  array('error' => $error));
            $mydata = array('data'=>$_POST);
            $this->load->view('Rechecking/GetInfo.php',  array('error' => $mydata));
            $this->load->view('Rechecking/Footer.php');  
            return;
        }

        else
        {  
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/recheckingForm.php',array('data'=>$data, 'postArray' => $postArray));
            $this->load->view('Rechecking/Footer.php');
        }  
    }

    public function InsertRecheckingForm()
    {
        //DebugBreak();

        if(strtotime(date("d-m-Y")) > strtotime(LASTDATE)) 
        {
            redirect('Rechecking/index');
        }

        $this->load->library('session');
        $this->load->model('Rechecking_Model'); 

        @$challan = @$this->input->post('challan');
        @$bankName = @$this->input->post('bName');
        @$paidDate = @$this->input->post('paidDate');
        @$amount = @$this->input->post('amount');

        @$grp_cd = @$_POST['grp_cd']; 
        @$rno = @$_POST['rno'];
        @$class = @$_POST['clas'];
        @$Iyear = @$_POST['Iyear']; 
        @$sess = @$_POST['sess']; 
        @$MobNo = @$_POST['cellNo']; 
        @$Phone = @$_POST['phone']; 
        @$addr = @$_POST['addr']; 

        @$sub1p1 = @$_POST['p1sub1'];
        @$sub2p1 = @$_POST['p1sub2']; 
        @$sub3p1 = @$_POST['p1sub3'];
        @$sub4p1 = @$_POST['p1sub4'];
        @$sub5p1 = @$_POST['p1sub5']; 
        @$sub6p1 = @$_POST['p1sub6'];
        @$sub7p1 = @$_POST['p1sub7'];
        @$sub8p1 = @$_POST['p1sub8'];

        @$sub1p2 = @$_POST['p2sub1'];
        @$sub2p2 = @$_POST['p2sub2'];
        @$sub3p2 = @$_POST['p2sub3'];
        @$sub4p2 = @$_POST['p2sub4']; 
        @$sub5p2 = @$_POST['p2sub5'];
        @$sub6p2 = @$_POST['p2sub6'];
        @$sub7p2 = @$_POST['p2sub7'];
        @$sub8p2 = @$_POST['p2sub8'];


        @$sub4Pr = @$_POST['sub4sp2'];
        @$sub5Pr = @$_POST['sub5sp2'];
        @$sub6Pr = @$_POST['sub6sp2'];
        @$sub7Pr = @$_POST['sub7sp2'];

        @$sub1 = 0;@$sub2 = 0;@$sub3 = 0;@$sub4 = 0;@$sub5 = 0;@$sub6 = 0;@$sub7 = 0;@$sub8 = 0;


        if($sub1p1 != '')
        {
            $sub1 =$sub1p1 ;
        }
        if( $sub1p2 != '')
        {
            $sub1 =$sub1p2 ;
        }

        if($sub2p1 != '')
        {
            $sub2 =$sub2p1 ;
        }
        if($sub2p2 != '')
        {
            $sub2 =$sub2p2 ;
        }

        if($sub3p1 != '')
        {
            $sub3 =$sub3p1 ;
        }
        if( $sub3p2 != '')
        {
            $sub3 =$sub3p2 ;
        }

        if($sub4p1 != '')
        {
            $sub4 =$sub4p1 ;
        }
        if( $sub4p2 != '')
        {
            $sub4 =$sub4p2 ;
        }

        if($sub5p1 != '')
        {
            $sub5 =$sub5p1 ;
        }
        if( $sub5p2 != '')
        {
            $sub5 =$sub5p2 ;
        }

        if($sub6p1 != '')
        {
            $sub6 =$sub6p1 ;
        }
        else if( $sub6p2 != '')
        {
            $sub6 =$sub6p2 ;
        }

        if($sub7p1 != '')
        {
            $sub7 =$sub7p1 ;
        }
        if( $sub7p2 != '')
        {
            $sub7 =$sub7p2 ;
        }

        if($sub8p1 != '')
        {
            $sub8 =$sub8p1 ;
        }
        if( $sub8p2 != '')
        {
            $sub8 =$sub8p2 ;
        }


        if(@$sub1p1 != ''){@$sub1rec1 = 1; } else { @$sub1rec1 = 0;}
        if(@$sub2p1 != ''){@$sub2rec1 = 1; } else { @$sub2rec1 = 0;}
        if(@$sub3p1 != ''){@$sub3rec1 = 1; } else { @$sub3rec1 = 0;}
        if(@$sub4p1 != ''){@$sub4rec1 = 1; } else { @$sub4rec1 = 0;}
        if(@$sub5p1 != ''){@$sub5rec1 = 1; } else { @$sub5rec1 = 0;}
        if(@$sub6p1 != ''){@$sub6rec1 = 1; } else { @$sub6rec1 = 0;}
        if(@$sub7p1 != ''){@$sub7rec1 = 1; } else { @$sub7rec1 = 0;}
        if(@$sub8p1 != ''){@$sub8rec1 = 1; } else { @$sub8rec1 = 0;}

        if(@$sub1p2 != ''){@$sub1rec2 = 1; } else { @$sub1rec2 = 0;}
        if(@$sub2p2 != ''){@$sub2rec2 = 1; } else { @$sub2rec2 = 0;}
        if(@$sub3p2 != ''){@$sub3rec2 = 1; } else { @$sub3rec2 = 0;}
        if(@$sub4p2 != ''){@$sub4rec2 = 1; } else { @$sub4rec2 = 0;}
        if(@$sub5p2 != ''){@$sub5rec2 = 1; } else { @$sub5rec2 = 0;}
        if(@$sub6p2 != ''){@$sub6rec2 = 1; } else { @$sub6rec2 = 0;}
        if(@$sub7p2 != ''){@$sub7rec2 = 1; } else { @$sub7rec2 = 0;}
        if(@$sub8p2 != ''){@$sub8rec2 = 1; } else { @$sub8rec2 = 0;}


        if(@$sub4Pr != ''){@$sub4rec2Pr = 1; } else { @$sub4rec2Pr = 0;}
        if(@$sub5Pr != ''){@$sub5rec2Pr = 1; } else { @$sub5rec2Pr = 0;}
        if(@$sub6Pr != ''){@$sub6rec2Pr = 1; } else { @$sub6rec2Pr = 0;}
        if(@$sub7Pr != ''){@$sub7rec2Pr = 1; } else { @$sub7rec2Pr = 0;}    

        @$data = array
        (
            'rno' =>  $rno,
            'class' => $class,
            'Iyear' => $Iyear,
            'sess' => $sess,

            'sub1' => $sub1,
            'sub1Rec1' => $sub1rec1,
            'sub1Rec2' => $sub1rec2,

            'sub2' => $sub2,
            'sub2Rec1' => $sub2rec1,
            'sub2Rec2' => $sub2rec2,

            'sub3' => $sub3,
            'sub3Rec1' => $sub3rec1,
            'sub3Rec2' => $sub3rec2,

            'sub4' => $sub4,
            'sub4Rec1' => $sub4rec1,
            'sub4Rec2' => $sub4rec2,
            'sub4Prec2' => $sub4rec2Pr,

            'sub5' => $sub5,
            'sub5Rec1' => $sub5rec1,
            'sub5Rec2' => $sub5rec2,
            'sub5Prec2' => $sub5rec2Pr,


            'sub6' => $sub6,
            'sub6Rec1' => $sub6rec1,
            'sub6Rec2' => $sub6rec2,
            'sub6Prec2' => $sub6rec2Pr,

            'sub7' => $sub7,
            'sub7Rec1' => $sub7rec1,
            'sub7Rec2' => $sub7rec2,
            'sub7Prec2' => $sub7rec2Pr,

            'sub8' => $sub8,
            'sub8Rec1' => $sub8rec1,
            'sub8Rec2' => $sub8rec2,

            'MobNo' => $MobNo,
            'Phone' => $Phone,
            'addr' => $addr,

            'challanno' => $challan,
            'bank_name' => $bankName,
            'paid_date' => $paidDate,
            'amount' => $amount,

        );

        $val = $this->Rechecking_Model->InsertRecheckingForm_Model($data);

        if($val == -1)
        {
            $exception   = $this->db->error();
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/errorPage.php', array('exception' => $exception));
            $this->load->view('Rechecking/Footer.php');
            return;
        }

        $info =  '';

        if($val != false)
        {
            $info['error'] = 1;
            $info['AppID'] = $val[0]['app_id'];
            $info['stClass'] = $val[0]['class'];
        }
        else if($val == false)
        {
            $info['error'] = 'error';
            $info['AppID'] = '';
            $info['stClass'] = '';
        }

        if($info['error'] == 1)
        {
            $mobApp = $this->Rechecking_Model->getAppMob($val[0]['rno']);

            if($mobApp == -1)
            {
                $exception   = $this->db->error();
                $this->load->view('Rechecking/Header.php');
                $this->load->view('Rechecking/errorPage.php', array('exception' => $exception));
                $this->load->view('Rechecking/Footer.php');
                return;
            }


            @$id = $mobApp[0]['app_id'] ;
            @$MobNo = $mobApp[0]['MobNo']; 

            @$candidateSmsString = 'Dear, '.$val[0]['name']. urldecode("%0A"). 'Your Application for rechecking has been submitted successfully.' .urldecode("%0A").'Application ID: '. $id. urldecode("%0A"). 'Please visit board website for further detail.';

            if($MobNo[0]  == "0" && $MobNo[1]  == "3")
            {
                $MobNo = '92' . substr($MobNo, 1);
                $MobNo = str_replace('-','',$MobNo);
                $this->sendSms($MobNo, $candidateSmsString);
            }
        }
        echo  json_encode($info);
    }

    function sendSms($number, $message_body)
    {   
        //DebugBreak();

        $api_params = 'id=03359664990&message='.urlencode(trim($message_body)).'&shortcode=BISEGRW&lang=English&mobilenum='.$number.'&password=ptml@123456';
        $smsGatewayUrl = "http://bsms.ufone.com/bsms_app5/sendapi-0.3.jsp?";  
        $smsgatewaydata = $smsGatewayUrl.$api_params;
        $url = $smsgatewaydata;
        $chk =  file_get_contents($url);
    }

    function recheckingStatus()
    {
        DebugBreak();

        $this->load->library('session');
        $this->load->model('Rechecking_Model'); 

        @$appId = $_POST['appId'];
        @$stClass = $_POST['stClass'];

        if($appId == '')
        {
            @$appId = $this->uri->segment(3);
        }
        if($stClass == '')
        {
            @$stClass = $this->uri->segment(4);
        }

        $val = $this->Rechecking_Model->recheckingStatus_Model($appId, $stClass);


        if($val == -1)
        {
            $exception   = $this->db->error();
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/errorPage.php', array('exception' => $exception));
            $this->load->view('Rechecking/Footer.php');
            return;
        }

        //DebugBreak();

        if(!$val)
        {
            $error['noRecordFound'] = 'Record Not Found Against Your Criteria';
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php',  array('error' => $error));
            if(strtotime(date('Y-m-d'))< strtotime(LASTDATE))
            {
                $this->load->view('Rechecking/getInfo.php');    
            }
            $this->load->view('Rechecking/Footer.php'); 
            return;
        }

        else
        {
            $this->load->view('Rechecking/Header.php');
            $this->load->view('Rechecking/downloadApplicationFormByAppId.php', array('data'=>$val));
            $this->load->view('Rechecking/Footer.php');   
        }
    }

    public function validateForm()
    {
        $msg['excep'] = '';

        if(@$_POST['challan'] == '' )
        {
            $msg['excep'] = 'Please Enter Challan No';
        }
        else if(@$_POST['bName'] == '' )
        {
            $msg['excep'] = 'Please Enter Bank Name';
        }

        else if(@$_POST['paidDate'] == '' )
        {
            $msg['excep'] = 'Please Enter Bank Name';
        }

        else if(@$_POST['amount'] == '' )
        {
            $msg['excep'] = 'Please Enter Amount';
        }

        else if(@$_POST['matRno'] == '' )
        {
            $msg['excep'] = 'Please Enter Roll No';
        }

        else if((@$_POST['dob'] == '') && (@$_POST['class'] == 9 || @$_POST['class'] == 10))
        {
            $msg['excep'] = 'Please Enter Date of Birth';
        }

        else if((@$_POST['interRno'] == '') && (@$_POST['class'] == 11 || @$_POST['class'] == 12))
        {
            $msg['excep'] = 'Please Enter Inter Roll No';
        }

        if($msg['excep'] == '')
        {
            $msg['excep'] =  'Success';
        }

        echo json_encode($msg);
    }

    public function checks()
    {
        //DebugBreak();

        @$countCheckedP1Sub = 0;
        @$countCheckedP2Sub = 0;
        @$countCheckedPrSub = 0;

        for(@$k = 0; $k < 9; $k++)
        {
            if(@$_POST['p1sub'.$k] != '')
            {
                $countCheckedP1Sub ++;
            }
        }

        for(@$k = 0; $k < 9; $k++)
        {
            if(@$_POST['p2sub'.$k] != '')
            {
                $countCheckedP2Sub ++;
            }
        }

        for(@$k = 5; $k < 8; $k++)
        {
            if(@$_POST['sub'.$k.'sp2'] != '')
            {
                $countCheckedP2Sub ++;
            }
        }
        @$checkedSubcount = $countCheckedP1Sub + $countCheckedP2Sub + $countCheckedPrSub;
        $checkedSubcount = $checkedSubcount*1000 + 100;

        @$msg['excep'] = '';

        if(@$_POST['cellNo'] == '' )
        {
            $msg['excep'] = 'Please Enter Cell No';
        }

        else if(@$_POST['cellNo'][0] != '0' ||  @$_POST['cellNo'][1] != '3')
        {
            $msg['excep'] = 'Please Enter VALID Cell No';
        }

        else if(@$_POST['addr'] == '' )
        {
            $msg['excep'] = 'Please Enter Address';
        }        

        else if( 
            empty($_POST['p1sub1']) && empty($_POST['p1sub2']) && empty($_POST['p1sub3']) && empty($_POST['p1sub4']) && empty($_POST['p1sub5']) && empty($_POST['p1sub6']) && empty($_POST['p1sub7']) && empty($_POST['p1sub8']) && 
            empty($_POST['p2sub1']) && empty($_POST['p2sub2']) && empty($_POST['p2sub3']) && empty($_POST['p2sub4']) && empty($_POST['p2sub5']) && empty($_POST['p2sub6']) && empty($_POST['p2sub7']) && empty($_POST['p2sub8']) && empty($_POST['sub4sp2']) &&
            empty($_POST['sub5sp2']) && empty($_POST['sub6sp2']) && empty($_POST['sub7sp2'])
            )
            {
                $msg['excep'] = 'Please check atleast one subject to submit rechecking';
            }

            else if($checkedSubcount > $_POST['amount'])
            {
                $msg['excep'] = 'Your Deposited Fee is not enough. You deposit Rs '. $_POST['amount'];
            }

            else if(@$_POST['terms'] != 'yes' )
            {
                $msg['excep'] = 'Please Accept the Terms and Condition for Further Process';
            }

            if($msg['excep'] == '')
        {
            $msg['excep'] =  'Success';
        }        

        echo json_encode($msg);
    }
}