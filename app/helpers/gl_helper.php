<?php 

 function listData( $table,$name,$value, $title,$where = null,$orderBy='ASC') {
    if( $title === null ){

      $items = array();

    }else{
      $items = array( '' => $title );
    }
  
  $CI =& get_instance();
  if($orderBy) {
  $CI->db->order_by($value,$orderBy);
  }

  if($where == null ){
    $query = $CI->db->select("$name,$value")->from($table)->get();
  }else{
    $CI->db->where($where);
    $query = $CI->db->select("$name,$value")->from($table)->get();
  }

  
    if ($query->num_rows() > 0) {
      foreach($query->result() as $data) {
        $items[$data->$name] = $data->$value;
      }
      $query->free_result();
      return $items;
    }else{
      return $items = array( '' => $title );
    }
  }

 function get_num_product( $table,$name,$value,$where = null,$orderBy='ASC') {
    
  
  $CI =& get_instance();
  $CI->db->where($where);
  $query = $CI->db->select("$name,$value")->from($table)->get();
  
    if ($query->num_rows() > 0) {
      foreach($query->result() as $data) {
        $items[$data->$name] = $data->$value;
      }
      $query->free_result();
      return $items;
    }
}

function get_template( $template, $interval = 3 ) {
    
  $CI =& get_instance();

  $query = $CI->db->order_by('order', 'ASC')->get_where('layout', array('template' => $template, 'activated' => 1 ));

  $items = '';

  if( $query->num_rows() > 0 ):

    switch ($template) {

    case 'home-header':
        $items .= ' <div class="row">';
          $items .= '<div class="col-md-10 col-sm-offset-1">';
            $items .= '<div class="carousel slide media-carousel" id="'.$template.'">';
              $items .= '<div class="carousel-inner">';
                $i = 0;
                foreach( $query->result() as $file ):
                  $i++;
                  if(empty( $file->code )):

                    $items .= '<div class="item '.($i == 1 ? 'active' : '' ).'">';
                    $items .= '<a href="'.$file->link.'" target="_black">';
                    $items .= '<img src="'.base_url('assets/files/'. $file->filename ).'" />';
                    $items .= '</a>';
                    $items .= '</div>';

                  else:

                    $items .= '<div class="item">';
                    $items .= $file->code;
                    $items .= '</div>';
                   
                  endif;
                 
                endforeach;

              $items .= '</div>';
              $items .= '<a data-slide="prev" href="#'.$template.'" class="left carousel-control">‹</a>';
              $items .= '<a data-slide="next" href="#'.$template.'" class="right carousel-control">›</a>';
            $items .= '</div>';
          $items .= '</div>';
        $items .= '</div>';
        break;
        case 'job-header':

        $items .= ' <div class="row">';
          $items .= '<div class="col-md-10 col-sm-offset-1">';
            $items .= '<div class="carousel slide media-carousel" id="'.$template.'">';
              $items .= '<div class="carousel-inner">';
                $i = 0;
                foreach( $query->result() as $file ):
                  $i++;
                  if(empty( $file->code )):

                    $items .= '<div class="item '.($i == 1 ? 'active' : '' ).'">';
                    $items .= '<a href="'.$file->link.'" target="_black">';
                    $items .= '<img src="'.base_url('assets/files/'. $file->filename ).'" />';
                    $items .= '</a>';
                    $items .= '</div>';

                  else:

                    $items .= '<div class="item">';
                    $items .= $file->code;
                    $items .= '</div>';
                   
                  endif;
                 
                endforeach;

              $items .= '</div>';
              $items .= '<a data-slide="prev" href="#'.$template.'" class="left carousel-control">‹</a>';
              $items .= '<a data-slide="next" href="#'.$template.'" class="right carousel-control">›</a>';
            $items .= '</div>';
          $items .= '</div>';
        $items .= '</div>';


        break;
    default:

      $items .= '<div class="carousel-inner" id="'.$template.'">'; 
      $i = 0;
        foreach( $query->result() as $file ):
          $i++;
          if(empty( $file->code )):

            $items .= '<div class="item '.($i == 1 ? 'active' : '' ).'">';
            $items .= '<a href="'.$file->link.'" target="_black">';
            $items .= '<img src="'.base_url('assets/files/'. $file->filename ).'" />';
            $items .= '</a>';
            $items .= '</div>';

          else:

            $items .= '<div class="item">';
            $items .= $file->code;
            $items .= '</div>';
           

          endif;
         
        endforeach;
      $items .= '</div>';
     
    }

     $items .= '<script type="text/javascript">
        $(document).ready(function() {
            $("#'.$template.'").carousel({
              pause: true,
              interval: 1000 * '.$interval.',
            });
          });
          </script>
      ';

    $items .= '<div style="height: 10px;"></div>';
  endif;
  return $items;

  }


  function create_slug($string, $ext='.html'){

        $replace = '-';         
        $string = strtolower($string);     
 
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);     
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
 
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);     
 
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);     
 
        //limit the slug size     
        $string = substr($string, 0, 100);     
 
        //slug is generated     
        return ($ext) ? $string.$ext : $string;
         
    }    

