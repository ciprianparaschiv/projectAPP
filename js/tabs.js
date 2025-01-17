/*** Dynamic Tabs ***/
///  By Muhsin Meydan: any questions send to meydan1@hotmail.com ///
///  Leave this line as reference       ///

   $(function () {  
	     	// Display the first tab content
			// Set the first tab as start tab onload: if you want to set no start tab comment it.
			DisplayTabContent(0);
			
			    // get index of the clicked navigation item in the list
	            $("ul.tabslist li span" ).click(function(){
	            
	                // if animation has finished: meaning size()==0 then allow for other clicks
                    if ($('div.tabscontent_container > div.tabcontent:animated').size() == 0)
                    {
                        $("ul.tabslist li").removeClass('current');
                        var $listItem = $(this).parent().addClass('current');//set as current class

                        var index = $("ul.tabslist li ").index($listItem);// get index 

                        if( index > -1 ){
                        DisplayTabContent(index);
                        }
                    }
	            });
	             return false;   
	     });

    /**Display tab content that was clicked by index and hide the rest**/
	function DisplayTabContent(index) {
	    // display the first tab content
		$("ul.tabslist li").filter(":nth("+index+")").addClass('current');
	    $("div.tabscontent_container > div.tabcontent").hide().filter(":nth("+index+")").show();
        return false;
	}