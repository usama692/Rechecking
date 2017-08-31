
<style type="text/css">

    #wrapper {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        padding: 30px 0;
    }


    #form-trabalhe {
        margin-top: 30px;
        text-align: left;
    }

    label {
        font-weight: bolder;
        margin-top: 15px;
    }

    .input-group-addon {
        border: 2px solid #CCC !important;
        border-right: 0px !important;
    }

    .btn {
        border: 0;
        border-radius: 3px;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 0;
        text-align: left;
    }

</style>

<?php
//DebugBreak();

@$mysg = @$error['noRecordFound'];
if(@$mysg != "")
{
    ?>
    <div class="alert alert-danger fade in alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong><?php echo $mysg ?></strong>
    </div>
    <?php
}
?>

<?php
if(SESS == 1){ @$sess = 'Annual';}else if(SESS == 2){ @$sess = 'Supply';}
?>

<?php
if(strtotime(date("d-m-Y")) > strtotime(LASTDATE)) 
{
    ?>
    <div class="alert alert-danger fade in alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
        <strong>View your rechecking application status</strong>
    </div>
    <?php
}

if(strtotime(date("d-m-Y")) <= strtotime(LASTDATE)) 
{
    ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
        <strong>Online Rechecking for  <?= SESSNAME ?> (<?= CLS ?>th) <?php echo $sess; ?> , <?= YEAR?></strong>
        <b style="color: maroon;"><?= ' Last Date '.LASTDATE?> </b>
    </div>
    <?php
}    
?>
<div id="hidDivForPrint">
    <form enctype="multipart/form-data" id="recheckingStatus" name="recheckingStatus" method="post" action="<?php echo base_url(); ?>index.php/Rechecking/recheckingStatus">
        <h3 class="bold"><strong>1- Rechecking Status</strong></h3>
        <div class="form-group">
            <label for="stClass">Select Class:</label>
            <select id="stClass" name="stClass" required  class="form-control">
                <option value='0' selected="selected">NONE</option>
                <option value='9' <?php if(CLS == 9) echo 'selected' ?>>9th</option>
                <option value='10' <?php if(CLS == 10) echo 'selected' ?>>10th</option>
                <option value='11' <?php if(CLS == 11) echo 'selected' ?>>11th</option>
                <option value='12' <?php if(CLS == 12) echo 'selected' ?>>12th</option>
            </select>
            <label for="appId">Application ID / Roll No:</label>
            <input type="text" class="form-control" maxlength="6" id="appId" name="appId" value="<?php @$app = @$_POST['appId']; if ($app != '') echo $app; else echo $app = $this->uri->segment(3);  ?>" placeholder="Enter Application ID / Roll No" required="required">
        </div>
        <?php
        if(@$data != false)
        {
            ?>
            <div class="row">
                <?php
                if(strtotime(date("d-m-Y")) > strtotime(LASTDATE)) 
                {
                    ?>
                    <div class="col-md-12">
                        <button type="submit" id="chkStatus" name="chkStatus" class="btn btn-primary btn-block" onclick="return chkRechecking(this);">Check Status</button>
                    </div>
                    <?php
                }
                else{
                    ?>    
                    <div class="col-md-6">
                        <button type="submit" id="chkStatus" name="chkStatus" class="btn btn-primary btn-block" onclick="return chkRechecking(this);">Check Status</button>
                    </div>
                    <?php
                }
                if(strtotime(date("d-m-Y")) <= strtotime(LASTDATE)) 
                {
                    ?>  
                    <div class="col-md-6">
                        <input type="button" value="Back to Rechecking Page" id="cancel" name="cancel" class="btn btn-success btn-block" onclick="return CancelAlert();">
                    </div>
                    <?php
                }
                ?>
            </div>  
            <?php
        }
        else{
            ?>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" id="chkStatus" name="chkStatus" class="btn btn-primary btn-block" onclick="return chkRechecking(this);">Check Status</button>
                </div>
            </div>
            <?php
        }
        ?>

    </form>
</div>

<br style="display: block; margin: 5px 0;">

<?php

