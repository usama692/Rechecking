

<form method="post" action="<?php echo base_url(); ?>index.php/Rechecking/InsertRecheckingForm" name="myform" id="myform">
    <?php

    $type = pathinfo(@$data[0]['picPath'], PATHINFO_EXTENSION); 
    @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(@$data[0]['picPath']));

    @$mysg = @$error['error_msg'];
    if(@$mysg != "")
    {
        ?>
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $mysg ?> </strong></div>
        <?php
    }   
    ?>
    <h3 class="bold">Personal Information</h3>
    <div class="form-group">
        <img id="previewImg" style="width:140px; height: 140px;" class="img-rounded" src="<?php echo $image_path_selected ?>" alt="Candidate Image">
    </div>


    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required="required" value="<?php echo @$data[0]['name'] ?>" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="fName">Father Name:</label>
        <input type="text" class="form-control" id="fName" name="fName" required="required" value="<?php echo @$data[0]['Fname'] ?>" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="cellNo">Cell No:</label>
        <input type="text" class="form-control" id="cellNo" name="cellNo"  placeholder="0300-123456789">
    </div> 


    <div class="form-group">
        <label for="phone">Phone:(Optional)</label>
        <input type="text" class="form-control" id="phone" name="phone"  placeholder="055-1234567">
    </div> 

    <div class="form-group">
        <label for="addr">Address:</label>
        <input type="text" class="form-control" id="addr" name="addr" value="<?php echo @$data[0]['addr'] ?>" required="required">
    </div>

    <hr class="colorgraph">
    <h3 class="bold">Exam Information</h3>


    <div class="form-group">
        <label for="rno">Roll No:</label>
        <input type="text" class="form-control" id="rollNo" name="rollNo" value="<?php echo @$data[0]['rno'] ?>" required="required" readonly="readonly">
    </div>

    <?php

    @$grp =  @$data[0]['grp_cd'];
    @$exGrp = @$data[0]['exgrp'];

    if(CLS == 11 || CLS == 12){

        if($grp == 1){
            $subGrp = 'Pre-Medical';
        }
        else if($grp == 2){
            $subGrp = 'Pre-Engineering';
        }
        else if($grp == 3){
            $subGrp = 'Humanities';
        }
        else if($grp == 4){
            $subGrp = 'General Science';
        }
        else if($grp == 5){
            $subGrp = 'Commerce';
        }
        else {
            $subGrp = '';
        }
    }
    else if(CLS == 9 || CLS == 10){
        if($grp == 1){
            $subGrp = 'Science';
        }
        else if($grp == 2){
            $subGrp = 'Arts';
        }
        else{
            $subGrp = '';
        }  
    }
    else{
        //do nothing
    }

    if($exGrp == 1){
        $examGrp = 'First Group';
    }
    else if($exGrp == 2){
        $examGrp = 'Second Group';
    }

    else{
        $examGrp = '';
    }

    ?>

    <div class="form-group">
        <label for="grpCd">Subject Group:</label>
        <input type="text" class="form-control" id="grpCd" name="grpCd" value="<?php echo @$subGrp; ?>" required="required" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="exGrp">Exam Group:</label>
        <input type="text" class="form-control" id="examGroup" name="examGroup" value="<?php echo $examGrp; ?>" required="required" readonly="readonly">
    </div>

    <hr class="colorgraph">
    <h3 class="bold">Choose Subjects for Rechecking</h3>

    <?php
    $subarrayInter = array(
        'NONE'=>'',
        'NONE'=>'0',
        'ENGLISH' => '1',
        'URDU' => '2',
        'BANGALI' => '3',
        'URDU(ALTERNATIVE EASY COURSE)' => '4',
        'BENGALI(ALTERNATE EASY COURSE)' => '5',
        'PAKISTANI CULTURE' => '6',
        'HISTORY' => '7',
        'LIBRARY SCIENCE' => '8',
        'ISLAMIC HISTORY & CULTURE' => '9',
        'FAZAL ARABIC' => '10',
        'ECONOMICS' => '11',
        'GEOGRAPHY' => '12',
        'MILITARY SCIENCE' => '13',
        'PHILOSOPHY' => '14',
        'ISLAMIC STUDIES(ISL-ST. GROUP)' => '15',
        'PSYCHOLOGY' => '16',
        'CIVICS' => '17',
        'STATISTICS' => '18',
        'MATHEMATICS' => '19',
        'ISLAMIC STUDIES' => '20',
        'OUTLINES OF HOME ECONOMICS' => '21',
        'MUSIC' => '22',
        'FINE ARTS' => '23',
        'ARABIC' => '24',
        'BENGALI' => '25',
        'BENGALI(ADVANCE)' => '26',
        'ENGLISH ELECTIVE' => '27',
        'FRENCH' => '28',
        'GERMAN' => '29',
        'LATIN' => '30',
        'PUNJABI' => '32',
        'PASHTO' => '33',
        'PERSIAN' => '34',
        'SANSKRIT' => '35',
        'SINDHI' => '36',
        'URDU (ADVANCE)' => '37',
        'COMMERCIAL PRACTICE' => '38',
        'PRINCIPLES OF COMMERCE' => '39',
        'HEALTH & PHYSICAL EDUCATION' => '42',
        'EDUCATION' => '43',
        'GEOLOGY' => '44',
        'SOCIOLOGY' => '45',
        'BIOLOGY' => '46',
        'PHYSICS' => '47',
        'CHEMISTRY' => '48',
        'ADEEB ARBIC' => '52',
        'ADEEB URDU' => '53',
        'FAZAL URDU' => '54',
        'HISTORY OF PAKISTAN' => '55',
        'HISTORY OF ISLAM' => '56',
        'HISTORY OF INDO-PAK' => '57',
        'HISTORY OF MODREN WORLD' => '58',
        'APPLIED ART  (H-Eco Group)' => '59',
        'FOOD & NUTRITION (H-Eco Group)' => '60',
        'CHILD DEVELOPMENT AND FAMILY LIVING (H-Eco Group)' => '61',
        'PRINCIPLES OF ACCOUNTING' => '70',
        'PRINCIPLES OF ECONOMICS' => '71',
        'BIOLOGY (H-Eco Group)' => '72',
        'CHEMISTRY (H-Eco Group)' => '73',
        'CLOTHING & TEXTILE (H-Eco Group)' => '75',
        'HOME MANAGEMNET  (H-Eco Group)' => '76',
        'NURSING' => '79',
        'BUSINESS MATH' => '80',
        'COMPUTER SCIENCE' => '83',
        'AGRICULTURE' => '90',
        'PAKISTAN STUDIES' => '91',
        'ISLAMIC EDUCATION' => '92',
        'CIVICS FOR NON MUSLIM' => '93',
        'COMMERCIAL GEOGRAPHY' => '94',
        'BANKING' => '95',
        'TYPING' => '96',
        'BUSINESS STATISTICS' => '97',
        'COMPUTER STUDIES' => '98',
        'BOOK KEEPING & ACCOUNTANCY' => '99'
    );

    $subarrayMatric = array(

        'NONE'=>'',
        'NONE'=>'0',
        'URDU' => '1',
        'ENGLISH' => '2',
        'ISLAMIYAT (COMPULSORY)' => '3',
        'PAKISTAN STUDIES' => '4',
        'MATHEMATICS' => '5',
        'PHYSICS' => '6',
        'CHEMISTRY' => '7',
        'BIOLOGY' => '8',
        'GENERAL SCIENCE' => '9',
        'FOUNDATION OF EDUCATION' => '10',
        'GEOGRAPHY OF PAKISTAN' => '11',
        'HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS' => '12',
        'ELEMENTS OF HOME ECONOMICS' => '13',
        'PHYSIOLOGY & HYGIENE' => '14',
        'GEOMETRICAL & TECHNICAL DRAWING' => '15',
        'GEOLOGY' => '16',
        'ASTRONOMY & SPACE SCIENCE' => '17',
        'ART/ART & MODEL DRAWING' => '18',
        'ISLAMIC STUDIES' => '19',
        'ISLAMIC HISTORY' => '20',
        'HISTORY OF PAKISTAN' => '21',
        'ARABIC' => '22',
        'PERSIAN' => '23',
        'GEOGRAPHY' => '24',
        'ECONOMICS' => '25',
        'CIVICS' => '26',
        'FOOD AND NUTRITION' => '27',
        'ART IN HOME ECONOMICS' => '28',
        'MANAGEMENT FOR BETTER HOME' => '29',
        'CLOTHING & TEXTILES' => '30',
        'CHILD DEVELOPMENT AND FAMILY LIVING' => '31',
        'MILITARY SCIENCE' => '32',
        'COMMERCIAL GEOGRAPHY' => '33',
        'URDU LITERATURE' => '34',
        'ENGLISH LITERATURE' => '35',
        'PUNJABI' => '36',
        'EDUCATION' => '37',
        'ELEMENTARY NURSING & FIRST AID' => '38',
        'PHOTOGRAPHY' => '39',
        'HEALTH & PHYSICAL EDUCATION' => '40',
        'CALIGRAPHY' => '41',
        'LOCAL (COMMUNITY) CRAFTS' => '42',
        'ELECTRICAL WIRING' => '43',
        'RADIO ELECTRONICS' => '44',
        'COMMERCE' => '45',
        'AGRICULTURE' => '46',
        'BOOK KEEPING & ACCOUNTANCY' => '47',
        'WOOD WORK (FURNITURE MAKING)' => '48',
        'GENERAL AGRICULTURE' => '49',
        'FARM ECONOMICS' => '50',
        'ETHICS' => '51',
        'LIVE STOCK FARMING' => '52',
        'ANIMAL PRODUCTION' => '53',
        'PRODUCTIVE INSECTS AND FISH CULTURE' => '54',
        'HORTICULTURE' => '55',
        'PRINCIPLES OF HOME ECONOMICS' => '56',
        'RELATED ACT' => '57',
        'HAND AND MACHINE EMBROIDERY' => '58',
        'DRAFTING AND GARMENT MAKING' => '59',
        'HAND & MACHINE KNITTING & CROCHEING' => '60',
        'STUFFED TOYS AND DOLL MAKING' => '61',
        'CONFECTIONERY AND BAKERY' => '62',
        'PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS' => '63',
        'CARE AND GUIDENCE OF CHILDREN' => '64',
        'FARM HOUSE HOLD MANAGEMENT' => '65',
        'ARITHEMATIC' => '66',
        'BAKERY' => '67',
        'CARPET MAKING' => '68',
        'DRAWING' => '69',
        'EMBORIDERY' => '70',
        'HISTORY' => '71',
        'TAILORING' => '72',
        'TYPE WRITING' => '73',
        'WEAVING' => '74',
        'SECRETARIAL PRACTICE' => '75',
        'CANDLE MAKING' => '76',
        'SECRETARIAL PRACTICE AND CORRESPONDANCE' => '77',
        'COMPUTER SCIENCES' => '78',
        'WOOD WORK (BOAT MAKING)' => '79',
        'PRINCIPLES OF ARITHMATIC' => '80',
        'SEERAT-E-RASOOL' => '81',
        'AL-QURAAN' => '82',
        'POULTRY FARMING' => '83',
        'ART & MODEL DRAWING' => '84',
        'BUSINESS STUDIES' => '85',
        'HADEES & FIQAH' => '86',
        'ENVIRONMENTAL STUDIES' => '87',
        'REFRIGERATION AND AIR CONDITIONING' => '88',
        'FISH FARMING' => '89',
        'COMPUTER HARDWARE' => '90',
        'BEAUTICIAN' => '91',
        'GENERAL MATHEMATICS' => '92',
        'COMPUTER SCIENCES_DFD' => '93',
        'HEALTH & PHYSICAL EDUCATION_DFD' => '94'
    );

    $matricPracticalSubjectsArray = array(

        'PHYSICS' => '6',
        'CHEMISTRY' => '7',
        'BIOLOGY' => '8',
        'ART & MODEL DRAWING' => '18', 
        'FOOD AND NUTRITION' => '27', 
        'CLOTHING & TEXTILES' => '30', 
        'HEALTH & PHYSICAL EDUCATION' => '40', 
        'ELECTRICAL WIRING' => '43', 
        'WOOD WORK (FURNITURE MAKING)' => '48', 
        'DRAWING' => '69', 
        'EMBORIDERY' => '70', 
        'TAILORING' => '72', 
        'COMPUTER SCIENCE' => '78', 
        'POULTRY FARMING' => '83', 
        'FISH FARMING' => '89', 
        'COMPUTER HARDWARE' => '90', 
        'COMPUTER SCIENCES_DFD' => '93', 
        'HEALTH & PHYSICAL EDUCATION_DFD' => '94' 
    );

    $interPracticalSubjectsArray = array(

        'LIBRARY SCIENCE'=>'8',
        'GEOGRAPHY'=>'12',
        'PSYCHOLOGY'=>'16',
        'STATISTICS'=>'18',
        'OUTLINES OF HOME ECONOMICS'=>'21',
        'FINE ARTS'=>'23',
        'COMMERCIAL PRACTICE'=>'38',
        'HEALTH & PHYSICAL EDUCATION'=>'42',
        'BIOLOGY'=>'46',
        'PHYSICS'=>'47',
        'CHEMISTRY'=>'48',
        'CLOTHING & TEXTILE (Home-Economics Group)'=>'75',
        'HOME MANAGEMNET (Home-Economics Group)'=>'76',
        'NURSING'=>'79',
        'COMPUTER SCIENCE'=>'83',
        'AGRICULTURE'=>'90',
        'TYPING'=>'96',
        'COMPUTER STUDIES'=>'98'
    );

    if(@$data[0]['sub1Ap1'] == 1 || @$data[0]['sub2Ap1'] == 1 || @$data[0]['sub3Ap1'] == 1 || @$data[0]['sub4Ap1'] == 1 || @$data[0]['sub5Ap1'] == 1 || @$data[0]['sub6Ap1'] == 1 || @$data[0]['sub7Ap1'] == 1 || @$data[0]['sub8ap1'] == 1)
    {
        ?>
        <h4 class="h4">Subjects  Part-I</h4>
        <div class="form-group">
            <?php

            if (@$data[0]['status'] != 4)
            {
                for(@$i = 1; $i < 9; $i++)
                {
                    $ap = "";
                    if(($i==8) && (CLS == 9 || CLS == 10))
                    {
                        $ap= 'ap1';
                    }
                    else
                    {
                        $ap = 'Ap1';
                    }

                    if((@$data[0]['cat09'] !='' || @$data[0]['cat11'] !='') && (@$data[0]['sub'.$i.$ap] == 1) )
                    {
                        @$disable = ""; 
                        @$checked = ""; 

                        if(@$data[0]['sub'.$i.'rec1'] == 1)
                        {
                            $disable = 'disabled';
                            $checked = "checked";
                            @$alreadyApplied ="(<span style='color:green'>Already applied</span>)";
                        }
                        else
                        {
                            @$disable = "";   
                            @$checked = ""; 
                            @$alreadyApplied ="";
                        }

                        ?>
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" <?php echo $disable.' '. $checked ; ?>  id="subList" name="<?= 'p1sub'.@$i ?>" value="<?= @$data[0]['sub'.@$i]?>"><span style="padding: 10px;"><?php  if(CLS == 10 || CLS == 9){ echo  array_search(@$data[0]['sub'.@$i],@$subarrayMatric);} else if(CLS == 11 || CLS == 12){ echo  array_search(@$data[0]['sub'.@$i],@$subarrayInter); } ?></span><?php echo $alreadyApplied ?></br>
                            </label>
                        </div> 
                        <?php
                    }
                }
            }
            else{
                ?>   
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong>You are not Eligible to Apply for Rechecking</strong>
                </div>
                <?php 
            }  
            ?>             
        </div>
        <?php
    }

    if(@$data[0]['sub1Ap2'] == 1 ||  @$data[0]['sub2Ap2'] == 1 ||  @$data[0]['sub3ap2'] == 1 ||  @$data[0]['sub4Ap2'] == 1 ||  @$data[0]['sub5Ap2'] == 1 ||  @$data[0]['sub6Ap2'] == 1 ||  @$data[0]['sub7Ap2'] == 1 ||  @$data[0]['sub8Ap2'] == 1)
    {
        ?>
        <hr class="colorgraph">
        <h4 class="h4">Subjects  Part-II</h4>
        <div class="form-group">
            <?php

            if (@$data[0]['status'] != 4)
            {
                //DebugBreak();

                for($i = 1; $i < 9; $i++)
                {
                    $ap = "";
                    if(($i==3 )&& (CLS == 9 || CLS == 10))
                    {
                        $ap= 'ap2';
                    }
                    else
                    {
                        $ap = 'Ap2';
                    }

                    if($i == 3 && CLS == 12)
                    {
                        $i = 8;
                        $bit = 1;
                    }
                    if((@$data[0]['cat10'] !='' || @$data[0]['cat12'] !='') && (@$data[0]['sub'.$i.$ap] == 1)&& (@$data[0]['status'] != 4))
                    {
                        @$disable = ""; 
                        @$checked = "";

                        if(@$data[0]['sub'.$i.'rec2'] == 1)
                        {
                            $disable = "disabled";
                            $checked = "checked";
                            @$alreadyApplied ="(<span style='color:green'>Already applied</span>)";
                        }
                        else
                        {
                            @$disable = "";   
                            @$checked = "";   
                            @$alreadyApplied ="";
                        }
                        ?>   

                        <?php
                        if($i == 8 && $bit == 0)
                        {
                            break;             
                        }
                        ?>
                        <div class="form-group">
                            <label class="checkbox-inline">                     
                                <input type="checkbox" name="<?= 'p2sub'.$i ?>" <?php echo $disable.' '. $checked ; ?> id="subList" value="<?= @$data[0]['sub'.$i]?>"><span style="padding: 10px;"><?php if(CLS == 9 || CLS == 10){ echo  array_search($data[0]['sub'.$i],$subarrayMatric);} else if(CLS == 11 || CLS == 12)
                                    {
                                        if((@$data[0]['grp_cd'] == 5) && ($i > 4) && $bit == 0)
                                        {
                                            echo  array_search(@$data[0]['sub'.$i.'A'],$subarrayInter); 
                                        }
                                        else{
                                            echo  array_search(@$data[0]['sub'.$i],$subarrayInter); 
                                        }
                                    } 
                                    ?>
                                </span><?php echo $alreadyApplied ?></br>
                            </label>
                        </div> 
                        <?php
                    }
                    if($i == 8 && CLS == 12 && $bit==1)
                    {
                        $i = 3;
                        $bit = 0;
                    }
                }
            }
            else{
                ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong>Sorry You are not Eligible to Apply for Rechecking</strong>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    if( ( @$data[0]['sub5Ap2'] == 1 || @$data[0]['sub6Ap2'] == 1 || @$data[0]['sub7Ap2'] == 1) && (@$data[0]['sub5sp2'] == 1 || @$data[0]['sub6sp2'] == 1 || @$data[0]['sub7sp2'] == 1) )
    {
        ?>
        <hr class="colorgraph">
        <h4 class="h4">Subjects  Practical</h4>

        <div class="form-group">
            <?php


            if(@$data[0]['sub4sp2'] == 1 && @$data[0]['sub4Ap2'] == 1)
            {
                @$currVal =  $data[0]['sub4'];

                if(CLS == 10){
                    @$matricPrac =  array_search($currVal, $matricPracticalSubjectsArray);
                    $val = $matricPrac;
                }
                else if(CLS == 12){
                    @$interPrac =  array_search($currVal, $interPracticalSubjectsArray);  
                    $val = $interPrac;
                }

                if($val)
                {
                    if(@$data[0]['sub4prec2'] == 1)
                    {
                        $disable = 'disabled';
                        $checked = "checked";
                        @$alreadyApplied ="(<span style='color:green'>Already applied</span>)";
                    }
                    else
                    {
                        @$disable = "";   
                        @$checked = ""; 
                        @$alreadyApplied ="";
                    }
                    ?>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"  <?php echo $disable.' '. $checked ; ?>  id="subList" name="<?= 'sub4sp2' ?>" value="<?= @$data[0]['sub4']?>"><span style="padding: 10px;"><?php  if(CLS == 9 || CLS == 10){ echo  array_search($data[0]['sub4'],$subarrayMatric);} else if(CLS == 11 || CLS == 12){ echo  array_search($data[0]['sub4'],$subarrayInter); } ?></span><?php echo $alreadyApplied ?></br>
                        </label>
                    </div> 
                    <?php
                }
            }

            if(@$data[0]['sub5sp2'] == 1 && @$data[0]['sub5Ap2'] == 1)
            {
                @$currVal =  $data[0]['sub5'];

                if(CLS == 10){
                    @$matricPrac =  array_search($currVal, $matricPracticalSubjectsArray);
                    $val = $matricPrac;
                }
                else if(CLS == 12){
                    @$interPrac =  array_search($currVal, $interPracticalSubjectsArray);  
                    $val = $interPrac;
                }

                if($val)
                {
                    if(@$data[0]['sub5prec2'] == 1)
                    {
                        $disable = 'disabled';
                        $checked = "checked";
                        @$alreadyApplied ="(<span style='color:green'>Already applied</span>)";
                    }
                    else
                    {
                        @$disable = "";   
                        @$checked = ""; 
                        @$alreadyApplied ="";
                    }
                    ?>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"  <?php echo $disable.' '. $checked ; ?>  id="subList" name="<?= 'sub5sp2' ?>" value="<?= @$data[0]['sub5']?>"><span style="padding: 10px;"><?php  if(CLS == 9 || CLS == 10){ echo  array_search($data[0]['sub5'],$subarrayMatric);} else if(CLS == 11 || CLS == 12){ echo  array_search($data[0]['sub5'],$subarrayInter); } ?></span><?php echo $alreadyApplied ?></br>
                        </label>
                    </div> 
                    <?php
                }
            }

            if(@$data[0]['sub6sp2'] == 1 && @$data[0]['sub6Ap2'] == 1)
            {
                @$currVal =  $data[0]['sub6'];

                if(CLS == 10){
                    @$matricPrac =  array_search($currVal, $matricPracticalSubjectsArray);
                    $val = $matricPrac;
                }
                else if(CLS == 12){
                    @$interPrac =  array_search($currVal, $interPracticalSubjectsArray);  
                    $val = $interPrac;
                }

                if($val)
                {
                    if(@$data[0]['sub6prec2'] == 1)
                    {
                        $disable = 'disabled';
                        $checked = "checked";
                        @$alreadyApplied ="(<span style='color:green'>Already applied</span>)";
                    }
                    else
                    {
                        @$disable = "";   
                        @$checked = ""; 
                        @$alreadyApplied ="";
                    }
                    ?>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"  <?php echo $disable.' '. $checked ; ?>  id="subList" name="<?= 'sub6sp2' ?>" value="<?= @$data[0]['sub6']?>"><span style="padding: 10px;"><?php  if(CLS == 9 || CLS == 10){ echo  array_search($data[0]['sub6'],$subarrayMatric);} else if(CLS == 11 || CLS == 12){ echo  array_search($data[0]['sub6'],$subarrayInter); } ?></span><?php echo $alreadyApplied ?></br>
                        </label>
                    </div> 
                    <?php
                }
            }

            if(@$data[0]['sub7sp2'] == 1 && @$data[0]['sub7Ap2'] == 1)
            {
                if(CLS == 12 && @$data[0]['grp_cd'] == 5){
                    @$currVal =  $data[0]['sub7A'];    
                }
                else{
                    @$currVal =  $data[0]['sub7'];        
                }

                if(CLS == 10){
                    @$matricPrac =  array_search($currVal, $matricPracticalSubjectsArray);
                    $val = $matricPrac;
                }
                else if(CLS == 12){
                    @$interPrac =  array_search($currVal, $interPracticalSubjectsArray);  
                    $val = $interPrac;
                }

                if($val)
                {
                    if(@$data[0]['sub7prec2'] == 1)
                    {
                        $disable = 'disabled';
                        $checked = "checked";
                        @$alreadyApplied ="(<span style='color:green'>Already applied</span>)";
                    }
                    else
                    {
                        @$disable = "";   
                        @$checked = ""; 
                        @$alreadyApplied ="";
                    }
                    ?>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"  <?php echo $disable.' '. $checked ; ?>  id="subList" name="<?= 'sub7sp2' ?>" value="<?= @$data[0]['sub7']?>"><span style="padding: 10px;"><?php  if(CLS == 9 || CLS == 10){ echo  array_search($data[0]['sub7'],$subarrayMatric);} else if(CLS == 11 || CLS == 12)
                                {
                                    if(@$data[0]['grp_cd'] == 5 && CLS == 12){
                                        echo  array_search($data[0]['sub7A'],$subarrayInter); 
                                    }
                                    else{
                                        echo  array_search($data[0]['sub7'],$subarrayInter); 
                                    }
                                } 
                                ?>
                            </span><?php echo $alreadyApplied ?></br>
                        </label>
                    </div> 
                    <?php
                }
            }
            ?>
        </div>

        <?php
    }
    ?>

    <hr class="colorgraph">


    <!---Start Hidden fields -->

    <input type="hidden" id="bName" name="bName" value="<?php echo @$postArray['bName'] ?>"> 
    <input type="hidden" id="challan" name="challan" value="<?php echo @$postArray['challan'] ?>"> 
    <input type="hidden" id="paidDate" name="paidDate" value="<?php echo @$postArray['paidDate'] ?>"> 
    <input type="hidden" id="amount" name="amount" value="<?php echo @$postArray['amount'] ?>"> 
    <input type="hidden" id="clas" name="clas" value="<?php echo @$data[0]['class'] ?>"> 
    <input type="hidden" id="Iyear" name="Iyear" value="<?php echo @$data[0]['Iyear'] ?>"> 
    <input type="hidden" id="sess" name="sess" value="<?php echo @$data[0]['sess'] ?>"> 
    <input type="hidden" id="rno" name="rno" value="<?php echo @$data[0]['rno'] ?>"> 
    <input type="hidden" id="grp_cd" name="grp_cd" value="<?php echo @$data[0]['grp_cd'] ?>"> 

    <!---End Hidden fields -->


    <div class="form-group">
        <label class="checkbox-inline">
            <input type="checkbox" class="checkboxtext" id="terms" name="terms" value="yes"><span style="color: red; font-size: larger; font-weight: bold; padding: 10px;">I agree with the Terms and Conditions of Board of Intermediate and Secondary Education, Gujranwala</span>  
        </label>
    </div> 

    <div class="row">
        <div class="col-md-6">
            <input type="button" value="Submit" id="submit" name="submit" class="btn btn-primary btn-block" onclick="return checks()">
        </div>
        <div class="col-md-6">
            <input type="button" value="Cancel" id="cancel" name="cancel" class="btn btn-danger btn-block" onclick="return CancelAlert();">
        </div>
    </div>
</form>