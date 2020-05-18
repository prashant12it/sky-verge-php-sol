<?php

/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 18/05/20
 * Time: 9:21 AM
 */
class user
{
    public $APIURL;
    public $RESULT;
    public $APISLUG;
    public $courses;
    public $ssolink;
    function __construct()
    {
        //Default data set
        $this->RESULT = array();

        $this->courses['courses'][0]['Code'] = 'CS';
        $this->courses['courses'][0]['Name'] = 'Computer Science';
        $this->courses['courses'][0]['PercentageComplete'] = '72';
        $this->courses['courses'][0]['DateCompleted'] = '04/12/2019';
        $this->courses['courses'][1]['Code'] = 'DS';
        $this->courses['courses'][1]['Name'] = 'Data Science';
        $this->courses['courses'][1]['PercentageComplete'] = '74';
        $this->courses['courses'][1]['DateCompleted'] = '12/01/2020';
        $this->courses['courses'][2]['Code'] = 'ML';
        $this->courses['courses'][2]['Name'] = 'Machine Learning';
        $this->courses['courses'][2]['PercentageComplete'] = '80';
        $this->courses['courses'][2]['DateCompleted'] = '14/02/2020';
        $this->courses['courses'][3]['Code'] = 'MT';
        $this->courses['courses'][3]['Name'] = 'Mathematics';
        $this->courses['courses'][3]['PercentageComplete'] = '67';
        $this->courses['courses'][3]['DateCompleted'] = '05/03/2020';
        $this->courses['courses'][4]['Code'] = 'BC';
        $this->courses['courses'][4]['Name'] = 'Blockchain';
        $this->courses['courses'][4]['PercentageComplete'] = '74';
        $this->courses['courses'][4]['DateCompleted'] = '04/04/2020';

        $this->ssolink['link'][0] = 'www.samplecs.in';
        $this->ssolink['link'][1] = 'www.sampleds.in';
        $this->ssolink['link'][2] = 'www.sampleml.in';
        $this->ssolink['link'][3] = 'www.samplemth.in';
        $this->ssolink['link'][4] = 'www.samplebc.in';
    }
    function get_user_meta($userID,$apislug,$active){
        if($userID>0 && $active){
            //Logic for getting user api id. It could be from database by SQL query
            //Here I'm writing sample code of getting api key and it is same as the user id passed in this method.
            if($apislug == '_external_api_user_id'){
                $this->APISLUG = $apislug;
                return $userID;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function get_api(){
        //Logic for getting api url and setting it to the global. Here I'm using sample url in combination with apislug that is passed in get_user_meta method
        $this->APIURL = __API_URL__.'/'.$this->APISLUG;
        return $this;
    }
    function get_courses_assigned_to_user($userID){
        //Logic for getting courses assigned to user which we will get by querying database.
        //Here I'm setting static values to global result array. To make it dynamic I'm using user id as the index in the sample data array to get the result data.
        if($userID>0 && $userID<6){
            $this->RESULT['courses'][0]['Code'] = $this->courses['courses'][$userID-1]['Code'];
            $this->RESULT['courses'][0]['Name'] = $this->courses['courses'][$userID-1]['Name'];
            $this->RESULT['courses'][0]['PercentageComplete'] = $this->courses['courses'][$userID-1]['PercentageComplete'];
            $this->RESULT['courses'][0]['DateCompleted'] = $this->courses['courses'][$userID-1]['DateCompleted'];
            $this->RESULT['courses'][1]['Code'] = $this->courses['courses'][$userID]['Code'];
            $this->RESULT['courses'][1]['Name'] = $this->courses['courses'][$userID]['Name'];
            $this->RESULT['courses'][1]['PercentageComplete'] = $this->courses['courses'][$userID]['PercentageComplete'];
            $this->RESULT['courses'][1]['DateCompleted'] = $this->courses['courses'][$userID]['DateCompleted'];
        }
        return $this;
    }
    function get_sso_link($userID){
        //Logic for getting sso assigned to user which we will get by querying database.
        //Here I'm setting static values to global result array. To make it dynamic I'm using user id as the index in the sample data array to get the result data.
        if($userID>0 && $userID<6){
            $this->RESULT['link'][0] = $this->ssolink['link'][$userID-1];
        }
        return $this;
    }
}