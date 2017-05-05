<?php

namespace backend\controllers;

use Yii;
use app\models\Engineatt;
use app\models\Card;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class DownloadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionEngineatt(){
        //$dt_array=array();
        $sensorid=1;
        $IP= "192.168.100.136";
        $Key= 80;
        $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
        if($Connect){
                $ket=1;
                $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                $newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
                $buffer="";
                while($Response=fgets($Connect, 1024)){
                        $buffer=$buffer.$Response;
                }
        }else $ket=0;

        //include("parse.php");
        //yii::import('application.extensions.att.parse');
        //
        $dt_array=[];
        $buffer=$this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
        $buffer=explode("\r\n",$buffer);
        for($a=1;$a<count($buffer);$a++){
                $data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");
                $PIN=$this->Parse_Data($data,"<PIN>","</PIN>");
                $DateTime=$this->Parse_Data($data,"<DateTime>","</DateTime>");
                $Verified=$this->Parse_Data($data,"<Verified>","</Verified>");
                $Status=$this->Parse_Data($data,"<Status>","</Status>");

                if ($PIN <> 0 ) { 
                        //$query="INSERT IGNORE engineatt(pin, dateatt, verified, status) 
                        //VALUES ( $PIN,'$DateTime', $Verified, $Status)
                        //;";
                        //$connect= yii::app()->db;
                        //$connect->createCommand($query)->query();
                        $dt_array[
                            [
                                'pin'=>$PIN,
                                'datetime'=>$DateTime,
                                'vaerified'=>$Verified,
                                'status'=>$Status,
                            ]
                        ];
                        /*$dt_array[$a]['PIN']=$PIN;
                        $dt_array[$a]['DateTime']=$DateTime;
                        $dt_array[$a]['Verified']=$Verified;
                        $dt_array[$a]['Status']=$Status;
                        $dt_array[$a]['SensorId']= $sensorid;
                        */
               
                }

        }
        $list_data = ArrayHelper::getValue($dt_array, 'pin.datetime');

        return $this->render('engineatt',[
            'dt_array'=>$list_data, 
            //'hakam'=>$hakam
        ]);
        
    }
    
    public function Parse_Data($data,$p1,$p2) 
    {
        $data=" ".$data;
        $hasil="";
        $awal=strpos($data,$p1);
        if($awal!=""){
                $akhir=strpos(strstr($data,$p1),$p2);
                if($akhir!=""){
                        $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
                }
        }
        return $hasil;	
    }

}