function isTime($time,$is24Hours=true,$seconds=false) {
    $pattern = "/^".($is24Hours ? "([1-2][0-3]|[01]?[1-9])" : "(1[0-2]|0?[1-9])").":([0-5]?[0-9])".($seconds ? ":([0-5]?[0-9])" : "")."$/";
    if (preg_match($pattern, $time)) {
        return true;
    }
    return false;
}


function time_elap_str($ptime)
{
  date_default_timezone_set('Asia/Bangkok');

    $etime = time() - strtotime($ptime);

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

function e($string){
   return htmlentities($string);

}

  function limit_to_numwords( $string, $numwords ){

    $excerpt = explode(' ', $string, $numwords + 1 );

    if( count($excerpt) >= $numwords ){
        array_pop($excerpt);
    }

    $excerpt = implode(' ', $excerpt);
    return $excerpt;

}
function get_excerpt($body, $numwords = 50 ){

    $string = '';
    $url =  'product'; 
    $string .=  limit_to_numwords(strip_tags($body), $numwords );
    $string .= ( strlen($body) > $numwords ? anchor($url, '[...]', array('title' => 'Detail')) : '' );
    return $string;

}
function get_type_job($pubdate, $type ){

  $ckday = date("Y/m/d", time()-86400*2); 
  $created_date = date_format(date_create($pubdate ), 'Y/m/d');
  $str ='';
  if($created_date >= $ckday){
      
      $str .= '<img src= "'.base_url('assets/images/icons/'. ( $type == 1 ? 'urgent.gif' : 'new.gif')).'">';
      return $str;
     
  }else{
    return false;
  }

  
   
}

  function get_search_post($query, $main_title = 'Urgent jobs'){

  
    $str = '<div class="wrap-box">';
    $str .= '<div class="main-title-box">';
    $str .= '<h4 class="label-high-light"> <i class="fa fa-th-list"></i> ' .$main_title. '</h4>';
    $str .= '</div>';
    $str .= '<div class="main-items">';
  
      $str .= '<table class="table table-striped table-bordered table-hover font_size" id="dataTables" >';
      $str .= '<thead>
                    <tr>
                      <th width="5%">ID</th>
                      <th>Title/Position</th>
                      <th width="25%">Company</th>
                      <th width="20%">Closing Date </th>
                      <th width="13%">Salary</th>
                    </tr>
              </thead>
              ';
      $str .='<tboody>';
      if(count($query)):
      $i = 1;
      foreach($query as $row):
        $str .= '<tr>';
        $str .= '<td>'.$i++.'</td>';
        $str .= '<td><a alt="'.$row->title.'" title="'.$row->title.'" href="'.base_url( 'job/'.date('Y') .'/' .$row->id .'/' . create_slug( $row->title)).'">'.$row->title.get_type_job($row->pubdate, $row->type ).'</a> </td>';

        $name = element($row->company , listData('company','id', 'name', null ), null );
        $str .= '<td><a alt="'.$name.'" title="'.$name.'" href="'.base_url( 'company/'.date('Y') .'/' .$row->company .'/' . create_slug( $name)).'"> '.$name.' </a></td>';
        $str .= '<td>'.date('Y/m/d',strtotime( $row->pubdate. " +28 days")).'</td>';
        $str .= '<td>'.element($row->salary , listData('salary','id', 'amount', null ), null ).'</td>';

        $str .= '</tr>';
      endforeach;
      endif;
      $str .='<tboody>';
      $str .= '</table>';
    $str .= '</div>';
    $str .= '</div>';
    return $str;


}

function get_visitor(){

// ip-protection in seconds
$counter_expire = 600;

// ignore agent list
$counter_ignore_agents = array('bot', 'bot1', 'bot3');

// ignore ip list
$counter_ignore_ips = array('127.0.0.2', '127.0.0.3');

// get basic information
$counter_agent = $_SERVER['HTTP_USER_AGENT'];
$counter_ip = $_SERVER['REMOTE_ADDR']; 
$counter_time = time();

// connect to database
$counter_connected = true;
$CI = &get_instance();

if ($counter_connected == true) 
{
   $ignore = false; 
   
   // get counter information
   $sql = "SELECT * FROM counter_values LIMIT 1";
   $res = $CI->db->query($sql);
   
   // fill when empty
   if ($res->num_rows() == 0)
   {    
    $sql = "INSERT INTO `counter_values` (`id`, `day_id`, `day_value`, `yesterday_id`, `yesterday_value`, `week_id`, `week_value`, `month_id`, `month_value`, `year_id`, `year_value`, `all_value`, `record_date`, `record_value`) VALUES ('1', '" . date("z") . "',  '1', '" . (date("z")-1) . "',  '0', '" . date("W") . "', '1', '" . date("n") . "', '1', '" . date("Y") . "',  '1',  '1',  NOW(),  '1')";
    $CI->db->query($sql);

    // reload with settings
    $sql = "SELECT * FROM counter_values LIMIT 1";
    $res = $CI->db->query($sql);
    
    $ignore = true;
   }   

   $row = $res->row_array();
   
   $day_id = $row['day_id'];
   $day_value = $row['day_value'];
   $yesterday_id = $row['yesterday_id'];
   $yesterday_value = $row['yesterday_value'];
   $week_id = $row['week_id'];
   $week_value = $row['week_value'];
   $month_id = $row['month_id'];
   $month_value = $row['month_value'];
   $year_id = $row['year_id'];
   $year_value = $row['year_value'];
   $all_value = $row['all_value'];
   $record_date = $row['record_date'];
   $record_value = $row['record_value'];
   
   
   // check ignore lists
   $length = sizeof($counter_ignore_agents);
   for ($i = 0; $i < $length; $i++)
   {
    if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i])))
    {
       $ignore = true;
     break;
    }
   }
   
   $length = sizeof($counter_ignore_ips);
   for ($i = 0; $i < $length; $i++)
   {
    if ($counter_ip == $counter_ignore_ips[$i])
    {
       $ignore = true;
     break;
    }
   }
   
      
   // delete free ips
   if ($ignore == false)
   {
      $sql = "DELETE FROM counter_ips WHERE unix_timestamp(NOW())-unix_timestamp(visit) >= $counter_expire"; 
      $CI->db->query($sql);    
   }
      
   // check for entry
   if ($ignore == false)
   {
      $sql = "update counter_ips set visit = NOW() where ip = '$counter_ip'";
      $CI->db->query($sql);
    
    if ($CI->db->affected_rows() > 0)
    {
     $ignore = true;                   
    }
    else
    {
     // insert ip
      $sql = "INSERT INTO counter_ips (ip, visit) VALUES ('$counter_ip', NOW())";
      $CI->db->query($sql); 
    }       
   }
   
   // online?
   $sql = "SELECT * FROM counter_ips";
   $res = $CI->db->query($sql);
   $online = $res->num_rows();
      
   // add counter
   if ($ignore == false)
   {        
      // yesterday
    if ($day_id == (date("z")-1)) 
    {
       $yesterday_value = $day_value; 
    }
    else
    {
       if ($yesterday_id != (date("z")-1))
     {
        $yesterday_value = 0; 
     }
    }
    $yesterday_id = (date("z")-1);
    
    // day
    if ($day_id == date("z")) 
    {
       $day_value++; 
    }
    else 
    {
       $day_value = 1;
     $day_id = date("z");
    }
    
    // week
    if ($week_id == date("W")) 
    {
       $week_value++; 
    }
    else 
    { 
       $week_value = 1;
     $week_id = date("W");
      }
    
      // month
    if ($month_id == date("n")) 
    {
       $month_value++; 
    }
    else 
    {
       $month_value = 1;
     $month_id = date("n");
      }
    
    // year
    if ($year_id == date("Y")) 
    {
       $year_value++; 
    }
    else 
    {
       $year_value = 1;
     $year_id = date("Y");
      }
    
    // all
    $all_value++;
     
    // neuer record?
    if ($day_value > $record_value)
    {
       $record_value = $day_value;
       $record_date = date("Y-m-d H:i:s");
    }
     
    // speichern und aufräumen
    $sql = "UPDATE counter_values SET day_id = '$day_id', day_value = '$day_value', yesterday_id = '$yesterday_id', yesterday_value = '$yesterday_value', week_id = '$week_id', week_value = '$week_value', month_id = '$month_id', month_value = '$month_value', year_id = '$year_id', year_value = '$year_value', all_value = '$all_value', record_date = '$record_date', record_value = '$record_value' WHERE id = 1";
    $CI->db->query($sql); 

   }    


    $str = '<div class="ibox float-e-margins">';
    $str .= '<div class="ibox-title">';
    $str .= '<h5> Visitor</h5>';
    $str .='</div>';
    $str .= '<div class="ibox-content">';
    $str .= $online . 'Online<br />';   
    $str .= $day_value . 'Today<br />'; 
    $str .= $yesterday_value .'Yesterday<br />';       
    $str .= $all_value .'Total';
    $str .= '</div>';
    $str .= '</div>'; 

    $str .= '<div class="ibox float-e-margins">';
    $str .= '<div class="ibox-title">';
    $str .= '<h5> Find us on facebook </h5>';
    $str .='</div>';
    $str .= '<div class="ibox-content">';
    $str .= '
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk"));
      </script>
             <div class="fb-like" data-href="https://www.facebook.com/camsvjob" data-width="280" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    ';  
  
    $str .= '</div>';
    $str .= '</div>';
    return $str;
  }

  }

  function get_menu($parent, $position){

    $CI = &get_instance();
    $CI->db->like(array('position' => $position));
    return $CI->db->order_by('order', 'ASC')->get_where('pages', array('parent_id' => $parent, 'activated' => 1))->result_array();

  }


  
  function get_menu_tree($parent, $position) 
{
    
  
    $menu = '';
    $query = get_menu($parent, $position);
    if(count($query)):
    //$menu .= '<ul>';
    foreach($query as $row ) 
    {     
          
           $items = get_menu($row['id'], $position);

           if($items):
   
              $menu .= '<div class="btn-group" style ="margin-right: 5px;">';
                $menu .= '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">';
                $menu .= $row['title'];
                $menu .= '<span class="caret"></span>';
                $menu .= '</button>';
                $menu .= '<ul class="dropdown-menu">';
              
              foreach($items as $item ){
                $menu .= '<li>';
                $menu .='<a href="'.get_link($item['type'], $item['link'], $item['id'],$item['title']) .'">'.$item['title'].'</a>';
                $menu .= '</li>';
              }

                $menu .= '</ul>';
              $menu .= '</div>';
            
            else:
              
              $menu .='<a class="btn btn-link" href="'.get_link($row['type'], $row['link'], $row['id'],$row['title']).'">'.$row['title'].'</a>';

            endif;
          

 
    }

    //$menu .= '</ul>';
    endif;
    
    return $menu;
}


  function get_link($type,$link,$id,$title){

    $href ='';
    switch ($type) {

    case 1 :

         $href .= base_url($link);
        break;

    case 2 :
           $href .= $link;
        break;

    default:
        $href .= base_url( 'page/'.date('Y') .'/' .$id .'/' . create_slug($title));
  }
  return $href;

}


function count_rows($tb,$where = null){

  $CI =& get_instance();
  if(is_null($where)){
    return  $CI->db->get($tb)->num_rows();
  }else{
    return $CI->db->get_where($tb, $where)->num_rows();
  }

}

  