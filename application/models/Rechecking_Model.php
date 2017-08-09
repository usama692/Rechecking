<?php
class Rechecking_Model extends CI_Model 
{
    public function __construct()
    {
        $this->load->database(); 
    }


    public function checkAlreadyChallan($challanCheckArray)
    {
        //DebugBreak();

        $chNo = $challanCheckArray['challan'];
        $paidDate = $challanCheckArray['paidDate'];

        $query = $this->db->query("select count(*) total from tblRechecking_SSC_Current where IsActive = 1 AND class = ".CLS." AND sess = ".sess." AND Iyear = ".YEAR." AND  challanno = '".$chNo."' AND CONVERT(char(20), paid_date,126) =  '".$paidDate."'");    


        if(!$query)
        {
            return -1;
        }

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function LoadData_Model($data)
    { 
        //DebugBreak();

        @$cls = CLS;
        @$year = YEAR;
        @$sess = SESS;
        @$matRno = $data['matRno'];
        @$dob = $data['dob'];                                                                                    
        @$interRno = $data['interRno'];

        if(CLS == 9 || CLS == 10)                                     
        {
            $query = $this->db->query("exec OnlineOpr..spFetchRecordForRechecking $cls, $year, $sess, $matRno, '".$dob."' ");    
            if(!$query)
            {
                return -1;
            }
        }

        else if(CLS == 11 || CLS == 12)
        {
            $query = $this->db->query("exec OnlineOpr..spFetchRecordForRechecking $cls, $year, $sess, $interRno, $matRno");        
            if(!$query)
            {
                return -1;
            }
        }

        else{
            //do nothing
        }

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {

            return  false;
        }
    }

    public function InsertRecheckingForm_Model($data)
    {
        //DebugBreak();

        @$rno = $data['rno'];
        @$class = $data['class'];
        @$Iyear = $data['Iyear'];
        @$sess = $data['sess'];

        @$sub1 = $data['sub1'];
        @$sub1Rec1 = $data['sub1Rec1'];
        @$sub1Rec2 = $data['sub1Rec2'];

        @$sub2 = $data['sub2'];
        @$sub2Rec1 = $data['sub2Rec1'];
        @$sub2Rec2 = $data['sub2Rec2'];

        @$sub3 = $data['sub3'];
        @$sub3Rec1 = $data['sub3Rec1'];
        @$sub3Rec2 = $data['sub3Rec2'];

        @$sub4 = $data['sub4'];
        @$sub4Rec1 = $data['sub4Rec1'];
        @$sub4Rec2 = $data['sub4Rec2'];

        @$sub5 = $data['sub5'];
        @$sub5Rec1 = $data['sub5Rec1'];
        @$sub5Rec2 = $data['sub5Rec2'];
        @$sub5Prec2 = $data['sub5Prec2'];

        @$sub6 = $data['sub6'];
        @$sub6Rec1 = $data['sub6Rec1'];
        @$sub6Rec2 = $data['sub6Rec2'];
        @$sub6Prec2 = $data['sub6Prec2'];

        @$sub7 = $data['sub7'];
        @$sub7Rec1 = $data['sub7Rec1'];
        @$sub7Rec2 = $data['sub7Rec2'];
        @$sub7Prec2 = $data['sub7Prec2'];

        @$sub8 = $data['sub8'];
        @$sub8Rec1 = $data['sub8Rec1'];
        @$sub8Rec2 = $data['sub8Rec2'];

        @$MobNo = $data['MobNo'];
        @$Phone = $data['Phone'];
        @$addr = $data['addr'];
        @$challanno = $data['challanno'];
        @$bank_name = $data['bank_name'];
        @$paid_date = $data['paid_date'];
        @$amount = $data['amount'];

        //DebugBreak();

        $query = $this->db->query("exec OnlineOpr..sp_Rechecking_Insert $rno, $class, $Iyear, $sess, $sub1, $sub1Rec1, $sub1Rec2, $sub2, $sub2Rec1, $sub2Rec2, $sub3, $sub3Rec1, $sub3Rec2, $sub4, $sub4Rec1, $sub4Rec2, $sub5, $sub5Rec1, $sub5Rec2, $sub5Prec2, $sub6, $sub6Rec1, $sub6Rec2, $sub6Prec2, $sub7, $sub7Rec1, $sub7Rec2, $sub7Prec2, $sub8, $sub8Rec1, $sub8Rec2, '".$MobNo."', '".$Phone."', '".$addr."', $challanno, '".$bank_name."', '".$paid_date."', $amount"); 


        if(!$query)
        {
            return -1;
        }

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    function getAppMob($rno)
    {
        $query = $this->db->query("select top 1 app_id, MobNo from OnlineOpr..tblRechecking_SSC_Current where rno = $rno order by app_id desc"); 

        if(!$query)
        {
            return -1;
        }

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }


    function recheckingStatus_Model($appId)
    {
        //DebugBreak();

        @$CLS = CLS;
        @$YEAR = YEAR;
        @$SESS = SESS;

        $query = $this->db->query("exec OnlineOpr..spRecheckingStatus $CLS, $YEAR, $SESS, $appId, $appId");

        if(!$query)
        {
            return -1;
        }

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }  
}
?>