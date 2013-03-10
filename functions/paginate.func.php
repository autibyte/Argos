<?php
	function paginate($current_page, $total_records, $number_per_page, $url, $var_prefix="?page="){

		/* If the number of records is 0, we won't display anything */
		if($total_records<=$number_per_page){
			return "";
		}

		$total_pages = ceil($total_records / $number_per_page);

		// Make the current page the last page if it's greater than the allowed number
		if ($current_page > $total_records) {
		   $current_page = $total_pages;
		}

		// Same for being before the first page
		if ($current_page < 1) {
		   $current_page = 1;
		}

		$offset = ($current_page - 1) * $number_per_page;

		$html = '<div class="pagination"><ul>';

		// If we're not on the first page, we shouldn't show back links
		if ($current_page > 1) {
			// Show the link to go the the first page
			if($current_page >= 3){
				$html .= '<li><a href="' . $url . $var_prefix . '1">&larr; Last</a></li>';
			}
			// get previous page num
			$previous_page = $current_page - 1;
			// Show link to go back 1 page. If it's the first page, omit $var_prefix
			$modified_url = ($previous_page==1) ?  strtok($url, "?") : $url . $var_prefix . $previous_page;
			$html .= '<li class="prev"><a href="' . $modified_url . '">Previous</a></li>';
		}

		// loop to show links to range of pages around current page
		for ($x = ($current_page - $total_pages); $x < (($current_page + $total_pages) + 1); $x++) {
		   // if it's a valid page number...
		   if (($x > 0) && ($x <= $total_pages)) {
		      // if we're on current page...
		      if ($x == $current_page) {
		         // 'highlight' it but don't make a link
		         if($total_pages==1)
		         {
		         	$html .= '<li class="disabled"><a href="' . $url . '">Page 1</a></li>';
		         }
		         else
		         {
		         	$html .= '<li class="active"><a href="javascript:void(0)">' . $x . '</a></li>';
		         }
		      // If it's not the current page, then make it a link
		      } else {
		         // make it a link
		         $modified_url = ($x==1) ?  strtok($url, "?") : $url . $var_prefix . $x;
		         $html .= '<li><a href="' . $modified_url . '">' . $x . '</a></li>';
		      }
		   } 
		}

		// if not on last page, show forward and last page links        
		if ($current_page != $total_pages&&$total_pages!=0) {
		   // get next page
		   $next_page = $current_page + 1;
		    // echo forward link for next page 
		   $html .= '<li class="next"><a href="' . $url . $var_prefix. $next_page . '">Next</a></li>';
		   // echo forward link for lastpage;
		   if($current_page >= 3){
			   $html .= '<li class="next"><a href="' . $url . $var_prefix . $total_pages . '">&rarr;</a></li>';
		   }
		} // end if

		$html .= '</ul></div>';

		return $html;
	}
?>