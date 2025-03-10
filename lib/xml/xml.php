<?php
class xml  {
    var $parser;

    function xml()
    {
        $this->parser = xml_parser_create();

        xml_set_object($this->parser, $this);//&$this
        xml_set_element_handler($this->parser, "tag_open", "tag_close");
        xml_set_character_data_handler($this->parser, "cdata");
    }

	
	
    public function xml_to_array($arg_str_xml)
    {
        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $arg_str_xml, $arr_raw_xml);
		if(xml_get_error_code($parser)) {
			$error=xml_error_string(xml_get_error_code($parser)).' at line '.xml_get_current_line_number($parser);
			echo $error;
			exit();
		}
		$arr_out = array();
        $this->prv_xml_to_array($arr_raw_xml, $arr_out);
        return $arr_out;
    }    // end function xml_to_array
//-----------------------------------------------------------------------------    
    /**
    Private XML to Array.
    Converts xml to array recursively.
    @param arg_tags the raw array of tags got from xml_parse_into_struct is passed by reference to keep the position of the pointer in the array through function calls.
    @param arg_current_tag the current array to be filled is passed by reference because it is changed within the function.
    @return Array.
    */
    private function prv_xml_to_array(&$arg_tags, &$arg_current_tag)
    {
        while(list(, $arr_tag) = each($arg_tags))
        {
            if($arr_tag['level'] > 1)
            {
                if ($arr_tag['type']=="complete")         // if type = complete
                {        
                    $arg_current_tag[$arr_tag['attributes']['KEY']] = $arr_tag['value'];
                } 
                elseif ($arr_tag['type']=="open")        // if type = open
                {
                    $this->prv_xml_to_array($arg_tags, $arg_current_tag[$arr_tag['attributes']['KEY']]);
                } 
                elseif ($arr_tag['type']=="close")        // if type = close
                {
                    return;
                }    // end if type
            }    // end if level > 1
        }    // end while arg_tags        
    }    // end function prv_xml_to_array 
	
    function parse($arg_str_xml)
    { 
        xml_parse($this->parser, $arg_str_xml);
    }

    function tag_open($parser, $tag, $attributes)
    { 
        //var_dump($parser, $tag, $attributes); 
    }

    function cdata($parser, $cdata)
    {
        //var_dump($parser, $cdata);
    }

    function tag_close($parser, $tag)
    {
        //var_dump($parser, $tag);
    }

	function pad($arg_int_padNumber=0, $arg_str_pad="")
	{
		if(($arg_int_padNumber===0) || ($arg_str_pad===""))return "";
		$i = 0;
		$str_pad = "";
		while($i < $arg_int_padNumber){
			$str_pad .= $arg_str_pad;
			$i++;
		}
		return ($str_pad ? "\n" . $str_pad : "");
	}
	
	// private function makes xml from array
	function prv_arrayToXml($arg_arr_array, $arg_int_padNumber=0, $arg_str_pad="")
	{
		//print $arg_int_padNumber;
		$str_xml = "";
		while(list($k, $v) = each($arg_arr_array)){
			$str_xml .= $this->pad($arg_int_padNumber, $arg_str_pad) . "<a key=\"$k\">";
			if(is_array($v)){
				$str_xml .= $this->prv_arrayToXml($v, $arg_int_padNumber+1, $arg_str_pad);
			}else{
				$str_xml .= "<![CDATA[" . $this->pad($arg_int_padNumber+1, $arg_str_pad) . $v . "]]>";
			}
			$str_xml .= $this->pad($arg_int_padNumber, $arg_str_pad) . "</a>";
		}
		return $str_xml;
	}
	
	function arrayToXml($arg_arr_array, $arg_str_operationName="response", $arg_str_pad="")
	{
		if(!is_array($arg_arr_array))return false;
		$str_xml = "<$arg_str_operationName>";
		$str_xml .= $this->prv_arrayToXml($arg_arr_array, 1, $arg_str_pad);
		$str_xml .= ($arg_str_pad==="" ? "" : "\n") . "</$arg_str_operationName>";
		return $str_xml;
	}

} // end of class xml

?>