if(@$data != false)
{
    $type = pathinfo(@$data[0]['picPath'], PATHINFO_EXTENSION); 
    @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(@$data[0]['picPath']));

    $myap_id = array();
    for($i = 0; $i < count($data) ; $i++)
    {
        array_push($myap_id,$data[$i]['app_id']);
    }
    $mynu= array_unique($myap_id); 

    @$sa = array();
    $sa = array_values($mynu);

    $myarrlist = "";
    for($j = 0; $j < count($sa) ; $j++)
    {
        @$myarrlist .= $sa[$j].','; 
    }

    for($c = 0; $c < count(@$data); $c++ )
    {
        if (@$data[$c]['Rec_Part'] == 1)
        {
            @$part1subject = 1;
        }

        if (@$data[$c]['Rec_Part'] == 2)
        {
            @$part2subject = 1;
        }

        if (@$data[$c]['Rec_Part'] == 3)
        {
            @$practicalsubject = 1;
        }
    }

    @$status =  $data[0]['status'];
    @$case = "";
    switch ($status) {
        case 1:
            $message = "Your application is UNDER PROCESS";
            $case = 1;
            break;
        case 2:
            $message = "Your application is UNDER PROCESS";
            $case = 2;
            break;
        case 3:
            $message = "Your visit date for rechecking at C.S.O Branch B.I.S.E GRW is ".@$data[0]['rechk_date']." at 12:00PM to 05:00PM<br />Note: On Friday 2:00PM to 05:00PM and On Sunday 09:00AM to 03:00PM";
            $case = 3;
            break;
        case 4:
            $message = "Your rechecking has been completed.";
            $case = 4;
            break;
        case 5:
            $message = "Your rechecking has been completed. No change found in rechecking";
            $case = 5;
            break;
        case 6:
            $message = "Application was not processed due to non receipt of fee.";
            $case = 6;
            break;
        default:                             
            $message = "Application Status Not Found.";
            break;      
    }

    echo ' <br style="display: block; margin: 5px 0;">';            
    ?>
    <?php
    if($case == 1 || $case == 2)
    {
        ?>
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
            <strong>Please keep visiting our website to check your visit date.</strong>
        </div>
        <?php
    }
    ?>
    <div id="wrapper" class="container">
        <form enctype="multipart/form-data" id="returnApplicationForm" name="returnApplicationForm" method="post" >
            <div class="page-head-image">
                <img id="previewImg" style="width:140px; height: 140px;" class="img-rounded" src="<?php echo $image_path_selected ?>" alt="Candidate Image">
            </div>
            <?php
            echo '<br>';     
            if($case == 1 || $case == 2) 
            {
                ?>
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong><?php echo $message ?></strong>
                </div>
                <?php
            }
            else if($case == 3){ 
                ?>
                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong><?php echo $message ?></strong>
                </div>
                <?php
            }
            else if($case == 4 || $case == 5){
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong><?php echo $message ?></strong>
                </div>
                <?php
            }
            else{
                ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong><?php echo $message ?></strong>
                </div>
                <?php
            }
            ?>
            <fieldset>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name"  class="control-label" >Application ID(s):</label>
                        <input type="text" class="form-control" value="<?php echo rtrim($myarrlist,','); ?>" readonly="readonly">    
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name"  class="control-label" >Name:</label>
                        <input type="text" class="form-control" value="<?php echo @$data[0]['name']; ?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name"  class="control-label" >Father Name:</label>
                        <input type="text" class="form-control" value="<?php echo @$data[0]['Fname']; ?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name"  class="control-label" >Roll No:</label>
                        <input type="text" class="form-control" value="<?php echo @$data[0]['rno']; ?>" readonly="readonly">
                    </div>
                </div>
                <?php

                if(@$part1subject == 1 && $case < 4)
                {
                    ?>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label" for="district">Subjects Part-I</label>
                            <table class="table"  border="2px">
                                <thead>
                                    <tr>
                                        <th>Subjects Part-I</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 
                                            <?php

                                            for($i = 0; $i < count(@$data); $i++ )
                                            {
                                                if($data[$i]['Rec_Part'] == 1)
                                                {
                                                    echo @$data[$i]['Sub_Name'].'</br>';          
                                                }
                                            }
                                            ?>
                                        </td>    

                                        <td> 
                                            <?php

                                            for($i = 0; $i < count(@$data); $i++ )
                                            {
                                                if($data[$i]['Rec_Part'] == 1)
                                                {
                                                    echo @$data[$i]['Marks'].'</br>';          
                                                }
                                            }
                                            ?>
                                        </td> 

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <?php
                }
                if(@$part2subject == 1  && $case < 4){
                    ?>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label" for="district">Subjects Part-II</label>
                            <table class="table" border="2px">
                                <thead>
                                    <tr>
                                        <th>Subjects Part-II</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 
                                            <?php
                                            for($i = 0; $i < count(@$data) ; $i++)
                                            {
                                                if($data[$i]['Rec_Part'] == 2)
                                                {
                                                    echo @$data[$i]['Sub_Name'].'</br>';      
                                                }
                                            }
                                            ?>
                                        </td>

                                        <td> 
                                            <?php
                                            for($i = 0; $i < count(@$data) ; $i++)
                                            {
                                                if($data[$i]['Rec_Part'] == 2)
                                                {
                                                    echo @$data[$i]['Marks'].'</br>';      
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                }
                if(@$practicalsubject == 1  && $case < 4){
                    ?>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label" for="district">Subjects Practical</label>

                            <table class="table" border="2px">
                                <thead>
                                    <tr>
                                        <th>Subjects Practical</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 
                                            <?php

                                            for($i = 0; $i < count(@$data); $i++ )
                                            {
                                                if($data[$i]['Rec_Part'] == 3)
                                                {
                                                    echo @$data[$i]['Sub_Name'].'</br>';          
                                                }
                                            }
                                            ?>
                                        </td>    

                                        <td> 
                                            <?php

                                            for($i = 0; $i < count(@$data); $i++ )
                                            {
                                                if($data[$i]['Rec_Part'] == 3)
                                                {
                                                    echo @$data[$i]['Marks'].'</br>';          
                                                }
                                            }
                                            ?>
                                        </td> 

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <?php
                }
                ?>
                <div id="hidDivForPrint1">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" value="Download" id="Download" name="Download" class="btn btn-primary btn-lg btn-block info">Print</button>
                        </div>
                    </div>     
                </div>
            </fieldset> 
        </form>
    </div>
    <?php
}
?>