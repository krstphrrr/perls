<?php   
class Pager 
  { 
   function findStart($limit) 
    { 
     if ((!isset($_GET['page'])) || ($_GET['page'] == "1")) 
      { 
       $start = 0; 
       $_GET['page'] = 1; 
      } 
     else 
      { 
       $start = ($_GET['page']-1) * $limit; 
      } 

     return $start; 
    } 
  /*********************************************************************************** 
   * int findPages (int count, int limit) 
   * Returns the number of pages needed based on a count and a limit 
   ***********************************************************************************/ 
   function findPages($count, $limit) 
    { 
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1; 

     return $pages; 
    } 
  /*********************************************************************************** 
   * string pageList (int curpage, int pages) 
   * Returns a list of pages in the format of " < [pages] > " 
   ***********************************************************************************/ 

   function pageList($curpage, $pages,$search_type,$search_multiple_sites,$site_elevlow_min,$site_elevlow_max,$site_elevhigh_min,$site_elevhigh_max,$site_temp_min,$site_temp_max,$site_precip_min,$site_precip_max) 
    { 
     $page_list  = ""; 

     /* Print the first and previous page links if necessary */ 
     if (($curpage != 1) && ($curpage)) 
      {  
       $page_list .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=1&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\" title=\"First Page\"> << </a>"; 
      } 

     if (($curpage-1) > 0) 
      { 
       $page_list .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=".($curpage-1)."&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\" title=\"Previous Page\">&nbsp; < </a>"; 
      } 

     /* Print the numeric page list; make the current page unlinked and bold */ 
     for ($i=1; $i<=$pages; $i++) 
      { 
       if ($i == $curpage) 
        { 
         $page_list .= "<b>".$i."</b>"; 
        } 
       else 
        { 
		  $page_list .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=".$i."&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\" title=\"Page ".$i."\">".$i."</a>"; 
        } 
       $page_list .= " "; 
      } 

     /* Print the Next and Last page links if necessary */ 
     if (($curpage+1) <= $pages) 
      { 
       $page_list .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=".($curpage+1)."&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\" title=\"Next Page\"> > </a> "; 
      } 

     if (($curpage != $pages) && ($pages != 0)) 
      { 
       $page_list .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=".$pages."&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\" title=\"Last Page\"> &nbsp; >> </a> "; 
      } 
     $page_list .= "</td>\n"; 
	if($limit < 0){$limit = 0;}
     return $page_list; 
    } 
  /*********************************************************************************** 
   * string nextPrev (int curpage, int pages) 
   * Returns "Previous | Next" string for individual pagination (it's a word!) 
   ***********************************************************************************/ 
   function nextPrev($curpage, $pages) 
    { 
     $next_prev  = ""; 

     if (($curpage-1) <= 0) 
      { 
       $next_prev .= "Previous"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=".($curpage-1)."&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\">Previous</a>"; 
      } 

     $next_prev .= " | "; 

     if (($curpage+1) > $pages) 
      { 
       $next_prev .= "Next"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"javascript:searchSiteCriteriaTable2('?page=".($curpage+1)."&search_type=".$search_type."&search_multiple_sites=".$search_multiple_sites."&site_elevlow_min=".$site_elevlow_min."&site_elevlow_max=".$site_elevlow_max."&site_elevhigh_min=".$site_elevhigh_min."&site_elevhigh_max=".$site_elevhigh_max."&site_temp_min=".$site_temp_min."&site_temp_max=".$site_temp_max."&site_precip_min=".$site_precip_min."&site_precip_max=".$site_precip_max."')\">Next</a>"; 
      } 

     return $next_prev; 
    } 
  } 
?> 

 


