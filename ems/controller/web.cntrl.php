<?php
    
    class cntrl
    {
        private $db_val ;
        private $timestamp;
        function __construct()
        {
            $mydb=new db_function();
            $this->db_val = $mydb;
            
        }
        
        
        function user_login($username,$pwd,$type)
        {
            $myLogin=null;
            //$myComplaint = $this->db_val->select_fields_where_two( "*","tblclient", "clnt_email", $username, "clnt_pwd", $pwd );
            if($type=="1")
            {
                $arr[]=array("where  ( ","usr_email","=",$username) ;
                $arr[]=array(" or ","usr_mobile","=",$username) ;
                $arr[]=array(" ) and ","usr_pwd","=",$pwd) ;
         
                $myLogin = $this->db_val->select_where( "*","tbluser", $arr );
            }else if($type=="2")
            {
                $arr[]=array("where  ( ","agncy_email","=",$username) ;
                $arr[]=array(" or ","agncy_mobile","=",$username) ;
                $arr[]=array(" ) and ","agncy_pwd","=",$pwd) ;
                $myLogin = $this->db_val->select_where( "*","tblagency", $arr );
            }else if($type=="3")
            {
                $arr[]=array("where  ( ","sct_president_mobile","=",$username) ;
                $arr[]=array(" or ","sct_email","=",$username) ;
                $arr[]=array(" ) and ","sct_pwd","=",$pwd) ;
                $myLogin = $this->db_val->select_where( "*","tblsociety", $arr );
            }else if($type=="4")
            {
                $arr[]=array("where   ","tcn_email","=",$username) ;
                $arr[]=array("  and ","tcn_pwd","=",$pwd) ;
                $myLogin = $this->db_val->select_where( "*","tbltechnician", $arr );
            }
            return $myLogin;
        }
        
        function package_list()
        {
            
            $arr="";
            $myPackageList = $this->db_val->select_where_all( "*","tblpackage", $arr );
           
            return $myPackageList;
        }
        function package_list_report($pkgname)
        {  
            $tbl=null;
            $tbl=array("tblpackage");
            $arr=null;
            $arr2=null;
            if($pkgname!="")
            {
                $arr2[]=array("where ","pkg_name"," like ",$pkgname."%") ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
           
            return $myPackageList;
        }
        
        function visitortype_list()
        {
           // $arr="";
           // $myVtypeList = $this->db_val->select_where_all( "*","tblvisitortype", $arr );
            $tbl=null;
            $tbl=array("tblvisitortype"," ,tblvisitorcategory");
            $arr=null;
            $arr2=null;
            $arr[]=array("where ","vt_vc_id"," = ","vc_id") ;
            
            $myVtypeList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myVtypeList;
        }
        function visitortypecat_list()
        {
            $arr="";
            $myVtypeList = $this->db_val->select_where_all( "*","tblvisitorcategory", $arr );
            return $myVtypeList;
        }
        function city_list()
        {
            
            $arr="";
            $myPackageList = $this->db_val->select_where_all( "*","tblcity", $arr );
           
            return $myPackageList;
        }
        function city_list_report($city)
        {
            //$tbl="tblcity";
            $tbl=null;
            $tbl=array("tblcity");
            $arr=null;
            $arr2=null;
            if($city!="")
            {
                $arr2[]=array("where ","city_name"," like ",$city."%") ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
           
            return $myPackageList;
        }
        function alongwith_list($id)
        {
            //$tbl="tblcity";
            $tbl=null;
            $tbl=array("tblalongwith");
            $arr=null;
            $arr2=null;
            
            $arr2[]=array("where ","aw_log_id"," = ",$id) ;
            
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
           
            return $myPackageList;
        }
		
		function reln_list_report($reln)
        {
            //$tbl="tblcity";
            $tbl=null;
            $tbl=array("tblrelation");
            $arr=null;
            $arr2=null;
            if($reln!="")
            {
                $arr2[]=array("where ","reln_name"," like ",$reln."%") ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
           
            return $myPackageList;
        }
		
        function technician_list()
        {
            
            $arr="";
            $myPackageList = $this->db_val->select_where_all( "*","tbltechnician", $arr );
           
            return $myPackageList;
        }
        function city_report()
        {
            $tbl="";
            $tbl=array("tblcity",",tblsociety",",tblpackage");
            
            $arr="";
            $arr[]=array("where   ","sct_city","=","city_id") ;
            $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            
            $arr2="";
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
        function guard_log_report($sct_id,$grdname,$mobile,$frmdate,$todate,$grd_duty)
        {
           
            $tbl="";
            $tbl=array("tblguard",",tblsociety",",tblguardlog");
            
            //$arr="";
            $arr[]=array("where   ","gl_sct_id","=","sct_id") ;
            $arr[]=array(" and "," gl_grd_id","=","grd_id") ;
            $arr[]=array(" and "," sct_id","=",$sct_id) ;
           // $arr[]=array(" and "," grd_login","=",$grd_duty) ;
            $arr2=null;
            if($grdname!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grdname."%") ;
            }
            if($mobile!="")
            {
                $arr2[]=array(" and ","grd_mobile"," like ",$mobile."%") ;
            }
            if($frmdate!="")
            {
                $frmdate = strtotime($frmdate)*1000;
                $arr[]=array(" and ","gl_in_time"," >=",$frmdate) ;
            }
            if($todate!="")
            {
               // $todate = strtotime($todate)*1000;
                 $todate = (strtotime($todate)*1000)+86400000;
                $arr[]=array(" and ","gl_in_time"," <=",$todate) ;
            }
           
            if($grd_duty!="")
            {
               
                $arr[]=array(" and "," grd_login","=",$grd_duty) ;
                if($grd_duty==1)
                {
                    echo "on duty";
                    $arr[]=array(" and "," gl_out_time","<=","0") ;
                }else{
                    $arr[]=array(" and "," gl_out_time",">","0") ;
                }
            }
            $myPackageList = $this->db_val->select_join_where_order("*",$tbl,$arr,$arr2,"gl_in_time desc");
            return $myPackageList;
        }
        function guard_log_report_sct($sct_id,$grdname,$mobile,$frmdate,$todate,$grd_duty)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblsociety",",tblguardlog");
            
            //$arr="";
            $arr[]=array("where   ","gl_sct_id","=","sct_id") ;
            $arr[]=array(" and "," gl_grd_id","=","grd_id") ;
            $arr[]=array(" and "," sct_id","=",$sct_id) ;
           // $arr[]=array(" and "," grd_login","=",$grd_duty) ;
            $arr2=null;
            if($grdname!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grdname."%") ;
            }
            if($mobile!="")
            {
                $arr2[]=array(" and ","grd_mobile"," like ",$grdname."%") ;
            }
            if($frmdate!="")
            {
                $frmdate = strtotime($frmdate)*1000;
                $arr[]=array(" and ","gl_in_time"," >=",$frmdate) ;
            }
            if($todate!="")
            {
               // $todate = strtotime($todate)*1000;
                 $todate = (strtotime($todate)*1000)+86400000;
                $arr[]=array(" and ","gl_in_time"," <=",$todate) ;
            }
            
            if($grd_duty!="")
            {
               
                $arr[]=array(" and "," grd_login","=",$grd_duty) ;
                if($grd_duty==1)
                {
                    $arr[]=array(" and "," gl_out_time","<=","0") ;
                }else{
                    $arr[]=array(" and "," gl_out_time",">","0") ;
                }
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
        function visitor_log_report($sct_id,$vstrname,$frmdate,$todate,$vstr_mobile)
        {
            
            $tbl="";
            $tbl=array("tblvisitor",",tblsociety",",tbllog",",tblflat",",tblwing");
            
            //$arr="";
            $arr[]=array("where   ","log_sct_id","=","sct_id") ;
            $arr[]=array(" and "," vstr_id","=","log_vstr_id") ;
            $arr[]=array(" and "," wng_id","=","flat_wng_id") ;
            $arr[]=array(" and "," log_flat_no","=","flat_id") ;
            $arr[]=array(" and "," sct_id","=",$sct_id) ;
            $arr[]=array(" and "," log_status","<=",2) ;
            
           
            $arr2=null;
            if($vstrname!="")
            {
                $arr2[]=array(" and ","vstr_name"," like ",$vstrname."%") ;
            }
            if($frmdate!="")
            {
                $frmdate = strtotime($frmdate)*1000 ;
                $arr[]=array(" and "," log_intime"," >=",$frmdate) ;
            }
            if($todate!="")
            {
               $todate = (strtotime($todate)*1000)+86400000;
                $arr[]=array(" and "," log_intime"," <=",$todate) ;
            }
            if($vstr_mobile!="")
            {
                $arr2[]=array(" and ","vstr_mobile"," like ",$vstr_mobile."%") ;
            }
            
            $myPackageList = $this->db_val->select_join_where_order("*",$tbl,$arr,$arr2," log_intime desc");
            return $myPackageList;
        }
		
		// start installation
       //	end installation	
		
        function agency_list()
        {
            
            /*
            $arr="";
            $myAgencyList = $this->db_val->select_where_all( "*","tblagency", $arr );
           */
            $tbl="";
            $tbl=array("tblcity",",tblagency");
            
            $arr[]= null;
            $arr[]=array("where   ","agncy_city","=","city_id") ;
           // $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            
            $arr2="";
            $myAgencyList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $myAgencyList;
       
        }
        function agency_list_search($agncy_name,$sct_city)
        {
            
            /*
            $arr="";
            $myAgencyList = $this->db_val->select_where_all( "*","tblagency", $arr );
           */
            $tbl="";
            $tbl=array("tblcity",",tblagency");
            
            $arr[]= null;
            $arr[]=array("where   ","agncy_city","=","city_id") ;
           // $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            
            $arr2=null;
            if($agncy_name!="")
            {
                $agncy_name = $agncy_name . "%";
                $arr2[]=array(" and ","agncy_name"," like ",$agncy_name) ;
            }
            if($sct_city!="")
            {
                
                $arr2[]=array(" and ","agncy_city"," like ",$sct_city) ;
            }
            $myAgencyList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $myAgencyList;
       
        }
		
		  function agency_admin_list_search($grd_name,$agncy_id)
        {
            
            /*
            $arr="";
            $myAgencyList = $this->db_val->select_where_all( "*","tblagency", $arr );
           */
            $tbl="";
            $tbl=array("tblcity",",tblagency");
            
            $arr[]= null;
            $arr[]=array("where   ","agncy_city","=","city_id") ;
           // $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            
            $arr2=null;
            if($agncy_name!="")
            {
                $agncy_name = $agncy_name . "%";
                $arr2[]=array(" and ","agncy_name"," like ",$agncy_name) ;
            }
            if($sct_city!="")
            {
                
                $arr2[]=array(" and ","agncy_city"," like ",$sct_city) ;
            }
            $myAgencyList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $myAgencyList;
       
        }
		
		
		
		
		
        function agency_report()
        {
            $tbl="";
            $tbl=array("tblcity",",tblagency");
            
            $arr="";
            $arr[]=array("where   ","agncy_city","=","city_id") ;
           // $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            
            $arr2="";
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
        
        function installation_list($sct_id,$tcn_name,$frdt,$todt)
        {
            $tbl="";
            $tbl=array("tblinstallation",",tblsociety",",tbltechnician",",tblpackage");
            
            //$arr="";
            $arr[]=array("where   ","inst_sct_id","=","sct_id") ;
            $arr[]=array(" and ","inst_tcn_id","=","tcn_id") ;
            $arr[]=array(" and ","sct_pkg_id","=","pkg_id") ;
            
            $arr2=null;
            if($sct_id!="")
            {
                $arr2[]=array(" and ","sct_id"," = ", $sct_id) ;
            }
            if($frdt!="")
            {
                $frmdate = strtotime($frdt)*1000 ;
                $arr[]=array(" and "," inst_date"," >=",$frmdate) ;
            }
            if($todt!="")
            {
               $todate = (strtotime($todt)*1000)+86400000;
                $arr[]=array(" and "," inst_date"," <=",$todate) ;
            }
            if($tcn_name!="")
            {
                
                $arr2[]=array(" and ","tcn_name"," like ",$tcn_name) ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            //print_r($myPackageList);
            return $myPackageList;
        }
        
        
        
        function display_work_allot($wa_id)
        {
            /*
             $tbl=null;
             $arr=null;
            $tbl=array("tblwork",",tbltechnician");
            
            
            
            $arr[]=array(" where ","tcn_id","=","wa_tcn_id") ;
            $arr[]=array(" and "," wa_id","=",$wa_id) ;
            $arr2="";
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
            */
            $tbl=null;
            $tbl=array("tblwork",",tbltechnician");
            
            $arr=null;
            $arr[]=array("where   ","wa_tcn_id","=","tcn_id") ;
            
            $arr[]=array(" and "," wa_id","=",$wa_id) ;
            $arr2="";
            $myFlatList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $myFlatList;
        }
        
        function display_work_allot_list($tcn_id,$tcn_name,$fromdate,$todate,$wa_status)
        {
            
            $tbl=null;
            $tbl=array("tblwork",",tbltechnician");
            
            $arr=null;
            $arr[]=array("where   ","wa_tcn_id","=","tcn_id") ;
            if($tcn_id>0)
            {
                $arr[]=array(" and   ","tcn_id","=",$tcn_id) ;
            }
            
            $arr2=null;
            if($tcn_name!="")
            {   
                $arr2[]=array(" and   ","tcn_name","like",$tcn_name."%") ;
            }
            if($fromdate>0)
            {
                $fromdate = strtotime($fromdate)*1000;
                $arr[]=array(" and   "," wa_date",">=",$fromdate) ;
            }
            if($todate>0)
            {
                $todate = (strtotime($todate)*1000)+86400000;
                $arr[]=array(" and   "," wa_date","<=",$todate) ;
            }
            if($wa_status!="")
            {
                
                $arr2[]=array(" and   ","wa_status","=",$wa_status) ;
            }
            $myFlatList = $this->db_val->select_join_where_order("*",$tbl,$arr,$arr2,"wa_date desc");
            
            return $myFlatList;
        }
        
        
        function client_about_display($clnt_id)
        {
            
            $myAbout = $this->db_val->select_fields_where( "*","tblclient", "clnt_id", $clnt_id,"clnt_id" );
            
            return $myAbout;
        }
        function client_about_update($about,$clnt_id)
        {
            $flds=["clnt_about"];
            $vls=["$about"];
            $myAbout = $this->db_val->update_data("tblclient",$flds,$vls, "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        function client_profile_display($clnt_id)
        {
            
            $myAbout = $this->db_val->select_fields_where( "*","tblclient", "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        function client_profile_update($profile,$clnt_id)
        {
            $flds=["clnt_profile"];
            $vls=["$profile"];
            $myAbout = $this->db_val->update_data("tblclient",$flds,$vls, "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        function client_contact_display($clnt_id)
        {
            
            $myAbout = $this->db_val->select_fields_where( "*","tblclient", "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        function client_contact_update($contact,$clnt_id)
        {
            $flds=["clnt_contact"];
            $vls=["$contact"];
            $myAbout = $this->db_val->update_data("tblclient",$flds,$vls, "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        
        function client_meeting_display($clnt_id)
        {
            
            $myAbout = $this->db_val->select_fields_where( "*","tblclient", "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        function client_meeting_add($flds,$values,$clnt_id)
        {
            $flds=["clnt_contact"];
            $vls=$values;
            $myAbout = $this->db_val->update_data("tblclient",$flds,$vls, "clnt_id", $clnt_id );
            
            return $myAbout;
        }
        function insert_data($tbl,$fld,$vls)
        {
            $myData = $this->db_val->insert_data($tbl,$fld,$vls );
        }
        function upload_file($FILES,$fname,$path)
        {
            return $myData = $this->db_val->upload_file($FILES, $fname, $path);
        }
        function gallery_list()
        {
            $timestamp=0;
            $myGallery = $this->db_val->select_data_where_condition("tblphotogallery", "*", "pg_timestamp", ">=", $timestamp, "", "", "", "", "", "", "");
        
            return $myGallery;
        }
        function check_exist($tbl,$wherefld,$wherevl)
        {
            $myData = $this->db_val->select_fields_where( "*",$tbl, $wherefld, $wherevl,$wherefld);
          
            return $myData;
        }
        function update_data($tblname, $myfileds, $myvalues, $mywhereflds, $mywherevls) 
        {
            $myData = $this->db_val->update_data($tblname, $myfileds, $myvalues, $mywhereflds, $mywherevls) ;
        }
        function update_data_where($tblname, $myfileds, $myvalues, $mywhereflds, $mywherevls,$arr) 
        {
            $myData = $this->db_val->update_data_where($tblname, $myfileds, $myvalues, $mywhereflds, $mywherevls,$arr) ;
        }
        function delete_data($tblname, $mywhereflds, $mywherevls)
        {
            $myData=$this->db_val->delete_data($tblname, $mywhereflds, $mywherevls) ;
        }
        
        function data_listing($tblname,$wherefld,$whercond,$wherevl)
        {
            $timestamp=0;
            $myDataList = $this->db_val->select_data_where_condition($tblname, "*", $wherefld, $whercond, $wherevl, "", "", "", "", "", "", "");
        
            return $myDataList;
        }
        
        function society_list()
        {
            
            /*
            $arr="";
            $mySocietyList = $this->db_val->select_where_all( "*","tblsociety", $arr );
           */
            $tbl=null;
            $tbl=array("tblcity",",tblsociety",",tblpackage",",tblagency");
            
            $arr=null;
            $arr[]=array("where   ","sct_city","=","city_id") ;
            $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            $arr[]=array(" and "," agncy_id","=","sct_agncy_id") ;
            $arr2=null;
            if($sct_name!="")
            {
                $arr2[]=array(" and ","sct_name","=",$sct_name) ;
            }
            if($sct_city!="")
            {
                $arr2[]=array(" and ","city_id","=",$sct_city) ;
            }
            if($sct_pkg_id!="")
            {
                $arr2[]=array(" and ","sct_pkg_id","=",$sct_pkg_id) ;
            }
            if($sct_agncy_id!="")
            {
                $arr2[]=array(" and ","sct_agncy_id","=",$sct_agncy_id) ;
            }
            $mySocietyList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $mySocietyList;
       
        }
        function society_list_search($sct_name,$sct_city,$sct_pkg_id,$sct_agncy_id)
        {
            
            /*
            $arr="";
            $mySocietyList = $this->db_val->select_where_all( "*","tblsociety", $arr );
           */
            $tbl=null;
            $tbl=array("tblcity",",tblsociety",",tblpackage",",tblagency");
            
            $arr=null;
            $arr[]=array("where   ","sct_city","=","city_id") ;
            $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            $arr[]=array(" and "," agncy_id","=","sct_agncy_id") ;
            $arr2=null;
            if($sct_name!="")
            {
                $arr2[]=array(" and ","sct_name","=",$sct_name) ;
            }
            if($sct_city!="")
            {
                $arr2[]=array(" and ","city_id","=",$sct_city) ;
            }
            if($sct_pkg_id!="")
            {
                $arr2[]=array(" and ","sct_pkg_id","=",$sct_pkg_id) ;
            }
            if($sct_agncy_id!="")
            {
                $arr2[]=array(" and ","sct_agncy_id","=",$sct_agncy_id) ;
            }
            $mySocietyList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $mySocietyList;
       
        }
        function society_list_agency($agncy_id,$sct_name,$sct_city)
        {
            
            /*
            $arr="";
            $mySocietyList = $this->db_val->select_where_all( "*","tblsociety", $arr );
           */
            $tbl=null;
            $tbl=array("tblcity",",tblsociety",",tblpackage",",tblagency");
            
            $arr=null;
            $arr[]=array("where   ","sct_city","=","city_id") ;
            $arr[]=array(" and "," pkg_id","=","sct_pkg_id") ;
            $arr[]=array(" and "," agncy_id","=","sct_agncy_id") ;
            $arr[]=array(" and "," agncy_id","=",$agncy_id) ;
            $arr2=null;
            if($sct_name!="")
            {
                $arr2[]=array(" and ","sct_name"," like ",$sct_name ."%") ;
            }
            if($sct_city!="")
            {
                $arr2[]=array(" and ","city_id","=",$sct_city) ;
            }
            $mySocietyList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $mySocietyList;
       
        }
        
        function flat_list($sct_id)
        {
            
            /*
            $arr="";
            $mySocietyList = $this->db_val->select_where_all( "*","tblsociety", $arr );
           */
            $tbl=null;
            $tbl=array("tblflatowner",",tblsociety",",tblflat",",tblwing");
            
            $arr=null;
            $arr[]=array("where   ","sct_id","=","wng_sct_id") ;
            $arr[]=array(" and "," flat_wng_id","=","wng_id") ;
            $arr[]=array(" and "," flat_id","=","fo_flat_id") ;
            $arr[]=array(" and "," sct_id","=",$sct_id) ;
            $arr2="";
            $myFlatList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $myFlatList;
       
        }
        function flat_list_society($sct_id,$fo_name,$flat_number)
        {
            
            /*
            $arr="";
            $mySocietyList = $this->db_val->select_where_all( "*","tblsociety", $arr );
           */
            $tbl=null;
            $tbl=array("tblflatowner",",tblsociety",",tblflat",",tblwing");
            
            $arr=null;
            $arr[]=array("where   ","sct_id","=","wng_sct_id") ;
            $arr[]=array(" and "," flat_wng_id","=","wng_id") ;
            $arr[]=array(" and "," flat_id","=","fo_flat_id") ;
            $arr[]=array(" and "," sct_id","=",$sct_id) ;
            $arr2=null;
            if($fo_name!="")
            {
                $arr2[]=array(" and ","fo_name"," like ",$fo_name ."%") ;
            }
            if($flat_number!="")
            {
                $arr2[]=array(" and ","flat_number"," like ",$flat_number ."%") ;
            }
            $myFlatList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            
            return $myFlatList;
       
        }
        function select_where($flds,$tbl,$arr)
        {
            $myRow = $this->db_val->select_where( $flds,$tbl, $arr );       
            return $myRow;
        }
        function guard_agency_report($grd_name,$mobile)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblagencyguards");
            
            //$arr="";
            $arr[]=array("where   ","ag_grd_id","=","grd_id") ;
            
            $arr[]=array(" and ","ag_agncy_id","=",$_SESSION['mypssfotusr_id']) ;
            
            $arr2=null;
            if($grd_name!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grd_name ."%") ;
            }
            if($mobile!="")
            {
                $arr2[]=array(" and ","grd_mobile"," like ",$mobile ."%") ;
            }
            
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
		// admin_agency_guardReport
		
		function guard_admin_agency_report($grd_name ,$agncy_id)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblagencyguards");
            
            //$arr="";
            $arr[]=array("where   ","ag_grd_id","=","grd_id") ;
            
           // $arr[]=array(" and ","ag_agncy_id","=",$_SESSION['mypssfotusr_id']) ;
            
            $arr2=null;
            if($grd_name!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grd_name ."%") ;
            }
			 if($grd_name!="")
            {
                $arr2[]=array(" and ","agncy_id"," like ",$agncy_id ."%") ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
		
		
        //guard_log_report_agency
       
        function guard_log_report_agency($sct_id,$grdname,$frmdate,$todate)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblsociety",",tblguardlog");
            
            //$arr="";
            $arr[]=array("where   ","gl_sct_id","=","sct_id") ;
            $arr[]=array(" and "," gl_grd_id","=","grd_id") ;
            if($sct_id>0)
            {
                $arr[]=array(" and "," sct_id","=",$sct_id) ;
            }
            $arr[]=array(" and "," sct_agncy_id","=",$_SESSION['mypssfotusr_id']) ;
            $arr[]=array(" and "," grd_login","=",1) ;
            $arr2=null;
            if($grdname!="")
            {
                $arr2[]=array(" and ","grd_name"," = ",$grdname) ;
            }
            if($frmdate!="")
            {
                $frmdate = strtotime($frmdate)*1000;
                $arr[]=array(" and ","gl_in_time"," >=",$frmdate) ;
            }
            if($todate!="")
            {
                $todate = strtotime($todate)*1000 + 86400000;
                $arr[]=array(" and ","gl_in_time"," <=",$todate) ;
            }
            if($_REQUEST['page']=="agency_onduty")
            {
                $arr2[]=array(" and ","grd_login"," = ","1") ;
                $arr2[]=array(" and ","gl_out_time"," <= ","0") ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
        function guard_log_report_agency_offduty($sct_id,$grdname,$frmdate,$todate)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblsociety",",tblsocietyguards");
            
            //$arr="";
            $arr[]=array("where   ","sg_sct_id","=","sct_id") ;
            $arr[]=array(" and "," sg_grd_id","=","grd_id") ;
            if($sct_id>0)
            {
                $arr[]=array(" and "," sct_id","=",$sct_id) ;
            }
            $arr[]=array(" and "," sct_agncy_id","=",$_SESSION['mypssfotusr_id']) ;
            $arr[]=array(" and "," grd_login","=",0) ;
            $arr2=null;
            if($grdname!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grdname."%") ;
            }
            if($frmdate!="")
            {
                $frmdate = strtotime($frmdate)*1000;
                $arr[]=array(" and "," gl_in_time"," >=",$frmdate) ;
            }
            if($todate!="")
            {
                $todate = strtotime($todate)*1000+86400000;
                $arr[]=array(" and "," gl_out_time"," <=",$todate) ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
        function guard_society_report($grd_name,$mobile)
        {
           
            $tbl="";
            $tbl=array("tblguard",",tblsocietyguards");
            
            //$arr="";
            $arr[]=array("where   ","sg_grd_id","=","grd_id") ;
            
            $arr[]=array(" and "," sg_sct_id","=",$_SESSION['mypssfotusr_id']) ;
            
            $arr2=null;
            
            if($grd_name!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grd_name."%") ;
            }
            
            if($mobile!="")
            {
                $arr2[]=array(" and ","grd_mobile"," like ",$mobile."%") ;
            }
            
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
		
		function guard_admin_society_report($grd_name,$sct_id,$grd_mobile)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblsocietyguards",",tblsociety");
            
            //$arr="";
            $arr[]=array("where   ","sg_grd_id","=","grd_id") ;
			 $arr[]=array("and   ","sg_sct_id","=","sct_id") ;
            
              
            
            $arr2=null;
            
            if($grd_name!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grd_name."%") ;
            }
			if($sct_id!="")
            {
                
                $arr2[]=array(" and ","sg_sct_id"," like ",$sct_id) ;
            }
			
            if($grd_mobile!="")
            {
            // echo $grd_mobile;   
                $arr2[]=array(" and ","grd_mobile"," like ",$grd_mobile."%") ;
            }
			
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
		
		//nikhil
	function sprovider_admin_report($vstr_name ,$vstr_address,$vstr_mobile)
        {
            //echo $vstr_mobile;
            $tbl="";
            $tbl=array("tblvisitor");
            
            //$arr="";
            $arr[]=array("where   ","vstr_status","=",1) ;
            //$arr[]=array("where   ","vstr_status","=",1) ;
			//$arr[]=array("and   ","sg_sct_id","=","sct_id") ;
            
              
            
            $arr2=null;
            $arr2[]=array(" and ","vstr_code","<>","") ;
            if($vstr_name!="")
            {
                $arr2[]=array(" and ","vstr_name"," like ",$vstr_name."%") ;
            }
			 
			
			if($vstr_address!="")
            {
                
                $arr2[]=array(" and ","vstr_address"," like ", "%".$vstr_address."%") ;
            }
		if($vstr_mobile!="")
            {
                
                $arr2[]=array(" and ","vstr_mobile"," like ",$vstr_mobile."%") ;
            }	
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
		//end nikhil
		
		
		
		function guard_admin_agency_list($grd_name,$agncy_id,$grd_mobile)
        {
            
            $tbl="";
            $tbl=array("tblguard",",tblagencyguards",",tblagency");
            
            //$arr="";
            $arr[]=array("where   ","ag_grd_id","=","grd_id") ;
			$arr[]=array("and   ","ag_agncy_id","=","agncy_id") ;
            
              
            
            $arr2=null;
            
            if($grd_name!="")
            {
                $arr2[]=array(" and ","grd_name"," like ",$grd_name."%") ;
            }
			if($agncy_id!="")
            {
                
                $arr2[]=array(" and ","ag_agncy_id"," like ",$agncy_id) ;
            }
			if($grd_mobile!="")
            {
                
                $arr2[]=array(" and ","grd_mobile"," like ",$grd_mobile."%") ;
            }
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
		
	function enquiry_list($name,$mobile,$st_dt,$end_dt)
        {
            
            /*
            $arr="";
            $mySocietyList = $this->db_val->select_where_all( "*","tblsociety", $arr );
           */
            $tbl=null;
            $tbl=array("tblenquiry");
            
            $arr=null;
            $arr[]=array("where   ","enq_id",">=","1") ;
            
            $arr2=null;
            if($name!="")
            {
                $arr2[]=array(" and ","enq_name"," like ",$name ."%") ;
            }
            if($mobile!="")
            {
                $arr2[]=array(" and ","enq_mobile"," like ",$mobile ."%") ;
            }
            
            if($st_dt!="")
            {
                $st_dt = (strtotime($st_dt)*1000);
                $arr[]=array(" and "," enq_date",">=",$st_dt) ;
            }
            if($end_dt!="")
            {
                $end_dt = (strtotime($end_dt)*1000)+86400000;
                $arr[]=array(" and "," enq_date","<=",$end_dt) ;
            }
            $mySocietyList = $this->db_val->select_join_where_order("*",$tbl,$arr,$arr2,"enq_date desc");
            
            return $mySocietyList;
       
        }
        
        function select_join_where($fld,$tbl,$arr,$arr2)
        {
           
            $myPackageList = $this->db_val->select_join_where("*",$tbl,$arr,$arr2);
            return $myPackageList;
        }
    }
    $wcntr = new cntrl();
?>


